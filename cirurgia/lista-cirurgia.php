<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <?php
        if($p){
        ?><div class='link'>
            <a href='home.php?p=cirurgia/lista'>Ver registros</a>
            <a href='home.php?p=cirurgia/cadastro'>Cadastrar</a>
            <div class ="pesquisa col-md-9 pesquisa2">
                <form name="form-pesquisa" action="" method="post">
                    <div class="form-group group-pesquisa">
                        <input maxlength="255" type="text" name="pesquisaPaciente" class="form-control" placeholder="Pesquisar por pacientes" ><br>
                        <button class="btn btn-dark" type="submit" name="pesquisarPaciente">Pesquisar</button>
                        <input maxlength="255" type="text" name="pesquisaMedico" class="form-control another" placeholder="Pesquisar por médicos"z><br>
                        <button class="btn btn-dark" type="submit" name="pesquisarMedico">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
            <?php
        }
    ?>
    </body>
    <?php

        include("conexao.php");
        if($metodo == "excluir" && $id){
            $sql= "DELETE FROM cirurgia WHERE idCirurgia = $id";
            mysqli_query($conexao, $sql);
        }
        $db = mysqli_select_db($conexao, $banco);
        if($p){
            if (isset($_POST['pesquisarPaciente'])) {
                $sqlPaciente = "SELECT idPaciente FROM paciente WHERE nome = '$_POST[pesquisaPaciente]'";
                $query = mysqli_query($conexao, $sqlPaciente);
                $num_linhas=mysqli_num_rows($query);
                $linha = mysqli_fetch_array($query);
                $sql = "SELECT * FROM cirurgia WHERE idPaciente = '$linha[idPaciente]' ORDER BY idCirurgia";
            } elseif (isset($_POST['pesquisarMedico'])) {
                $sqlPaciente = "SELECT idMedico FROM medico WHERE nome like '$_POST[pesquisaMedico]'";
                $query = mysqli_query($conexao, $sqlPaciente);
                $num_linhas=mysqli_num_rows($query);
                $linha = mysqli_fetch_array($query);
                $sql = "SELECT * FROM cirurgia WHERE idMedico = '$linha[idMedico]' ORDER BY idCirurgia";
            } else{
                $sql = "SELECT * FROM cirurgia ORDER BY idCirurgia";
            }
        }else{
            date_default_timezone_set('America/Sao_Paulo');
            $dataHoje = date("Y-m-d");
            $sql = "SELECT * FROM cirurgia WHERE dataCirurgia = '$dataHoje' ORDER BY idCirurgia";
        }
        $mostra= mysqli_query($conexao, $sql); 
        $num_linhas=mysqli_num_rows($mostra);
        if($num_linhas > 0){
?>          
            <div>
                <div class="info">
                    <div class="bg-success info-box"></div>
                    <h5>Cirurgias bem sucedidas</h5>
                </div>
                <div class="info">
                    <div class="bg-danger info-box"></div>
                    <h5>Cirurgias mal sucedidas</h5>
                </div>               
            </div>
            <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Descrição</th>
                <th scope="col">Data</th>
                <th scope="col">Hora</th>
                <th scope="col">Duração</th>
                <th scope="col">Sala</th>
                <th scope="col">Preço</th>
                <th scope="col">Preço com desconto</th>
                <th scope="col">Nome do paciente</th>
                <th scope="col">Nome do médico</th>
                <th scope="col">Status</th>
                <?php 
                if($p){
                    echo "<th scope='col'></th>";
                }?>
                </tr>
            </thead>
            <tbody>
<?php
            for($i = 0; $i < $num_linhas; $i++){
                $mostra_tabela = mysqli_fetch_array($mostra);
                $db=mysqli_SELECT_db($conexao, $banco);
                $sqlPaciente = "SELECT nome FROM paciente WHERE idPaciente = '$mostra_tabela[idPaciente]'";
                $query = mysqli_query($conexao, $sqlPaciente);
                while($linha = mysqli_fetch_array($query)){
                    $nomePaciente = $linha["nome"];
                }
                $sqlMedico = "SELECT nome FROM medico WHERE idMedico = '$mostra_tabela[idMedico]'";
                $query = mysqli_query($conexao, $sqlMedico);
                while($linha = mysqli_fetch_array($query)){
                    $nomeMedico = $linha["nome"];
                }

                if($mostra_tabela['statusCirurgia'] == "Bem sucedida"){
                    echo "<tr class='bg-success'>";
                }elseif($mostra_tabela['statusCirurgia'] == "Mal sucedida"){
                    echo "<tr class='bg-danger'>";
                }else{
                    echo "<tr>";
                }
                    echo "<th scope='row'>$mostra_tabela[idCirurgia]</th>
                        <td>$mostra_tabela[descricao]</td>
                        <td>$mostra_tabela[dataCirurgia]</td>
                        <td>$mostra_tabela[hora]</td>
                        <td>$mostra_tabela[duracao]</td>
                        <td>$mostra_tabela[sala]</td>
                        <td>$mostra_tabela[preco]</td>
                        <td>$mostra_tabela[precoComDesconto]</td>
                        <td>$nomePaciente</td>
                        <td>$nomeMedico</td>
                        <td>$mostra_tabela[statusCirurgia]</td>";
                        if($p){
                            echo "<td><a href=?n=cirurgia&id=$mostra_tabela[idCirurgia]>Alterar</a></td>";
                        }
                    echo "</tr>";
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