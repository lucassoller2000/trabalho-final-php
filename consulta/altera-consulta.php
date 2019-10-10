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
            <a href="home.php?p=consulta/lista">Ver registros</a>
            <a href="home.php?p=consulta/cadastro">Cadastrar</a>
        </div>
    <?php
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-consulta'])){
        $sql = "UPDATE consulta SET descricao = '$_POST[descricao]', dataConsulta = '$_POST[dataConsulta]', 
        hora= '$_POST[hora]', duracao= '$_POST[duracao]', sala= '$_POST[sala]', 
        preco= '$_POST[preco]' WHERE idConsulta = $id";
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
    $sqlAltera = "SELECT * FROM consulta WHERE idConsulta = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados da base de dados de consultas</h2>
            <div class="form-group">
                <label for="descricao">Descrição da consulta</label>
                <input style="resize: none" rows="3" value= "<?php echo $linha['descricao']; ?>" maxlength="255" type="text" name="descricao" class="form-control" placeholder="Descrição da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="dataConsulta">Data da consulta</label>
                <input type="date" name="dataConsulta" value= "<?php echo $linha['dataConsulta']; ?>" maxlength="10" class="form-control" placeholder="Data da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="hora">Hora da consulta</label>
                <input type="time" name="hora" value= "<?php echo $linha['hora']; ?>" maxlength="5" class="form-control" placeholder="Hora da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="duracao">Duração da consulta</label>
                <input type="time" name="duracao" value= "<?php echo $linha['duracao']; ?>" maxlength="5" class="form-control" placeholder="Duração da consulta" required><br>
            </div>
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="number" name="sala" value= "<?php echo $linha['sala']; ?>" class="form-control" placeholder="Sala" required><br>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" value= "<?php echo $linha['preco']; ?>" class="form-control" placeholder="Preço (R$)" step="0.01" required><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-consulta">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-consulta">
            </form>
        </div>
    </body>
</html>