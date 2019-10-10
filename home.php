<html>

<head>
<meta charset="utf-8">
<title>Sistema Interno do Hospital</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="home.css">
	<link rel="shortcut icon" href="./imagens/blue.png" type="image/x-icon" />
<head>

<body>
<?php
	session_start();
	if(isset($_POST['OK'])){
		$usuario=$_POST['usuario'];
		$senha=$_POST['senha'];
		include('conexao.php');
		$db = mysqli_select_db($conexao, $banco);
		$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and senha = '$senha'";
		$resultado = mysqli_query($conexao, $sql);
		if(mysqli_num_rows($resultado) > 0){
			$_SESSION['usuario']=$usuario;
			$_SESSION['senha']=$senha;
		}
		else{
			unset ($_SESSION['usuario']);
			unset ($_SESSION['senha']);
			header('location:login.php?p=1');
		}
	}
	$p=isset($_GET['p']) ? $_GET['p']:null;
	$n=isset($_GET['n']) ? $_GET['n']:null;
	$id=isset($_GET['id']) ? $_GET['id']:null;
	$metodo=isset($_GET['metodo']) ? $_GET['metodo']:null;
	if(isset($_SESSION['usuario']) && isset($_SESSION['senha']) && $_SESSION['usuario'] != null && $_SESSION['senha'] != null){
		if($p!=1){
?>
			<nav class='navbar navbar-expand-lg'>
				<ul class='navbar-nav mr-auto'>
					<span class='navbar-brand mb-0 h1'>Bem-vindo <?php echo $_SESSION['usuario']?></span>
				</ul>
			  	<form class='form-inline my-2 my-lg-0'>
			  		<a class='nav-item nav-link' href='?p=1'>Fazer logout?</a>
			  	</form>
			</nav>
			<div class="container">
				<div class="lateral">
					<ul>
						<div>
							<a href="home.php">Home</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=paciente/lista">Pacientes</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=medico/lista">Medicos</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=cirurgia/lista">Cirurgias</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=consulta/lista">Consultas</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=doacao-sangue/lista">Doação de Sangue</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=medicamento/lista">Medicamentos</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=ferramenta/lista">Ferramentas</a>
						</div>
					</ul>
					<ul>
						<div>
							<a href="?p=plano/lista">Planos de saúde vinculados</a>
						</div>
					</ul>
				</div>
				<div class="right">
					<div class="image">
						<img src="./imagens/grey2.jpg" alt="">
					</div>
					<div class="content">
						<?php 
						if($p=="medico/lista"){
							include("medico/lista-medico.php");
						}elseif($p=="medico/cadastro"){
							include("medico/cadastro-medico.php");
						}elseif ($n=="medico"){
							include("medico/altera-medico.php");
						}
						
						elseif($p=="paciente/lista"){
							include("paciente/lista-paciente.php");
						}elseif($p=="paciente/cadastro"){
							include("paciente/cadastro-paciente.php");
						}elseif ($n=="paciente"){
							include("paciente/altera-paciente.php");
						}
						
						elseif ($p=="medicamento/lista") {
							include("medicamento/lista-medicamento.php");
						}elseif ($p=="medicamento/cadastro") {
							include("medicamento/cadastro-medicamento.php");
						}elseif ($n=="medicamento"){
							include("medicamento/altera-medicamento.php");
						}
						
						elseif ($p=="cirurgia/lista") {
							include("cirurgia/lista-cirurgia.php");
						}elseif ($p=="cirurgia/cadastro") {
							include("cirurgia/cadastro-cirurgia.php");
						}elseif ($n=="cirurgia"){
							include("cirurgia/altera-cirurgia.php");
						}
						
						elseif ($p=="consulta/lista") {
							include("consulta/lista-consulta.php");
						}elseif ($p=="consulta/cadastro") {
							include("consulta/cadastro-consulta.php");
						}elseif ($n=="consulta"){
							include("consulta/altera-consulta.php");
						}
						
						elseif ($p=="doacao-sangue/lista") {
							include("doacao-de-sangue/lista-doacao-sangue.php");
						}elseif ($p=="doacao-sangue/cadastro") {
							include("doacao-de-sangue/cadastro-doacao-sangue.php");
						}elseif ($n=="doacao-sangue"){
							include("doacao-de-sangue/altera-doacao-sangue.php");
						}
						
						elseif ($p=="plano/lista"){
							include("plano-de-saude/lista-plano.php");
						}elseif ($p=="plano/cadastro"){
							include("plano-de-saude/cadastro-plano.php");
						}elseif ($n=="plano"){
							include("plano-de-saude/altera-plano.php");
						}
						
						elseif ($p=="ferramenta/lista") {
							include("ferramenta/lista-ferramenta.php");
						}elseif ($p=="ferramenta/cadastro") {
							include("ferramenta/cadastro-ferramenta.php");
						}elseif ($n=="ferramenta"){
							include("ferramenta/altera-ferramenta.php");
						}elseif(!$p){
							echo "<h1>Cirurgias do dia </h1>";
							include("cirurgia/lista-cirurgia.php");
						}
						?>
					</div>

					<?php
					if(!$p && !$n){
					?>
						<h2>Estatísticas</h2>
						<div class='estatisticas'>
							<div class="estatisticas-item">
								<h5 class="bg-dark">Total de cirurgias realizadas</h5>
								<h4><?php include("estatisticas/estatistica.php");?></h4>
							</div>
							<div class="estatisticas-item">
								<h5 class="bg-dark">Cirurgias bem sucedidas</h5>
								<h4><?php include("estatisticas/estatisticaBemSucedida.php")?></h4>
							</div>
							<div class="estatisticas-item">
								<h5 class="bg-dark">Total arrecadado no hospital</h5>
								<h4>R$ <?php include("estatisticas/estatisticaValor.php")?></h4>
							</div>
						</div>
					<?php
					}?>
				</div>
			</div>
<?php
		}
	}else{
		if($p != 1){
			header('location:login.php?p=1');
		}
	}
	if($p==1){
		session_destroy();
		header('location:login.php?p=2');
	}
?>
</body>
</html>