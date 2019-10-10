<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="link">
        <a href="home.php?p=ferramenta/lista">Ver registros</a>
        <a href="home.php?p=ferramenta/cadastro">Cadastrar</a>
    </div>
    <?php
    
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-ferramenta'])){
        $sql = "UPDATE ferramenta SET nome = '$_POST[nome]', tipoFerramenta = '$_POST[tipoFerramenta]', 
        material = '$_POST[material]', quantidade= '$_POST[quantidade]' WHERE idFerramenta = $id";
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
    $sqlAltera = "SELECT * FROM ferramenta WHERE idFerramenta = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados do estoque de ferramentas</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $linha['nome']; ?>" placeholder="Nome"><br>
            </div>
            <div class="form-group">
                <label for="tipoFerramenta">Tipo de ferramenta</label>
                <input type="text" name="tipoFerramenta" class="form-control" value="<?php echo $linha['tipoFerramenta'];?>" placeholder="Tipo de ferramenta"><br>
            </div>
            <div class="form-group">
                <label for="material">Material</label>
                <input type="text" name="material" class="form-control" value="<?php echo $linha['material'];?>" placeholder="Material"><br>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" value="<?php echo $linha['quantidade'];?>" placeholder="Quantidade"><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-ferramenta">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-ferramenta">
            </form>
        </div>
    </body>
</html>