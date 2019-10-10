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
        <?php 
            include('conexao.php');
            if(isset($_POST['Cadastro-medico'])){
                $db=mysqli_select_db($conexao, $banco);
                $sql="INSERT INTO medico(nome, dataNascimento, especializacao, cpf, sexo, telefone)
                VALUES ('$_POST[nome]', '$_POST[dataNascimento]', '$_POST[especializacao]', 
                '$_POST[cpf]', '$_POST[sexo]', '$_POST[telefone]')";
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
            if($_GET['p']){
                echo "<div class='link'>
                    <a href='home.php?p=medico/lista'>Ver registros</a>
                    <a href='home.php?p=medico/cadastro'>Cadastrar</a>
                </div>";
            }
        ?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Cadastro de médicos</h2>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" maxlength="50" class="form-control" placeholder="Nome completo" required><br>
            </div>
            <div class="form-group">
                <label for="dataNascimento">Data de nascimento</label>
                <input type="date" name="dataNascimento" maxlength="10" class="form-control" placeholder="Data de nascimento" required=><br>
            </div>
            <div class="form-group">
                <label for="especializacao">Especialização</label>
                <input type="text" name="especializacao" maxlength="50" class="form-control" placeholder="Especialização" required><br>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" maxlength="14" class="form-control" placeholder="CPF" required OnKeyPress="formatar('###.###.###-##', this)"><br>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" class="form-control" name="sexo" maxlength="9" required>
                    <option selected></option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="telefone">Telefone celular</label>
                <input type="tel" name="telefone" maxlength="13" class="form-control" placeholder="Telefone celular (DDD)XXXXX-XXXX" 
                OnKeyPress="formatar('##-#####-####', this)"><br>
            </div>
            <div class="form-group">
                <label for="salarioFixo">Salário Fixo</label>
                <input type="number" name="salarioFixo" class="form-control" placeholder="Salário Fixo (R$)"step=".01" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-medico">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-medico">
            </form>
        </div>
    </body>
</html>