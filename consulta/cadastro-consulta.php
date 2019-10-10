<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">

    </head>
    <body>
        <?php 
            include('conexao.php');
            if(isset($_POST['Cadastro-consulta'])){
                $db=mysqli_select_db($conexao, $banco);
                $sqlPaciente = "SELECT * FROM paciente p left join planoDeSaude pl on p.idPlano = pl.idPlano WHERE p.nome = '$_POST[nomePaciente]'";
                $query = mysqli_query($conexao, $sqlPaciente);
                $beneficios = null;
                $idPaciente = null;
                $idMedico = null;
                while($linha = mysqli_fetch_array($query)){
                    $idPaciente = $linha["idPaciente"];
                    $beneficios = $linha["beneficios"];
                }
                $sqlMedico = "SELECT idMedico FROM medico WHERE nome = '$_POST[nomeMedico]'";
                $query = mysqli_query($conexao, $sqlMedico);
                while($linha = mysqli_fetch_array($query)){
                    $idMedico = $linha["idMedico"];
                }
                if($beneficios){
                    $precoComDesconto = ($_POST['preco'] * $beneficios) / 100;
                }else{
                    $precoComDesconto = $_POST['preco'];
                }
                $sql="INSERT INTO consulta(descricao, dataConsulta, hora, duracao, sala, preco, precoComDesconto, 
                idPaciente, idMedico)
                VALUES ('$_POST[descricao]', '$_POST[dataConsulta]', '$_POST[hora]', '$_POST[duracao]', 
                '$_POST[sala]', '$_POST[preco]', '$precoComDesconto', '$idPaciente', '$idMedico')";
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
            <a href="home.php?p=consulta/lista">Ver registros</a>
            <a href="home.php?p=consulta/cadastro">Cadastrar</a>
        </div>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Cadastro de consultas</h2>
            <div class="form-group">
                <label for="descricao">Descrição da consulta</label>
                <textarea style="resize: none" rows="3" maxlength="255" type="text" name="descricao" class="form-control" placeholder="Descrição da consulta" required></textarea><br>
            </div>
            <div class="form-group">
                <label for="dataConsulta">Data da consulta</label>
                <input type="date" name="dataConsulta" maxlength="10" class="form-control" placeholder="Data da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="hora">Hora da consulta</label>
                <input type="time" name="hora" maxlength="5" class="form-control" placeholder="Hora da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="duracao">Duração da consulta</label>
                <input type="time" name="duracao" maxlength="5" class="form-control" placeholder="Duração da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="number" name="sala" class="form-control" placeholder="Sala" required><br>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" class="form-control" placeholder="Preço (R$)" step="0.01" required><br>
            </div>
            <div class="form-group">
                <label for="nomePaciente">Nome do paciente</label>
                <input type="text" name="nomePaciente" maxlength="50" class="form-control" placeholder="Nome do paciente" required><br>
            </div>
            <div class="form-group">
                <label for="nomeMedico">Nome do medico</label>
                <input type="text" name="nomeMedico" maxlength="50" class="form-control" placeholder="Nome do médico" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-consulta">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-consulta">
            </form>
        </div>
    </body>
</html>