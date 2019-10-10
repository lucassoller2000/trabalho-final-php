<?php
    $servidor= 'localhost';
    $usuarioBanco='root';
    $senhaBanco='';
    $banco='hospital';
    $conexao= mysqli_connect($servidor, $usuarioBanco, $senhaBanco, $banco) or die;    
?>