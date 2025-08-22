<?php
session_start();
require_once 'ConectaBanco.php';
require_once 'questoes_valores.php';

$bd = new ConectaBanco();

if(empty($_SESSION['questao_atual'])){
  header('Location: sorteia_questao.php');
  exit;
}

$q_id = (int)$_SESSION['questao_atual'];
$res = $bd->query("SELECT * FROM questoes WHERE id='$q_id'");
$quest = mysqli_fetch_assoc($res);

$opcoes = [
  $quest['alternativa1'],
  $quest['alternativa2'],
  $quest['alternativa3'],
  $quest['alternativa4']
];

function letra($i){ $a = ['A','B','C','D']; return $a[$i]; }

function dificuldade_por_pergunta($n){
    if ($n >= 1 && $n <= 5) return 'Fácil';
    if ($n >= 6 && $n <= 10) return 'Média';
    if ($n >= 11 && $n <= 15) return 'Difícil';
    if ($n == 16) return 'Pergunta do Milhão';
    return 'Fácil';
}

$dificuldade_atual = dificuldade_por_pergunta($_SESSION['pergunta'] ?? 1);

$badge_class = '';
switch ($dificuldade_atual) {
    case 'Fácil':
        $badge_class = 'easy';
        break;
    case 'Média':
        $badge_class = 'medium';
        break;
    case 'Difícil':
        $badge_class = 'hard';
        break;
    case 'Pergunta do Milhão':
        $badge_class = 'million';
        break;
}

$pergunta_atual_num = $_SESSION['pergunta'] ?? 1;
$valor_pergunta = $questao_valor[$pergunta_atual_num - 1] ?? 0;
$valor_acumulado = $questao_valor[$pergunta_atual_num - 2] ?? 0;
$pode_pular_ou_carta = ($_SESSION['pergunta'] < 16);
$jogo_acabou = ($_SESSION['status'] === 'fim' || $_SESSION['status'] === 'fim_ganhou');

?>
<?php require_once __DIR__ . '/style_inject.php'; ?>

<div class="header">
  <div class="container inner">
    <a class="brand" href="index.php"><span class="coin"></span> Show do Milhão</a>
  </div>
</div>

<div class="container game-layout">
  <div class="card quiz">

    <?php if($_SESSION['status'] !== 'fim_ganhou'): ?>
      <div class="scoreboard">
        <div class="score">Pergunta #<?php echo $_SESSION['pergunta']; ?></div>
        <div class="money">
            <span>Valor: R$ <?php echo number_format($valor_pergunta, 2, ',', '.'); ?></span>
            <span class="badge dot <?php echo $badge_class; ?>">
                <?php echo $dificuldade_atual; ?>
            </span>
        </div>
      </div>
      <div class="scoreboard">
          <div class="money">Acumulado: R$ <?php echo number_format($valor_acumulado, 2, ',', '.'); ?></div>
      </div>
    <?php endif; ?>
    
    <?php if($_SESSION['status']==='acertou'): ?>
      <div class="feedback success pop">✔ Você acertou! Próxima pergunta...</div>
    <?php elseif($_SESSION['status']==='fim'): ?>
      <div class="feedback danger pop">✖ Jogo cancelado! Sua pontuação final: R$ <?php echo number_format($_SESSION['pontuacao'], 2, ',', '.'); ?></div>
    <?php elseif($_SESSION['status']==='fim_ganhou'): ?>
      <div class="feedback success pop">
        Parabéns! Você ganhou 1 milhão!!
        <br>
        <img src="https://i.pinimg.com/736x/3c/55/59/3c555950acd8e875e84fed60b0a3d2b4.jpg" alt="Parabéns, 1 Milhão" style="max-width: 100%; height: auto; margin-top: 15px; max-height: 200px;">
      </div>
    <?php elseif($_SESSION['status']==='pulo'): ?>
     
    <?php elseif($_SESSION['status']==='carta'): ?>
      
    <?php endif; ?>

    <div class="question"><?php echo $quest['questao']; ?></div>

    <form class="mt-2" action="processa_resposta.php" method="post">
      <input type="hidden" name="formulario" value="1">
      <input type="hidden" name="id_questao" value="<?php echo $quest['id']; ?>">

      <div class="options">
        <?php for($i=0; $i<4; $i++):
          $texto = $opcoes[$i];
          $disabled = (in_array($i, $_SESSION['carta_removidas'] ?? [])) ? 'style="opacity:.4; pointer-events:none;"' : '';
        ?>
          <button class="option" type="submit" name="resposta" value="<?php echo htmlspecialchars($texto, ENT_QUOTES); ?>" <?php echo $disabled; ?>>
            <span class="letter"><?php echo letra($i); ?></span>
            <span><?php echo htmlspecialchars($texto); ?></span>
          </button>
        <?php endfor; ?>
      </div>
    </form>
  </div>

  <aside class="sidebar">
    <div class="ajuda-container">
        <form method="get" action="sorteia_questao.php" style="display:inline">
          <button class="lifeline<?php echo ($_SESSION['pulos']<=0 || !$pode_pular_ou_carta || $jogo_acabou ? ' used':'');?>" <?php echo ($_SESSION['pulos']<=0 || !$pode_pular_ou_carta || $jogo_acabou?'disabled':'');?> name="acao" value="pular" type="submit">⏭️ Pular (<?php echo $_SESSION['pulos'];?>)</button>
        </form>
        <form method="post" action="processa_resposta.php" style="display:inline">
          <button class="lifeline<?php echo ($_SESSION['cartas']<=0 || !$pode_pular_ou_carta || $jogo_acabou?' used':'');?>" <?php echo ($_SESSION['cartas']<=0 || !$pode_pular_ou_carta || $jogo_acabou?'disabled':'');?> name="acao" value="carta" type="submit">🎴 Carta (<?php echo $_SESSION['cartas'];?>)</button>
        </form>
        
        <form method="get" action="parar_jogo.php" style="display:inline">
          <button class="lifeline<?php echo ($jogo_acabou?' used':'');?>" <?php echo ($jogo_acabou?'disabled':'');?> type="submit">🛑 Parar</button>
        </form>
        
        <?php if($jogo_acabou): ?>
            <a class="btn" href="novo_jogo.php">Jogar novamente</a>
        <?php endif; ?>
    </div>
  </aside>
</div>

<div class="progress-container">
  <div class="progress-wrapper">
    <div class="progress">
      <?php for($i=1; $i<=16; $i++): ?>
        <span class="step <?php echo ($i < $_SESSION['pergunta'] ? 'done' : ($i==$_SESSION['pergunta']?'active':''));?>"><?php echo $i; ?></span>
      <?php endfor; ?>
    </div>
  </div>
</div>

</body>
</html>