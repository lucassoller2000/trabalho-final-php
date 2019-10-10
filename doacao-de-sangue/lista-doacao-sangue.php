<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
        if($_GET['p']){
            ?><div class='link'>
                <a href='home.php?p=doacao-sangue/lista'>Ver registros</a>
                <a href='home.php?p=doacao-sangue/cadastro'>Cadastrar</a>
                <div class ="pesquisa col-md-5">
                    <form name="form-pesquisa" action="" method="post">
                        <div class="form-group group-pesquisa">
                            <input maxlength="255" type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por nome do doador" required ><br>
                            <button class="btn btn-dark" type="submit" name="pesquisar">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div><?php
        }
        include("conexao.php");
        $db = mysqli_select_db($conexao, $banco);
        if($metodo == "excluir" && $id){
            $sql= "DELETE FROM doacaoSangue WHERE idDoacao = $id";
            mysqli_query($conexao, $sql);
        }
        if (isset($_POST['pesquisar'])) {
            $sql = "SELECT * FROM doacaoSangue WHERE nomeDoador = '$_POST[pesquisa]' ORDER BY idDoacao";
        }else{
            $sql = "SELECT * FROM doacaoSangue ORDER BY idDoacao";
        }
        $mostra= mysqli_query($conexao, $sql); 
        $num_linhas=mysqli_num_rows($mostra);
        if($num_linhas > 0){
?>          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome do doador</th>
                <th scope="col">CPF do doador</th>
                <th scope="col">Tipo sanguíneo</th>
                <th scope="col">Data</th>
                <th scope="col">Hora</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
<?php
            for($i = 0; $i < $num_linhas; $i++){
                $mostra_tabela = mysqli_fetch_array($mostra);
                echo "<tr>
                        <th scope='row'>$mostra_tabela[idDoacao]</th>
                        <td>$mostra_tabela[nomeDoador]</td>
                        <td>$mostra_tabela[cpfDoador]</td>
                        <td>$mostra_tabela[tipoSanguineo]</td>
                        <td>$mostra_tabela[dataDoacao]</td>
                        <td>$mostra_tabela[hora]</td>
                        <td><a href=?n=doacao-sangue&id=$mostra_tabela[idDoacao]>Alterar</a></td>
                    </tr>";
            }
            echo"</tbody>
            </table>";
        }else{
            ?><div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Não há nenhum registro cadastrado</h1>
            </div>
          </div><?php
        }
        mysqli_close($conexao);
?>
    </body>
</html>