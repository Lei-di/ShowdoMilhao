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

// Monta opções (shuffle)
$opcoes = [
  $quest['alternativa1'],
  $quest['alternativa2'],
  $quest['alternativa3'],
  $quest['alternativa4']
];
$indices = [0,1,2,3];
shuffle($indices);

// Aplica 50/50 se houver removidas
$rem = isset($_SESSION['carta_removidas']) ? $_SESSION['carta_removidas'] : [];

function letra($i){ $a = ['A','B','C','D']; return $a[$i]; }
?>
<?php require_once __DIR__ . '/style_inject.php'; ?>

<div class="header">
  <div class="container inner">
    <a class="brand" href="index.php"><span class="coin"></span> Show do Milhão</a>
    <div class="lifelines">
      <form method="get" action="sorteia_questao.php" style="display:inline">
        <button class="lifeline<?php echo ($_SESSION['pulos']<=0?' used':'');?>" <?php echo ($_SESSION['pulos']<=0?'disabled':'');?> name="acao" value="pular" type="submit">⏭️ Pular (<?php echo $_SESSION['pulos'];?>)</button>
      </form>
      <form method="post" action="processa_resposta.php" style="display:inline">
        <button class="lifeline<?php echo ($_SESSION['cartas']<=0?' used':'');?>" <?php echo ($_SESSION['cartas']<=0?'disabled':'');?> name="acao" value="carta" type="submit">🎴 Carta 50/50 (<?php echo $_SESSION['cartas'];?>)</button>
      </form>
    </div>
  </div>
</div>

<div class="container game-layout">
  <div class="card quiz">
    <div class="scoreboard">
      <div class="score">Pergunta #<?php echo $_SESSION['pergunta']; ?></div>
      <div class="money">Pontuação: <?php echo $_SESSION['pontuacao']; ?></div>
      <span class="badge dot <?php echo (strtolower($_SESSION['categoria'])=='fácil'?'easy':(strtolower($_SESSION['categoria'])=='média'?'medium':'hard')); ?>">
        <?php echo $_SESSION['categoria']; ?>
      </span>
    </div>

    <?php if($_SESSION['status']==='acertou'): ?>
      <div class="feedback success pop">✔ Você acertou! Próxima pergunta...</div>
    <?php elseif($_SESSION['status']==='fim'): ?>
      <div class="feedback danger pop">✖ Errou! Fim de jogo. Sua pontuação final: <?php echo $_SESSION['pontuacao']; ?></div>
    <?php elseif($_SESSION['status']==='pulo'): ?>
      <div class="toast"><span class="title">Pulo usado</span><span class="msg">Você pulou a pergunta. Restam <?php echo $_SESSION['pulos']; ?>.</span></div>
    <?php elseif($_SESSION['status']==='carta'): ?>
      <div class="toast"><span class="title">50/50</span><span class="msg">Removidas 2 opções erradas.</span></div>
    <?php endif; ?>

    <div class="question"><?php echo $quest['questao']; ?></div>

    <form class="mt-2" action="processa_resposta.php" method="post">
      <input type="hidden" name="formulario" value="1">
      <input type="hidden" name="id_questao" value="<?php echo $quest['id']; ?>">

      <div class="options">
        <?php foreach($indices as $ordem): 
          $texto = $opcoes[$ordem];
          $disabled = (in_array($ordem, $rem)) ? 'style="opacity:.4; pointer-events:none;"' : '';
        ?>
          <button class="option" type="submit" name="resposta" value="<?php echo htmlspecialchars($texto, ENT_QUOTES); ?>" <?php echo $disabled; ?>>
            <span class="letter"><?php echo letra($ordem); ?></span>
            <span><?php echo htmlspecialchars($texto); ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </form>
  </div>

  <aside class="sidebar">
    <div class="card">
      <div class="card-title mb-2">Progresso</div>
      <div class="progress">
        <?php for($i=1; $i<=15; $i++): ?>
          <span class="step <?php echo ($i < $_SESSION['pergunta'] ? 'done' : ($i==$_SESSION['pergunta']?'active':''));?>"><?php echo $i; ?></span>
        <?php endfor; ?>
      </div>
    </div>

    <div class="card">
      <div class="card-title mb-2">Ajudas</div>
      <div class="lifelines">
        <span class="badge">⏭️ Pulos: <?php echo $_SESSION['pulos']; ?></span>
        <span class="badge">🎴 Cartas: <?php echo $_SESSION['cartas']; ?></span>
      </div>
    </div>

    <?php if($_SESSION['status']==='fim'): ?>
      <div class="card center">
        <a class="btn" href="novo_jogo.php">Jogar novamente</a>
      </div>
    <?php endif; ?>
  </aside>
</div>

</body>
</html>
