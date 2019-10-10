<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="link">
        <a href="home.php?p=plano/lista">Ver registros</a>
        <a href="home.php?p=plano/cadastro">Cadastrar</a>
    </div>
    <?php
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-plano'])){
        $sql = "UPDATE planoDeSaude SET nome = '$_POST[nome]', beneficios = '$_POST[beneficios]', 
        dataEmissao = '$_POST[dataEmissao]', validade= '$_POST[validade]', empresaPlano= '$_POST[empresaPlano]' WHERE idPlano = $id";
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
    $sqlAltera = "SELECT * FROM planoDeSaude WHERE idPlano = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados da base de dados de planos de saúde</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="<?php echo $linha['nome']; ?>" maxlength="50" class="form-control" placeholder="Nome" required><br>
            </div>
            <div class="form-group">
                <label for="beneficios">Desconto</label>
                <input type="number" name="beneficios" value="<?php echo $linha['beneficios']; ?>" class="form-control" placeholder="Desconto (%)" required><br>
            </div>
            <div class="form-group">
                <label for="dataEmissao">Data de emissão</label>
                <input type="date" name="dataEmissao" value="<?php echo $linha['dataEmissao']; ?>" maxlength="10" class="form-control" placeholder="Data de emissão" required><br>
            </div>
            <div class="form-group">
                <label for="validade">Data de validade</label>
                <input type="date" name="validade" value="<?php echo $linha['validade']; ?>" maxlength="10" class="form-control" placeholder="Data de validade" required><br>
            </div>
            <div class="form-group">
                <label for="empresaPlano">Empresa responsável pelo plano de saúde</label>
                <input type="text" name="empresaPlano" value="<?php echo $linha['empresaPlano']; ?>" maxlength="30" class="form-control" placeholder="Empresa responsável pelo plano de saúde" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-plano">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-plano">
            </form>
        </div>
    </body>
</html>