<?php require_once __DIR__ . '/style_inject.php'; ?>
<?php
    if( isset($_POST['questao'])){
        $questao = $_POST['questao'];
        $alternativa1 = $_POST['alternativa1'];
        $alternativa2 = $_POST['alternativa2'];
        $alternativa3 = $_POST['alternativa3'];
        $alternativa4 = $_POST['alternativa4'];
        $correta      = $_POST['correta'];

        $categoria = $_POST['categoria'];
        $dificuldade = $_POST['dificuldade'];

        require_once 'ConectaBanco.php';

        $bd = new ConectaBanco();

        $SQL = "INSERT INTO `questoes`(`questao`, `alternativa1`, `alternativa2`, `alternativa3`, `alternativa4`, `correta`, `categoria`, `dificuldade`) ". 
                                        " VALUES('$questao','$alternativa1','$alternativa2','$alternativa3','$alternativa4','$correta','$categoria','$dificuldade')";
        
        $bd->query($SQL);
        if(mysqli_error($bd->con)){
            die("Houve um erro: " .mysqli_error($bd->con));
        }                    
    }
?>


<form action="insere_questao.php" method="post">
    Questao: <input name="questao"> <br>
    Alt 1: <input name="alternativa1"> <br>
    Alt 2: <input name="alternativa2"> <br>
    Alt 3: <input name="alternativa3"> <br>
    Alt 4: <input name="alternativa4"> <br>
    Correta: <input name="correta"> <br>
    Categoria: <input name="categoria"> <br>
    Dificuldade: <input name="dificuldade"> <br>

    <input type="submit" value="Cadastrar">

</form>
</body>
</html>
