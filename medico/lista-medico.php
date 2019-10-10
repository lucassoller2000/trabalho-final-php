<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
        if($_GET['p']){
            ?>
            <div class='link'>
                <a href='home.php?p=medico/lista'>Ver registros</a>
                <a href='home.php?p=medico/cadastro'>Cadastrar</a>
                <div class ="pesquisa col-md-5">
                    <form name="form-pesquisa" action="" method="post">
                        <div class="form-group group-pesquisa">
                            <input required maxlength="255" type="text" name="pesquisa" class="form-control" placeholder="Pesquisar médicos por nome"><br>
                            <button class="btn btn-dark" type="submit" name="pesquisar">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
        include("conexao.php");
        $db = mysqli_select_db($conexao, $banco);
        if(isset($_POST['pesquisar'])){
            $sql = "SELECT * FROM medico WHERE nome = '$_POST[pesquisa]' ORDER BY idMedico";
        }else{
            $sql = "SELECT * FROM medico ORDER BY idMedico";
        }
        $mostra= mysqli_query($conexao, $sql); 
        $num_linhas=mysqli_num_rows($mostra);
        if($num_linhas > 0){
?>          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de nascimento</th>
                <th scope="col">Especialização</th>
                <th scope="col">CPF</th>
                <th scope="col">Sexo</th>
                <th scope="col">Telefone</th>
                <th scope="col">Salário Fixo (R$)</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
<?php
            for($i = 0; $i < $num_linhas; $i++){
                $mostra_tabela = mysqli_fetch_array($mostra);
                echo "<tr>
                        <th scope='row'>$mostra_tabela[idMedico]</th>
                        <td>$mostra_tabela[nome]</td>
                        <td>$mostra_tabela[dataNascimento]</td>
                        <td>$mostra_tabela[especializacao]</td>
                        <td>$mostra_tabela[cpf]</td>
                        <td>$mostra_tabela[sexo]</td>
                        <td>$mostra_tabela[telefone]</td>
                        <td>$mostra_tabela[salarioFixo]</td>
                        <td><a href=?n=medico&id=$mostra_tabela[idMedico]>Alterar</a></td>
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