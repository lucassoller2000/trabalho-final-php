<?php
    include("conexao.php");
    $db=mysqli_select_db($conexao, $banco);
    $sqlCirurgia = "SELECT SUM(precoComDesconto) AS precoTotal FROM cirurgia WHERE statusCirurgia IN ('Bem sucedida', 'Mal sucedida')";
    $estatistica = mysqli_query($conexao, $sqlCirurgia);
    $linhaCirurgia = mysqli_fetch_array($estatistica);
    $sqlConsulta = "SELECT SUM(precoComDesconto) AS precoTotal FROM consulta";
    $estatistica = mysqli_query($conexao, $sqlConsulta);
    $linhaConsulta = mysqli_fetch_array($estatistica);
    echo $linhaCirurgia['precoTotal']+$linhaConsulta['precoTotal'];
?>