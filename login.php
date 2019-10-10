<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="login-style.css">
	<link rel="shortcut icon" href="./imagens/blue.png" type="image/x-icon" />
<head>

<body>
<div class="header">
	<h1>Sistema Interno do Hospital</h1>
</div>
<div class="container col-md-6">
	<div class="form-header">Login</div>
	<form action="home.php" method="post">
	<div class="form-group">
		<label for="email">Username</label>
		<input type="text" name="usuario" class="form-control" placeholder="Username"><br>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" name="senha" class="form-control" placeholder="Password"><br>
	</div>
	<input class="btn btn-primary" type="submit" value="Submit" name="OK">
	<input class="btn btn-primary" type="reset" value="Reset" name="Limpar">
</form>
</div>
<?php
	$p=isset($_GET['p']) ? $_GET['p']:null;
	if($p==1){
		echo "<div class='mensagem falha'>
					<h5>Login ou senha incorretos</h5>
			</div>";
	}else if($p==2){
		echo "<div class='mensagem falha'>
					<h5>Sessão terminada</h5>
			</div>";
	}else if($p==3){
		echo "<div class='mensagem falha'>
					<h5>Faça Login primeiro</h5>
			</div>";
	}
?>
</body>
</html>