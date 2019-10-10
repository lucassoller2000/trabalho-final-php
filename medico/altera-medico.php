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
        <a href="home.php?p=medico/lista">Ver registros</a>
        <a href="home.php?p=medico/cadastro">Cadastrar</a>
    </div>
    <?php
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-medico'])){
        $sql = "UPDATE medico SET nome = '$_POST[nome]', dataNascimento = '$_POST[dataNascimento]', 
        especializacao = '$_POST[especializacao]', cpf= '$_POST[cpf]', sexo= '$_POST[sexo]', 
        telefone= '$_POST[telefone]', salarioFixo= '$_POST[salarioFixo]' WHERE idMedico = $id";
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
    $sqlAltera = "SELECT * FROM medico WHERE idMedico = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados da base de dados de médicos</h2>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" value= "<?php echo $linha['nome']; ?>" maxlength="50" class="form-control" placeholder="Nome completo" required><br>
            </div>
            <div class="form-group">
                <label for="dataNascimento">Data de nascimento</label>
                <input type="date" name="dataNascimento" value= "<?php echo $linha['dataNascimento']; ?>" maxlength="10" class="form-control" placeholder="Data de nascimento" required=><br>
            </div>
            <div class="form-group">
                <label for="especializacao">Especialização</label>
                <input type="text" name="especializacao" value= "<?php echo $linha['especializacao']; ?>" maxlength="50" class="form-control" placeholder="Especialização" required><br>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" value= "<?php echo $linha['cpf']; ?>" maxlength="14" class="form-control" placeholder="CPF" required OnKeyPress="formatar('###.###.###-##', this)"><br>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" class="form-control" name="sexo" maxlength="9" required>
                    <option selected><?php echo $linha['sexo']; ?></option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="telefone">Telefone celular</label>
                <input type="tel" name="telefone" value= "<?php echo $linha['telefone']; ?>" maxlength="13" class="form-control" placeholder="Telefone celular (DDD)XXXXX-XXXX" 
                OnKeyPress="formatar('##-#####-####', this)"><br>
            </div>
            <div class="form-group">
                <label for="salarioFixo">Salário Fixo</label>
                <input type="number" name="salarioFixo" value= "<?php echo $linha['salarioFixo']; ?>" class="form-control" placeholder="Salário Fixo (R$)"step=".01" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-medico">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-medico">
            </form>
        </div>
    </body>
</html>