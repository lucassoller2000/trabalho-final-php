<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <script>
            function formatar(mascara, documento){
            var i = documento.value.length;
            var saida = mascara.substring(0,1);
            var texto = mascara.substring(i)
            
            if (texto.substring(0,1) != saida){
                        documento.value += texto.substring(0,1);
            }
            
            }
        </script>
    </head>
    <body>
    <div class="link">
        <a href="home.php?p=doacao-sangue/lista">Ver registros</a>
        <a href="home.php?p=doacao-sangue/cadastro">Cadastrar</a>
    </div>
    <?php
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-doacao'])){
        $sql = "UPDATE doacaoSangue SET nomeDoador = '$_POST[nomeDoador]', cpfDoador = '$_POST[cpfDoador]', 
        tipoSanguineo = '$_POST[tipoSanguineo]', dataDoacao= '$_POST[dataDoacao]', 
        hora= '$_POST[hora]' WHERE idDoacao = $id";
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
    $sqlAltera = "SELECT * FROM doacaoSangue WHERE idDoacao = '$id'";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados da base de dados de doações de sangue</h2>
            <div class="form-group">
                <label for="nomeDoador">Nome do doador</label>
                <input type="text" name="nomeDoador" value= "<?php echo $linha['nomeDoador']; ?>" maxlength="50" class="form-control" placeholder="Nome do doador" required><br>
            </div>
            <div class="form-group">
                <label for="cpfDoador">CPF do doador</label>
                <input type="text" name="cpfDoador" value= "<?php echo $linha['cpfDoador']; ?>" maxlength="14" class="form-control" placeholder="CPF do doador" OnKeyPress="formatar('###.###.###-##', this)" required><br>
            </div>
            <div class="form-group">
            <label for="tipoSanguineo">Tipo Sanguíneo</label>
                <select id="tipoSanguineo" maxlength="3" class="form-control" name="tipoSanguineo" required>
                    <option selected><?php echo $linha['tipoSanguineo']; ?></option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="dataDoacao">Data da doação</label>
                <input type="date" name="dataDoacao" value= "<?php echo $linha['dataDoacao']; ?>" maxlength="10" class="form-control" placeholder="Data da doação" required><br>
            </div>
            <div class="form-group">
                <label for="hora">Hora da doação</label>
                <input type="time" name="hora" value= "<?php echo $linha['hora']; ?>" maxlength="5" class="form-control" placeholder="Hora da doação" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-doacao">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-doacao">
            </form>
        </div>
    </body>
</html>