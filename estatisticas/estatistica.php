<?php
    include("conexao.php");
    $db=mysqli_select_db($conexao, $banco);
    $sql = "SELECT COUNT(1) AS estatistica FROM cirurgia WHERE statusCirurgia IN ('Bem sucedida', 'Mal sucedida')";
    $estatistica = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_array($estatistica);
    echo $linha['estatistica'];
?>