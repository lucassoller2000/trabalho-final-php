<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="link">
        <a href="home.php?p=ferramenta/lista">Ver registros</a>
        <a href="home.php?p=ferramenta/cadastro">Cadastrar</a>
        <div class ="pesquisa col-md-5">
            <form name="form-pesquisa" action="" method="post">
                <div class="form-group group-pesquisa">
                    <input maxlength="255" type="text" name="pesquisa" class="form-control" placeholder="Pesquisar ferramentas" required ><br>
                    <button class="btn btn-dark" type="submit" name="pesquisar">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
    </body>
    <?php
        include("conexao.php");
        $db = mysqli_select_db($conexao, $banco);
        if($metodo == "excluir" && $id){
            $sql= "DELETE FROM ferramenta WHERE idFerramenta = $id";
            mysqli_query($conexao, $sql);
        }
        if(isset($_POST['pesquisar'])){
            $sql = "SELECT * FROM ferramenta WHERE nome = '$_POST[pesquisa]' ORDER BY idFerramenta";
        } else {
            $sql = "SELECT * FROM ferramenta ORDER BY idFerramenta";
        }
        $mostra= mysqli_query($conexao, $sql); 
        $num_linhas=mysqli_num_rows($mostra);
        if($num_linhas > 0){
?>          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Tipo</th>
                <th scope="col">Material</th>
                <th scope="col">Quantidade</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
<?php
            for($i = 0; $i < $num_linhas; $i++){
                $mostra_tabela = mysqli_fetch_array($mostra);

                echo "<tr>
                        <th scope='row'>$mostra_tabela[idFerramenta]</th>
                        <td>$mostra_tabela[nome]</td>
                        <td>$mostra_tabela[tipoFerramenta]</td>
                        <td>$mostra_tabela[material]</td>
                        <td>$mostra_tabela[quantidade]</td>
                        <td><a href=?n=ferramenta&id=$mostra_tabela[idFerramenta]>Alterar</a></td>
                        <td><a href=home.php?p=ferramenta/lista&metodo=excluir&id=$mostra_tabela[idFerramenta]>Excluir</a></td>
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