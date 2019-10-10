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
        <a href="home.php?p=paciente/lista">Ver registros</a>
        <a href="home.php?p=paciente/cadastro">Cadastrar</a>
    </div>
    <?php
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-paciente'])){
        $sql = "UPDATE paciente SET nome = '$_POST[nome]', tipoSanguineo = '$_POST[tipoSanguineo]', 
        dataNascimento = '$_POST[dataNascimento]', estadoCivil= '$_POST[estadoCivil]', cpf= '$_POST[cpf]', 
        estadoCivil= '$_POST[estadoCivil]', sexo= '$_POST[sexo]', peso= '$_POST[peso]', renda= '$_POST[renda]', 
        telefone= '$_POST[telefone]', telefoneFamilia= '$_POST[telefoneFamilia]' WHERE idPaciente = $id";

        $sqlEndereco = "UPDATE endereco SET rua= '$_POST[rua]', numero= '$_POST[numero]', 
        complemento= '$_POST[complemento]', bairro= '$_POST[bairro]', pais= '$_POST[pais]', estado= '$_POST[estado]',
        cidade= '$_POST[cidade]', cep= '$_POST[cep]' WHERE idPaciente = $id";
        $query = mysqli_query($conexao, $sql);
        $queryEndereco = mysqli_query($conexao, $sqlEndereco);
        if($query == true && $queryEndereco == true){
         echo "<div class='alert alert-primary col-md-6' role='alert'>
            Atualização efetuada com sucesso!!
        </div>";
        }else{
            echo "<div class='alert alert-danger col-md-6' role='alert'>
            Atualização não efetuada!!
        </div>";
        }
    }
    $sqlAltera = "SELECT * FROM paciente WHERE idPaciente = $id";
    $sqlEndereco= "SELECT * FROM endereco WHERE idPaciente = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $queryEndereco = mysqli_query($conexao, $sqlEndereco);
    $linha = mysqli_fetch_array($query);
    $linhaEndereco = mysqli_fetch_array($queryEndereco);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados da base de dados de pacientes</h2>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" value= "<?php echo $linha['nome'];?>" maxlength="50" class="form-control" placeholder="Nome completo" required><br>
            </div>
            <div class="form-group">
                <label for="tipoSanguineo">Tipo Sanguíneo</label>
                <select id="tipoSanguineo" maxlength="3" class="form-control" name="tipoSanguineo" required>
                    <option selected><?php echo $linha['tipoSanguineo'];?></option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                </select>
            </div>
            <div class="form-group">
            <br><label for="dataNascimento">Data de nascimento</label>
                <input type="date" name="dataNascimento" value= "<?php echo $linha['dataNascimento'];?>" maxlength="10" class="form-control" placeholder="Data de nascimento" required><br>
            </div>
            <div class="form-group">
                <label for="estadoCivil">Estado civil</label>
                <select id="estadoCivil" class="form-control" maxlength="8" name="estadoCivil" required><br>
                    <option selected><?php echo $linha['estadoCivil'];?></option>
                    <option>Solteiro</option>
                    <option>Casado</option>
                    <option>Separado</option>
                    <option>Viúvo</option>
                </select>
            </div>
            <div class="form-group">
            <br><label for="cpf">CPF</label>
                <input type="text" name="cpf" value= "<?php echo $linha['cpf'];?>" maxlength="14" class="form-control" placeholder="CPF" required OnKeyPress="formatar('###.###.###-##', this)"><br>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" class="form-control" maxlength="9" name="sexo" required>
                    <option selected><?php echo $linha['sexo'];?></option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="peso">Peso</label>
                <input type="number" name="peso" value= "<?php echo $linha['peso'];?>" class="form-control" placeholder="Peso (Kg)" step=".01" required><br>
            </div>
            <div class="form-group">
                <label for="renda">Renda</label>
                <input type="number" name="renda" value= "<?php echo $linha['renda'];?>" class="form-control" placeholder="Renda (R$)" step=".01" required><br>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" value= "<?php echo $linha['telefone'];?>" maxlength="13" class="form-control" placeholder="Telefone celular" OnKeyPress="formatar('##-#####-####', this)"><br>
            </div>
            <div class="form-group">
                <label for="telefoneFamilia">Telefone do responsável</label>
                <input type="text" name="telefoneFamilia" value= "<?php echo $linha['telefoneFamilia'];?>" maxlength="13" class="form-control" placeholder="Telefone do responsável" OnKeyPress="formatar('##-#####-####', this)"><br>
            </div>
            <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" name="rua" value= "<?php echo $linhaEndereco['rua'];?>" maxlength="30" class="form-control" placeholder="Rua" required><br>
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <input type="number" name="numero" value= "<?php echo $linhaEndereco['numero'];?>" class="form-control" placeholder="Número" required><br>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" value= "<?php echo $linhaEndereco['complemento'];?>" maxlength="20" class="form-control" placeholder="Complemento"><br>
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" value= "<?php echo $linhaEndereco['bairro'];?>" maxlength="15" class="form-control" placeholder="Bairro" required><br>
            </div>
            <div class="form-group">
                <label for="pais">País</label>
                <input type="text" name="pais" value= "<?php echo $linhaEndereco['pais'];?>" maxlength="30" class="form-control" placeholder="País" required><br>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" value= "<?php echo $linhaEndereco['estado'];?>" maxlength="30" class="form-control" placeholder="Estado" required><br>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" value= "<?php echo $linhaEndereco['cidade'];?>" maxlength="30" class="form-control" placeholder="Cidade" required><br>
            </div>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" name="cep" value= "<?php echo $linhaEndereco['cep'];?>" maxlength="9" class="form-control" placeholder="CEP" OnKeyPress="formatar('#####-###', this)"><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-paciente">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-paciente">
            </form>
        </div>
    </body>
</html>