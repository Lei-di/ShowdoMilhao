<?php
session_start();
require_once 'ConectaBanco.php';

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

// Ação de carta (50/50) antes de processar resposta
if(isset($_POST['acao']) && $_POST['acao'] === 'carta'){
    if(isset($_SESSION['cartas']) && $_SESSION['cartas'] > 0){
        $_SESSION['cartas'] -= 1;
        // Seleciona 2 alternativas erradas aleatórias para esconder
        $q_id = (int)$_SESSION['questao_atual'];
        $res = $bd->query("SELECT * FROM questoes WHERE id='$q_id'");
        $q = mysqli_fetch_assoc($res);
        $opcoes = [
          $q['alternativa1'],
          $q['alternativa2'],
          $q['alternativa3'],
          $q['alternativa4']
        ];
        $correta = $q['correta'];
        $indices_errados = [];
        foreach($opcoes as $i=>$txt){ if($txt != $correta) $indices_errados[] = $i; }
        shuffle($indices_errados);
        $_SESSION['carta_removidas'] = array_slice($indices_errados, 0, 2);
        $_SESSION['status'] = 'carta';
    }
    header('Location: area_jogo.php');
    exit;
}

if(isset($_POST['formulario'])){
    $q_id = (int)$_POST['id_questao'];
    $resposta = $_POST['resposta'] ?? '';

    $res = $bd->query("SELECT * FROM questoes WHERE id='$q_id'");
    $q = mysqli_fetch_assoc($res);

    $acertou = ($q['correta'] === $resposta);
    $dif = $q['dificuldade'];
    $pontos = pontos_por_dificuldade($dif);

    if($acertou){
        $_SESSION['pontuacao'] = ($_SESSION['pontuacao'] ?? 0) + $pontos;
        $_SESSION['pergunta'] = ($_SESSION['pergunta'] ?? 1) + 1;
        $_SESSION['status'] = 'acertou';
        header('Location: sorteia_questao.php');
        exit;
    } else {
        // errou: perde metade do acumulado e fim
        $_SESSION['pontuacao'] = floor(($_SESSION['pontuacao'] ?? 0) / 2);
        $_SESSION['status'] = 'fim';
        header('Location: area_jogo.php');
        exit;
    }
}

header('Location: area_jogo.php');
exit;
