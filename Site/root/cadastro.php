<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<?php
	$fusoHorario = date_default_timezone_set('America/Sao_Paulo');
	require 'config.php';
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HexaMedicine - Cadastro</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="" height="40%" width="40%">
                    </a>
                </div>
                <div class="login-form">
					<?php
						if($_POST){
							$login = $_POST['login'];
							$equip = $_POST['equip'];
							$query = $db->query("SELECT * FROM `usuario` WHERE `login` = '$login' OR `equip` = '$equip'");
							if($query->num_rows == 0){
								$query->close();
								$perfil = $db->prepare("INSERT INTO `usuario` (`equip`, `login`, `senha`, `dataCadastro`, `nome`, `email`, `telefone`) VALUES (?,?,?,?,?,?,?);");
								$perfil->bind_param('issssss',$equip,$login,$senha,$dataCadastro,$nome,$email,$telefone);
								$dataCadastro = date('y-m-d H:i:s');
								$equip = $_POST['equip'];
								$login = $_POST['login'];
								$senha = hash("sha256",$_POST['senha']);
								$nome = $_POST['nome'];
								$email = $_POST['email'];
								$telefone = $_POST['telefone'];
								
								$perfil->execute();
								$perfil->close();
								$db->close();
								
								header('location:login.php?status=cadastrado');			
							}else{
								require 'alerta.php';
								alerta("danger","Login ou Serial já cadastrado");
							}
							$db->close();
						}
					?>
                    <form method="post">
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" class="form-control" name="login">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="senha">
                        </div>
						<div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome">
                        </div>
						<div class="form-group">
                            <label>Numero Serial</label>
                            <input type="number" class="form-control" name="equip">
                        </div>
						<div class="form-group">
                            <label>Telefone</label>
                            <input type="tel" class="form-control" name="telefone" maxlength="15" placeholder="(__)___-___-___" data-mask="(00)000-000-000" data-mask-selectonfocus="true">
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> Aceito os Termos de Privacidade e Segurança
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Cadastrar</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Já possui uma conta? <a href="login.php"> Entrar</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
	<script src="assets/js/jquery.mask.min.js"></script>


</body>
</html>
