<?php
session_start();
require_once 'ConectaBanco.php';

function dificuldade_por_pergunta($n){
  if ($n <= 5) return 'Fácil';
  if ($n <= 10) return 'Média';
  return 'Difícil';
}
function pontos_por_dificuldade($dif){
  switch ($dif){
    case 'Fácil': return 100;
    case 'Média': return 500;
    case 'Díficil':
    case 'Difícil': return 1000;
    default: return 100;
  }
}

$bd = new ConectaBanco();

// Ação opcional: pular pergunta
if(isset($_GET['acao']) && $_GET['acao'] === 'pular'){
  if(isset($_SESSION['pulos']) && $_SESSION['pulos'] > 0){
    $_SESSION['pulos'] -= 1;
    $_SESSION['status'] = 'pulo';
  }
}

// Não repetir perguntas já vistas
$idsVistos = isset($_SESSION['perguntas_sorteadas']) ? $_SESSION['perguntas_sorteadas'] : [];

// Determina dificuldade com base no número da pergunta
$dif = dificuldade_por_pergunta($_SESSION['pergunta'] ?? 1);

// Se jogador usou ação de categoria fixa na sessão, prioriza
if(!empty($_SESSION['categoria'])){ $dif = $_SESSION['categoria']; }

// Monta filtro NOT IN
$filtroNotIn = "";
if (!empty($idsVistos)) {
  $safe = array_map('intval', $idsVistos);
  $filtroNotIn = "AND id NOT IN (" . implode(",", $safe) . ")";
}

// Sorteia 1 pergunta aleatória com a dificuldade definida
$sql = "SELECT * FROM questoes WHERE dificuldade='$dif' $filtroNotIn ORDER BY RAND() LIMIT 1";
$res = $bd->query($sql);

if(!$res || mysqli_num_rows($res) === 0){
  // Se acabar nessa dificuldade, tenta qualquer dificuldade ainda não usada
  $sql = "SELECT * FROM questoes WHERE 1=1 $filtroNotIn ORDER BY RAND() LIMIT 1";
  $res = $bd->query($sql);
}

$questao = mysqli_fetch_assoc($res);

// Atualiza sessão para nova pergunta
$_SESSION['questao_atual'] = (int)$questao['id'];
$_SESSION['categoria'] = $questao['dificuldade']; // salva a real
$_SESSION['status'] = 'nova_pergunta';
$_SESSION['carta_removidas'] = []; // reseta carta
$_SESSION['perguntas_sorteadas'][] = (int)$questao['id'];

// Redireciona para a área do jogo
header('Location: area_jogo.php');
exit;
