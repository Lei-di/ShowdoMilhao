<?php
session_start();
require_once 'ConectaBanco.php';

function pontos_por_dificuldade($dif){
  switch ($dif){
    case 'Fácil': return 100;
    case 'Média': return 500;
    case 'Difícil': return 1000;
    case 'Pergunta do Milhão': return 10000;
    default: return 100;
  }
}

$bd = new ConectaBanco();

// Ação de carta (50/50) antes de processar resposta
if(isset($_POST['acao']) && $_POST['acao'] === 'carta'){
    if(isset($_SESSION['cartas']) && $_SESSION['cartas'] > 0){
        // Seleciona 1 alternativa errada para esconder
        $q_id = (int)$_SESSION['questao_atual'];
        $res = $bd->query("SELECT * FROM questoes WHERE id='$q_id'");
        $q = mysqli_fetch_assoc($res);
        
        // Mapeia a alternativa correta para seu índice
        $opcoes = [
            $q['alternativa1'],
            $q['alternativa2'],
            $q['alternativa3'],
            $q['alternativa4']
        ];
        $correta_index = array_search($q['correta'], $opcoes);
        
        // Encontra os índices das alternativas erradas que ainda não foram removidas
        $removed_indices = isset($_SESSION['carta_removidas']) ? $_SESSION['carta_removidas'] : [];
        $indices_errados_disponiveis = [];
        for ($i=0; $i<4; $i++){
            if($i != $correta_index && !in_array($i, $removed_indices)){
                $indices_errados_disponiveis[] = $i;
            }
        }
        
        // Se houver alternativas erradas disponíveis, remove uma delas
        if (!empty($indices_errados_disponiveis)) {
            $index_to_remove = array_rand($indices_errados_disponiveis);
            $_SESSION['carta_removidas'][] = $indices_errados_disponiveis[$index_to_remove];
            $_SESSION['cartas'] -= 1; // Decrementa o contador de cartas após a remoção
            $_SESSION['status'] = 'carta';
        }
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
    
    // A dificuldade para a pontuação agora depende do número da pergunta
    function dificuldade_por_pergunta($n){
        if ($n >= 1 && $n <= 5) return 'Fácil';
        if ($n >= 6 && $n <= 10) return 'Média';
        if ($n >= 11 && $n <= 15) return 'Difícil';
        if ($n == 16) return 'Pergunta do Milhão';
        return 'Fácil';
    }
    $dif = dificuldade_por_pergunta($_SESSION['pergunta'] ?? 1);
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