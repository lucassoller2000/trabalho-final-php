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
                <a href='home.php?p=plano/lista'>Ver registros</a>
                <a href='home.php?p=plano/cadastro'>Cadastrar</a>
                <div class ="pesquisa col-md-5">
                    <form name="form-pesquisa" action="" method="post">
                        <div class="form-group group-pesquisa">
                            <input  maxlength="255" type="text" name="pesquisa" class="form-control" placeholder="Pesquisar planos de saúde" required ><br>
                            <button class="btn btn-dark" type="submit" name="pesquisar">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    echo"
    </body>";

        include("conexao.php");
        $db = mysqli_select_db($conexao, $banco);
        if($metodo == "excluir" && $id){
            $sqlPaciente = "SELECT idPaciente FROM paciente WHERE idPlano = $id";
            $mostraPaciente= mysqli_query($conexao, $sqlPaciente); 
            $num_linhas=mysqli_num_rows($mostraPaciente);
            if($num_linhas > 0){
                for($i = 0; $i < $num_linhas; $i++){
                    $mostra_tabela = mysqli_fetch_array($mostraPaciente);
                    $sql = "UPDATE paciente SET idPlano = null WHERE idPaciente = $mostra_tabela[idPaciente]";
                    mysqli_query($conexao, $sql);
                }
            }
            $sql= "DELETE FROM planoDeSaude WHERE idPlano = $id";
            mysqli_query($conexao, $sql);
        }
        if (isset($_POST['pesquisar'])) {
            $sql = "SELECT * FROM planoDeSaude WHERE nome = '$_POST[pesquisa]' ORDER BY idPlano";
        } else {
            $sql = "SELECT * FROM planoDeSaude ORDER BY idPlano";
        }
        $mostra= mysqli_query($conexao, $sql); 
        $num_linhas=mysqli_num_rows($mostra);
        if($num_linhas > 0){
?>          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome do plano</th>
                <th scope="col">Desconto (%)</th>
                <th scope="col">Data de emissão</th>
                <th scope="col">Data de validade</th>
                <th scope="col">Empresa responsável</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
<?php
            for($i = 0; $i < $num_linhas; $i++){
                $mostra_tabela = mysqli_fetch_array($mostra);
                echo "<tr>
                        <th scope='row'>$mostra_tabela[idPlano]</th>
                        <td>$mostra_tabela[nome]</td>
                        <td>$mostra_tabela[beneficios]</td>
                        <td>$mostra_tabela[dataEmissao]</td>
                        <td>$mostra_tabela[validade]</td>
                        <td>$mostra_tabela[empresaPlano]</td>
                        <td><a href=?n=plano&id=$mostra_tabela[idPlano]>Alterar</a></td>
                        <td><a href=home.php?p=plano/lista&metodo=excluir&id=$mostra_tabela[idPlano]>Excluir</a></td>
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