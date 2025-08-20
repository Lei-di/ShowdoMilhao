<?php
session_start();
require_once 'ConectaBanco.php';

$bd = new ConectaBanco();
$tot = $bd->query("SELECT COUNT(*) AS total FROM questoes");
$tot = mysqli_fetch_assoc($tot);
$total_perguntas = (int)$tot['total'];

$_SESSION = [
  'pergunta' => 1,
  'pulos' => 3,
  'cartas' => 3,
  'pontuacao' => 0,
  'categoria' => null,
  'perguntas_sorteadas' => [],
  'status' => 'nova_pergunta',
  'indice_questao_inicio' => 1,
  'indice_questao_fim' => $total_perguntas,
  'questao_atual' => null,
  'carta_removidas' => []
];

header('Location: sorteia_questao.php');
exit;