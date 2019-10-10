<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="link">
        <a href="home.php?p=medicamento/lista">Ver registros</a>
        <a href="home.php?p=medicamento/cadastro">Cadastrar</a>
    </div>
    <?php
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-medicamento'])){
        $sql = "UPDATE medicamento SET nome = '$_POST[nome]', tipo = '$_POST[tipo]', 
        quantidade = '$_POST[quantidade]', observacao= '$_POST[observacao]' WHERE idMedicamento = $id";
        $query = mysqli_query($conexao, $sql);
        if($query == true){
            echo "<div class='alert alert-primary col-md-6' role='alert'>
               Atualização efetuada com sucesso!!
           </div>";
           }else{
               echo "<div class='alert alert-danger col-md-6' role='alert'>
               Atualização não efetuada!!
           </div>";
        }
    }
    $sqlAltera = "SELECT * FROM medicamento WHERE idMedicamento = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados do estoque de medicamentos</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="<?php echo $linha['nome']; ?>"  maxlength="30" class="form-control" placeholder="Nome"><br>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de medicamento</label>
                <input type="text" name="tipo" value="<?php echo $linha['tipo']; ?>" maxlength="30" class="form-control" placeholder="Tipo de medicamento" required><br>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" value="<?php echo $linha['quantidade']; ?>" class="form-control" placeholder="Quantidade" required><br>
            </div>
            <div class="form-group">
                <label for="observacao">Observação</label>
                <input style="resize: none" rows="3" value="<?php echo $linha['observacao']; ?>" maxlength="255" type="text" name="observacao" class="form-control" placeholder="Observação"><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-medicamento">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-medicamento">
            </form>
        </div>
    </body>
</html>