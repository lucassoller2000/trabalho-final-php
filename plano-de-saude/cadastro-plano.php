<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php 
            include('conexao.php');
            if(isset($_POST['Cadastro-plano'])){
                $db=mysqli_select_db($conexao, $banco);
                $sql="INSERT INTO planoDeSaude(nome, beneficios, dataEmissao, validade, empresaPlano)
                VALUES ('$_POST[nome]', '$_POST[beneficios]','$_POST[dataEmissao]','$_POST[validade]', 
                '$_POST[empresaPlano]')";
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
            }if($_GET['p']){
                echo "<div class='link'>
                    <a href='home.php?p=plano/lista'>Ver registros</a>
                    <a href='home.php?p=plano/cadastro'>Cadastrar</a>
                </div>";
            }
        ?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Cadastro de planos de saúde vinculados ao Hospital</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" maxlength="50" class="form-control" placeholder="Nome" required><br>
            </div>
            <div class="form-group">
                <label for="beneficios">Desconto</label>
                <input type="number" name="beneficios" class="form-control" placeholder="Desconto (%)" required><br>
            </div>
            <div class="form-group">
                <label for="dataEmissao">Data de emissão</label>
                <input type="date" name="dataEmissao" maxlength="10" class="form-control" placeholder="Data de emissão" required><br>
            </div>
            <div class="form-group">
                <label for="validade">Data de validade</label>
                <input type="date" name="validade" maxlength="10" class="form-control" placeholder="Data de validade" required><br>
            </div>
            <div class="form-group">
                <label for="empresaPlano">Empresa responsável pelo plano de saúde</label>
                <input type="text" name="empresaPlano" maxlength="30" class="form-control" placeholder="Empresa responsável pelo plano de saúde" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-plano">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-plano">
            </form>
        </div>
    </body>
</html>