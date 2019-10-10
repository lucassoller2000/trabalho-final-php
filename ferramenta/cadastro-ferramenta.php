<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php 
            include('conexao.php');
            if(isset($_POST['Cadastro-ferramenta'])){
                $db=mysqli_select_db($conexao, $banco);
                $sql="INSERT INTO ferramenta(nome, tipoFerramenta, material, quantidade)
                VALUES ('$_POST[nome]', '$_POST[tipoFerramenta]', '$_POST[material]', '$_POST[quantidade]')";
                $grava=mysqli_query($conexao, $sql);
                if($grava == true){
                    echo "<div class='alert alert-primary col-md-6' role='alert'>
                       Cadastro efetuado com sucesso!!
                   </div>";
                   }else{
                       echo "<div class='alert alert-danger col-md-6' role='alert'>
                       Cadastro não efetuado!!
                   </div>";
                }
            }
        ?>
        <div class="link">
            <a href="home.php?p=ferramenta/lista">Ver registros</a>
            <a href="home.php?p=ferramenta/cadastro">Cadastrar</a>
        </div>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Cadastro de estoque de ferramentas</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" maxlength="30" class="form-control" placeholder="Nome" required><br>
            </div>
            <div class="form-group">
                <label for="tipoFerramenta">Tipo de ferramenta</label>
                <input type="text" name="tipoFerramenta" maxlength="30" class="form-control" placeholder="Tipo de ferramenta" required><br>
            </div>
            <div class="form-group">
                <label for="material">Material</label>
                <input type="text" name="material" maxlength="30" class="form-control" placeholder="Material" required><br>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-ferramenta">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-ferramenta">
            </form>
        </div>
    </body>
</html>