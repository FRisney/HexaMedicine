<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location:login.php');
	}
	date_default_timezone_set("America/Sao_Paulo");
	require 'config.php';
	$query = $db->query("SELECT * FROM usuario where login = '{$_SESSION['usuario']}'");
	$nome = $query->fetch_assoc();
	$dados = $nome['email']." | ".$nome['telefone'];
	$result = $db->query("SELECT * FROM nicho WHERE equip='{$nome['equip']}' order by idNicho");
	$agora = date('Y-m-d#H:i:s');
	$agoraU = date('U');
	$nomeRem = array(1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
	$hora = array(1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
	$status = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false);
	
	while($query = $result->fetch_assoc()){
		$status[$query["idNicho"]] = true;
		$w = 0;
		$freq = date($query["freq"]);
		$calc = new DateTime($query["hora"]);
		do{
			if($w == 0){$num = $freq * 0;}
			else{$num = $freq * 1;}
			$factor = "+".$num." hours";
			$calc->modify($factor);
			$w++;
			if($calc->format('U')>$agoraU){
				$nomeRem[$query["idNicho"]] = $query["nomeRem"];
				$hora[$query["idNicho"]] = $calc->format('H:i');
				$w = 25;
			}
		}while($w<=24);
	}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="br"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HexaMedicine - Home</title>
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
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <?php include('menu.php'); ?> <!--Barra lateral-->
	
    <div id="right-panel" class="right-panel">

	<?php include('header.php');?> <!--Topo da página-->

        <div class="content mt-3 animated fadeIn"> <!--Conteúdo-->
			<div class="row">
				<div class="col-md-6 offset-md-3 mr-auto ml-auto">
					<aside class="profile-nav alt">
						<section class="card">
							<div class="card-header user-header alt bg-dark">
								<div class="media">
									<a href="conta.php">
										<img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/profile/<?php echo $photo;?>.jpg">
									</a>
									<div class="media-body">
										<h2 class="text-light display-6"><?php echo $nome['nome']; ?></h2>
										<p><?php echo $dados;?></p>
									</div>
								</div>
							</div>


							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<a href="relatorio.php"> <i class="fa fa-tasks"></i> Remédios Agendados</a>
									<table id="bootstrap-data-table" class="table">
										<thead class="thead" align="center">
											<tr>
												<th>Nome</th>
												<th>Próximas liberações</th>
											</tr>
										</thead>
										<tbody align="center">
											<?php
												for($for=1;$for<=6;$for++){
													if($status[$for]){
														echo "<tr>";
														echo "<td>".$nomeRem[$for]."</td>";
														echo "<td>".$hora[$for]."</td>";
														echo "</tr>";
													}
												}
											?>
										</tbody>
									</table>
								</li>
							</ul>
						</section>
					</aside>
                </div>
			</div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/dashboard.js"></script>


</body>
</html>
