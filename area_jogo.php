<?php
session_start();
require_once 'ConectaBanco.php';

$bd = new ConectaBanco();

// Se não houver questão atual ainda, vai sortear
if(empty($_SESSION['questao_atual'])){
  header('Location: sorteia_questao.php');
  exit;
}

// Busca a questão atual
$q_id = (int)$_SESSION['questao_atual'];
$res = $bd->query("SELECT * FROM questoes WHERE id='$q_id'");
$quest = mysqli_fetch_assoc($res);

// Monta opções
$opcoes = [
  $quest['alternativa1'],
  $quest['alternativa2'],
  $quest['alternativa3'],
  $quest['alternativa4']
];

// Mapeia os índices de volta para A, B, C, D para facilitar o display
function letra($i){ $a = ['A','B','C','D']; return $a[$i]; }

// Determina a dificuldade atual da pergunta com base no número da pergunta
function dificuldade_por_pergunta($n){
    if ($n >= 1 && $n <= 5) return 'Fácil';
    if ($n >= 6 && $n <= 10) return 'Média';
    if ($n >= 11 && $n <= 15) return 'Difícil';
    if ($n == 16) return 'Pergunta do Milhão';
    return 'Fácil';
}

$dificuldade_atual = dificuldade_por_pergunta($_SESSION['pergunta'] ?? 1);

// Adiciona a classe de badge
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
?>
<?php require_once __DIR__ . '/style_inject.php'; ?>

<div class="header">
  <div class="container inner">
    <a class="brand" href="index.php"><span class="coin"></span> Show do Milhão</a>
    <span class="badge dot <?php echo $badge_class; ?>">
        <?php echo $dificuldade_atual; ?>
    </span>
  </div>
</div>

<div class="container game-layout">
  <div class="card quiz">
    <div class="scoreboard">
      <div class="score">Pergunta #<?php echo $_SESSION['pergunta']; ?></div>
      <div class="money">Pontuação: <?php echo $_SESSION['pontuacao']; ?></div>
    </div>

    <?php if($_SESSION['status']==='acertou'): ?>
      <div class="feedback success pop">✔ Você acertou! Próxima pergunta...</div>
    <?php elseif($_SESSION['status']==='fim'): ?>
      <div class="feedback danger pop">✖ Errou! Fim de jogo. Sua pontuação final: <?php echo $_SESSION['pontuacao']; ?></div>
    <?php elseif($_SESSION['status']==='pulo'): ?>
      <div class="toast"><span class="title">Pulo usado</span><span class="msg">Você pulou a pergunta. Restam <?php echo $_SESSION['pulos']; ?>.</span></div>
    <?php elseif($_SESSION['status']==='carta'): ?>
      <div class="toast"><span class="title">50/50</span><span class="msg">Removidas opções erradas.</span></div>
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
    <div class="card">
      <div class="card-title mb-2">Progresso</div>
      <div class="progress">
        <?php for($i=1; $i<=16; $i++): ?>
          <span class="step <?php echo ($i < $_SESSION['pergunta'] ? 'done' : ($i==$_SESSION['pergunta']?'active':''));?>"><?php echo $i; ?></span>
        <?php endfor; ?>
      </div>
    </div>
    
    <div class="card ajuda-container">
        <form method="get" action="sorteia_questao.php" style="display:inline">
          <button class="lifeline<?php echo ($_SESSION['pulos']<=0?' used':'');?>" <?php echo ($_SESSION['pulos']<=0?'disabled':'');?> name="acao" value="pular" type="submit">⏭️ Pular (<?php echo $_SESSION['pulos'];?>)</button>
        </form>
        <form method="post" action="processa_resposta.php" style="display:inline">
          <button class="lifeline<?php echo ($_SESSION['cartas']<=0?' used':'');?>" <?php echo ($_SESSION['cartas']<=0?'disabled':'');?> name="acao" value="carta" type="submit">🎴 Carta (<?php echo $_SESSION['cartas'];?>)</button>
        </form>
        <?php if($_SESSION['status']==='fim'): ?>
            <a class="btn" href="novo_jogo.php">Jogar novamente</a>
        <?php endif; ?>
    </div>
  </aside>
</div>

</body>
</html>