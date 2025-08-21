<?php
session_start();
require_once 'ConectaBanco.php';
require_once 'questoes_valores.php'; // Incluindo a tabela de valores

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
    
    // Obtém o valor da próxima pergunta
    $pergunta_atual_num = $_SESSION['pergunta'] ?? 1;
    $pontos = $questao_valor[$pergunta_atual_num - 1] ?? 0;

    if($acertou){
        $_SESSION['pontuacao'] = $pontos;
        $_SESSION['pergunta'] = ($pergunta_atual_num) + 1;
        $_SESSION['status'] = 'acertou';
        
        // Se acertou a última pergunta (16), ganha o prêmio máximo e finaliza o jogo
        if($pergunta_atual_num == 16){
            $_SESSION['status'] = 'fim_ganhou';
            header('Location: area_jogo.php');
            exit;
        }

        header('Location: sorteia_questao.php');
        exit;
    } else {
        // errou: perde metade do acumulado, exceto na pergunta 16
        if ($pergunta_atual_num == 16) {
             $_SESSION['pontuacao'] = 0;
        } else {
            $_SESSION['pontuacao'] = floor(($_SESSION['pontuacao'] ?? 0) / 2);
        }
        
        $_SESSION['status'] = 'fim';
        header('Location: area_jogo.php');
        exit;
    }
}

header('Location: area_jogo.php');
exit;
?>