<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php 
            include('conexao.php');
            if(isset($_POST['Cadastro-medicamento'])){
                $db=mysqli_select_db($conexao, $banco);
                $sql="INSERT INTO medicamento(nome, tipo, quantidade, observacao)
                VALUES ('$_POST[nome]', '$_POST[tipo]', '$_POST[quantidade]', '$_POST[observacao]')";
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
                    <a href='home.php?p=medicamento/lista'>Ver registros</a>
                    <a href='home.php?p=medicamento/cadastro'>Cadastrar</a>
                </div>";
            }
            
        ?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Cadastro de estoque de medicamentos</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" maxlength="30" class="form-control" placeholder="Nome"><br>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de medicamento</label>
                <input type="text" name="tipo" maxlength="30" class="form-control" placeholder="Tipo de medicamento" required><br>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" required><br>
            </div>
            <div class="form-group">
                <label for="observacao">Observação</label>
                <textarea style="resize: none" rows="3" maxlength="255" type="text" name="observacao" class="form-control" placeholder="Observação"></textarea><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-medicamento">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-medicamento">
            </form>
        </div> 
    </body>
</html>