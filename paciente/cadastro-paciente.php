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
            if(isset($_POST['Cadastro-paciente'])){
                $db=mysqli_select_db($conexao, $banco);
                $idPlanoSaude = null;  
                $sql="INSERT INTO paciente(nome, tipoSanguineo, dataNascimento, estadoCivil, cpf, sexo,
                peso, renda, telefone, telefoneFamilia, idPlano)
                VALUES ('$_POST[nome]', '$_POST[tipoSanguineo]', '$_POST[dataNascimento]',
                '$_POST[estadoCivil]', '$_POST[cpf]', '$_POST[sexo]', '$_POST[peso]', '$_POST[renda]',
                '$_POST[telefone]', '$_POST[telefoneFamilia]', null)";
                $grava=mysqli_query($conexao, $sql);
                if($grava == true){
                    if($_POST['plano'] && !(empty($_POST['plano']))){
                        $sqlPlano = "SELECT idPlano FROM planoDeSaude WHERE nome = '$_POST[plano]'";
                        $query = mysqli_query($conexao, $sqlPlano);
                        while($linha = mysqli_fetch_array($query)){
                            $sqlComPlano = "UPDATE paciente SET idPlano = '$linha[idPlano]' WHERE cpf = $_POST[cpf]";
                            mysqli_query($conexao, $sqlComPlano); 
                        }
                    } 
                    $sqlPaciente = "SELECT idPaciente FROM paciente WHERE cpf = '$_POST[cpf]'";
                    $query = mysqli_query($conexao, $sqlPaciente);
                    while($linha = mysqli_fetch_array($query)){
                        $idPaciente = $linha["idPaciente"];
                    }
                    $sqlEndereco = "INSERT INTO endereco (rua, bairro, numero, complemento, cidade, estado,
                    pais, cep, idPaciente) VALUES ('$_POST[rua]', '$_POST[bairro]', '$_POST[numero]', 
                    '$_POST[complemento]', '$_POST[cidade]', '$_POST[estado]', '$_POST[pais]', '$_POST[cep]', 
                    '$idPaciente')";
                    $gravaEndereco = mysqli_query($conexao, $sqlEndereco);
                    if($gravaEndereco == true){
                        echo "<div class='alert alert-primary col-md-6' role='alert'>
                            Cadastro efetuado com sucesso!!
                        </div>";
                    }else{
                            echo "<div class='alert alert-danger col-md-6' role='alert'>
                            Cadastro não efetuado!!
                        </div>";
                    }
                }else{
                    echo "<div class='alert alert-danger col-md-6' role='alert'>
                            Cadastro não efetuado!!
                        </div>";
                }if($_GET['p']){
                    echo "<div class='link'>
                        <a href='home.php?p=paciente/lista'>Ver registros</a>
                        <a href='home.php?p=paciente/cadastro'>Cadastrar</a>
                    </div>";
                }
            }
        ?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Cadastro de pacientes</h2>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" maxlength="50" class="form-control" placeholder="Nome completo" required><br>
            </div>
            <div class="form-group">
                <label for="tipoSanguineo">Tipo Sanguíneo</label>
                <select id="tipoSanguineo" maxlength="3" class="form-control" name="tipoSanguineo" required>
                    <option selected></option>
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
                <input type="date" name="dataNascimento" maxlength="10" class="form-control" placeholder="Data de nascimento" required><br>
            </div>
            <div class="form-group">
                <label for="estadoCivil">Estado civil</label>
                <select id="estadoCivil" class="form-control" maxlength="8" name="estadoCivil" required><br>
                    <option selected></option>
                    <option>Solteiro</option>
                    <option>Casado</option>
                    <option>Separado</option>
                    <option>Viúvo</option>
                </select>
            </div>
            <div class="form-group">
            <br><label for="cpf">CPF</label>
                <input type="text" name="cpf" maxlength="14" class="form-control" placeholder="CPF" required OnKeyPress="formatar('###.###.###-##', this)"><br>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" class="form-control" maxlength="9" name="sexo" required>
                    <option selected></option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="peso">Peso</label>
                <input type="number" name="peso" class="form-control" placeholder="Peso (Kg)" step=".01" required><br>
            </div>
            <div class="form-group">
                <label for="renda">Renda</label>
                <input type="number" name="renda" class="form-control" placeholder="Renda (R$)" step=".01" required><br>
            </div>
            <div class="form-group">
                <label for="plano">Plano de saúde</label>
                <input type="text" name="plano" maxlength="50" class="form-control" placeholder="Plano de saúde"><br>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" maxlength="13" class="form-control" placeholder="Telefone celular" OnKeyPress="formatar('##-#####-####', this)"><br>
            </div>
            <div class="form-group">
                <label for="telefoneFamilia">Telefone do responsável</label>
                <input type="text" name="telefoneFamilia" maxlength="13" class="form-control" placeholder="Telefone do responsável" OnKeyPress="formatar('##-#####-####', this)"><br>
            </div>
            <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" name="rua" maxlength="30" class="form-control" placeholder="Rua" required><br>
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <input type="number" name="numero" class="form-control" placeholder="Número" required><br>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" maxlength="20" class="form-control" placeholder="Complemento"><br>
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" maxlength="15" class="form-control" placeholder="Bairro" required><br>
            </div>
            <div class="form-group">
                <label for="pais">País</label>
                <input type="text" name="pais" maxlength="30" class="form-control" placeholder="País" required><br>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" maxlength="30" class="form-control" placeholder="Estado" required><br>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" maxlength="30" class="form-control" placeholder="Cidade" required><br>
            </div>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" name="cep" maxlength="9" class="form-control" placeholder="CEP" OnKeyPress="formatar('#####-###', this)"><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-paciente">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-paciente">
            </form>
        </div>
    </body>
</html>