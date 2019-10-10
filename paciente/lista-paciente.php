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
                <a href='home.php?p=paciente/lista'>Ver registros</a>
                <a href='home.php?p=paciente/cadastro'>Cadastrar</a>
                <div class ="pesquisa col-md-5">
                    <form name="form-pesquisa" action="" method="post">
                        <div class="form-group group-pesquisa">
                            <input required maxlength="255" type="text" name="pesquisa" class="form-control" placeholder="Pesquisar pacientes por nome"><br>
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
            $sql= "DELETE FROM paciente WHERE idPaciente = $id";
            mysqli_query($conexao, $sql);
        }
        if(isset($_POST['pesquisar'])){
            $sql =  $sql = "SELECT * FROM paciente WHERE nome = '$_POST[pesquisa]' ORDER BY idPaciente";
        }else{
            $sql = "SELECT * FROM paciente ORDER BY idPaciente";
        }
        $mostra= mysqli_query($conexao, $sql); 
        $num_linhas=mysqli_num_rows($mostra);
        if($num_linhas > 0){
            for($i = 0; $i < $num_linhas; $i++){
                $mostra_tabela = mysqli_fetch_array($mostra);
                $db=mysqli_SELECT_db($conexao, $banco);
                $sqlPlano = "SELECT nome FROM planoDeSaude WHERE idPlano = '$mostra_tabela[idPlano]'";
                $query = mysqli_query($conexao, $sqlPlano);
                $nomePlano = null;
                while($linha = mysqli_fetch_array($query)){
                    $nomePlano = $linha["nome"];
                }
                $sqlEndereco = "SELECT * FROM endereco WHERE idPaciente = '$mostra_tabela[idPaciente]'";
                $query = mysqli_query($conexao, $sqlEndereco);
                $linha = mysqli_fetch_array($query);
                ?>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo sanguíneo</th>
                            <th scope="col">Data de nascimento</th>
                            <th scope="col">Estado civil</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Peso</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Telefone familiar</th>
                            <th scope="col">Plano de saúde</th>
                        </tr>
                    </thead>
                <tbody>
            <?php
                echo "<tr>
                        <th scope='row'>$mostra_tabela[idPaciente]</th>
                        <td>$mostra_tabela[nome]</td>
                        <td>$mostra_tabela[tipoSanguineo]</td>
                        <td>$mostra_tabela[dataNascimento]</td>
                        <td>$mostra_tabela[estadoCivil]</td>
                        <td>$mostra_tabela[cpf]</td>
                        <td>$mostra_tabela[sexo]</td>
                        <td>$mostra_tabela[peso]</td>
                        <td>$mostra_tabela[telefone]</td>
                        <td>$mostra_tabela[telefoneFamilia]</td>
                        <td>$nomePlano</td>
                    </tr>";
                ?>
                <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Rua</th>
                <th scope="col">Número</th>
                <th scope="col">Complemento</th>
                <th scope="col">Bairro</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">País</th>
                <th scope="col">CEP</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
            echo "<tr>
                    <th scope='row'>$linha[idEndereco]</th>
                    <td>$linha[rua]</td>
                    <td>$linha[numero]</td>
                    <td>$linha[complemento]</td>
                    <td>$linha[bairro]</td>
                    <td>$linha[cidade]</td>
                    <td>$linha[estado]</td>
                    <td>$linha[pais]</td>
                    <td>$linha[cep]</td>
                    <td><a href=?n=paciente&id=$mostra_tabela[idPaciente]>Alterar</a></td>
                    <td></td>
                </tr>
            </tbody>"; 
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