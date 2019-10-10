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
    $id = $_GET['id'];
    include('conexao.php');
    $db = mysqli_select_db($conexao, $banco);
    if(isset($_POST['Cadastro-cirurgia'])){
        $sql = "UPDATE cirurgia SET descricao = '$_POST[descricao]', tipo = '$_POST[tipo]', 
        dataCirurgia = '$_POST[dataCirurgia]', hora= '$_POST[hora]', duracao= '$_POST[duracao]', 
        sala= '$_POST[sala]', preco= '$_POST[preco]', statusCirurgia= '$_POST[statusCirurgia]' 
        WHERE idCirurgia = $id";
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
    $sqlAltera = "SELECT * FROM cirurgia WHERE idCirurgia = $id";
    $query = mysqli_query($conexao, $sqlAltera);
    $linha = mysqli_fetch_array($query);
?>
        <div class="link">
            <a href="home.php?p=cirurgia/lista">Ver registros</a>
            <a href="home.php?p=cirurgia/cadastro">Cadastrar</a>
        </div>
        <div class="cadastro-container col-md-6">
            <form action="" method="post">
            <h2>Alterar dados da base de dados de cirurgias</h2>
            <div class="form-group">
                <label for="descricao">Descrição da cirurgia</label>
                <input style="resize: none" rows="3" value="<?php echo $linha['descricao']; ?>"  maxlength="255" type="text" name="descricao" class="form-control" placeholder="Descrição da cirurgia" required size="1"><br>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de cirurgia</label>
                <input type="text" name="tipo" value="<?php echo $linha['tipo']; ?>"  maxlength="30" class="form-control" placeholder="Tipo de cirurgia" required size="5"><br>
            </div>
            <div class="form-group">
                <label for="dataCirurgia">Data da cirurgia</label>
                <input type="date" name="dataCirurgia" value="<?php echo $linha['dataCirurgia']; ?>"  maxlength="10" class="form-control" placeholder="Data da cirurgia" required><br>
            </div>
            <div class="form-group">
                <label for="hora">Hora da cirurgia</label>
                <input type="time" name="hora" value="<?php echo $linha['hora']; ?>"  maxlength="5" class="form-control" placeholder="Hora da cirurgia" required><br>
            </div>
            <div class="form-group">
                <label for="duracao">Duração da cirurgia</label>
                <input type="time" name="duracao" value="<?php echo $linha['duracao']; ?>"  maxlength="5" class="form-control" placeholder="Duração da cirurgia" required><br>
            </div>
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="number" name="sala" value="<?php echo $linha['sala']; ?>"  class="form-control" placeholder="Sala" required><br>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" value="<?php echo $linha['preco']; ?>"  class="form-control" placeholder="Preço (R$)" step="0.01" required><br>
            </div>
            <div class="form-group">
                <label for="statusCirurgia">Status da cirurgia</label>
                <select id="statusCirurga" class="form-control" maxlength="14" name="statusCirurgia" required>
                    <option selected><?php echo $linha['statusCirurgia']; ?></option>
                    <option>Não realizada</option>
                    <option>Bem sucedida</option>
                    <option>Mal sucedida</option>
                </select>
            </div><br>
            <input class="btn btn-primary" type="submit" value="Enviar" name="Cadastro-cirurgia">
            <input class="btn btn-primary" type="reset" value="Resetar" name="Limpar-cirurgia">
            </form>
        </div>
    </body>
</html>