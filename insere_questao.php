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

<div class="header">
  <div class="container inner">
    <a class="brand" href="index.php"><span class="coin"></span> Show do Milhão</a>
  </div>
</div>

<div class="container">
    <div class="card form-card">
        <h2 class="card-title">Cadastrar nova Questão</h2>
        <form action="insere_questao.php" method="post" class="form-grid">
            <label>Questão:</label>
            <input name="questao" type="text" required>
            
            <label>Alternativa 1:</label>
            <input name="alternativa1" type="text" required>
            
            <label>Alternativa 2:</label>
            <input name="alternativa2" type="text" required>
            
            <label>Alternativa 3:</label>
            <input name="alternativa3" type="text" required>
            
            <label>Alternativa 4:</label>
            <input name="alternativa4" type="text" required>
            
            <label>Correta:</label>
            <input name="correta" type="text" required>
            
            <label>Categoria:</label>
            <input name="categoria" type="text" required>
            
            <label>Dificuldade:</label>
            <input name="dificuldade" type="text" required>
            
            <input type="submit" value="Cadastrar" class="btn">
        </form>
    </div>
</div>

</body>
</html>