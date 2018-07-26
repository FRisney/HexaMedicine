<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location:login.php');
	}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HexaMedicine - Agendamento</title>
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

</head
<body>
    <?php include('menu.php'); ?> <!--Barra lateral-->
	
    <div id="right-panel" class="right-panel">

		<?php include('header.php');?> <!--Topo da página-->

        <div class="content mt-3 animated fadeIn"> <!--Conteúdo-->
			<div class="row">
				<div class="col-lg-8 offset-md mr-auto ml-auto">
					<?php
							switch(@$_GET['status']){
								case "notinserted";
									require 'alerta.php';
									alerta("danger","Nicho já preenchido!");
								break;
								case "inserted";
									require 'alerta.php';
									alerta("success","Nicho preenchido!");
								break;
								case "clear";
									require 'alerta.php';
									alerta("info","Nicho despreenchido!");
							}
					?>
					<div class="col-lg-7"> <!--Nicho 1-->
						<div class="card">
							<div class="card-body">
								<!-- Credit Card -->
								<div id="pay-invoice">
									<div class="card-body">
										<div class="card-title">
											<h3 class="text-center">Inserir</h3>
										</div>
										<hr>
										<form action="nicho.php" method="post">
											
											<div class="row form-group" align="center">
												<div class="col col-md-4">
													<div class="form-check">
														<div class="radio">
															<label for="radio1i" class="form-check-label ">
																<input type="radio" id="radio1i" name="id" value="1" class="form-check-input">Nicho 1
															</label>
														</div>
														<div class="radio">
															<label for="radio2i" class="form-check-label ">
																<input type="radio" id="radio2i" name="id" value="2" class="form-check-input">Nicho 2
															</label>
														</div>
													</div>
												</div>
												<div class="col col-md-4">
													<div class="form-check">
														<div class="radio">
															<label for="radio3i" class="form-check-label ">
																<input type="radio" id="radio3i" name="id" value="3" class="form-check-input">Nicho 3
															</label>
														</div>
														<div class="radio">
															<label for="radio4i" class="form-check-label ">
																<input type="radio" id="radio4i" name="id" value="4" class="form-check-input">Nicho 4
															</label>
														</div>
													</div>
												</div>
												<div class="col col-md-4">
													<div class="form-check">
														<div class="radio">
															<label for="radio5i" class="form-check-label ">
																<input type="radio" id="radio5i" name="id" value="5" class="form-check-input">Nicho 5
															</label>
														</div>
														<div class="radio">
															<label for="radio6i" class="form-check-label ">
																<input type="radio" id="radio6i" name="id" value="6" class="form-check-input">Nicho 6
															</label>
														</div>
													</div>
												</div>
											</div>
											<hr>
											<div class="form-group">
												<label class="control-label mb-1">Nome do Remédio</label>
												<input name="rem" type="text" class="form-control" value="">
											</div>
											<div class="row">
												<div class="col-6">
													<div class="form-group">
														<label class="control-label mb-1">Horário Inicial</label>
														<input name="hora" type="time" class="form-control cc-exp" value="" autocomplete="cc-exp">
													</div>
												</div>
												<div class="col-6">
													<label class="control-label mb-1">Frequência</label>
													<div class="input-group">
														<select name="freq" id="select" class="form-control">
															<option value="00:00">* em * horas</option>
															<option value="01:00">1 em 1 hora</option>
															<option value="02:00">2 em 2 hora</option>
															<option value="03:00">3 em 3 horas</option>
															<option value="04:00">4 em 4 horas</option>
															<option value="05:00">5 em 5 horas</option>
															<option value="06:00">6 em 6 horas</option>
															<option value="07:00">7 em 7 horas</option>
															<option value="08:00">8 em 8 horas</option>
															<option value="09:00">9 em 9 horas</option>
															<option value="10:00">10 em 10 horas</option>
															<option value="11:00">11 em 11 horas</option>
															<option value="12:00">12 em 12 horas</option>
															<option value="13:00">13 em 13 horas</option>
															<option value="24:00">24 em 24 horas</option>
														</select>
													</div>
												</div>
											</div>
											<hr>
											<div>
												<input type="hidden" name="inserir" value="run">
												<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Agendar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div> <!-- .card -->
					</div>
					<div class="col-lg-5"> <!--Nicho 1-->
						<div class="card">
							<div class="card-body">
								<!-- Credit Card -->
								<div id="pay-invoice">
									<div class="card-body">
										<div class="card-title">
											<h3 class="text-center">Limpar</h3>
										</div>
										<hr>
										<form action="nicho.php" method="post">
											
											<div class="row form-group" align="center">
												<div class="col col-md-6">
													<div class="form-check">
														<div class="radio">
															<label for="radio1l" class="form-check-label ">
																<input type="radio" id="radio1l" name="id" value="1" class="form-check-input">Nicho 1
															</label>
														</div>
														<div class="radio">
															<label for="radio2l" class="form-check-label ">
																<input type="radio" id="radio2l" name="id" value="2" class="form-check-input">Nicho 2
															</label>
														</div>
														<div class="radio">
															<label for="radio3l" class="form-check-label ">
																<input type="radio" id="radio3l" name="id" value="3" class="form-check-input">Nicho 3
															</label>
														</div>
													</div>
												</div>
												<div class="col col-md-5">
													<div class="form-check">
														<div class="radio">
															<label for="radio4l" class="form-check-label ">
																<input type="radio" id="radio4l" name="id" value="4" class="form-check-input">Nicho 4
															</label>
														</div>
														<div class="radio">
															<label for="radio5l" class="form-check-label ">
																<input type="radio" id="radio5l" name="id" value="5" class="form-check-input">Nicho 5
															</label>
														</div>
														<div class="radio">
															<label for="radio6l" class="form-check-label ">
																<input type="radio" id="radio6l" name="id" value="6" class="form-check-input">Nicho 6
															</label>
														</div>
													</div>
												</div>
											</div>
											<hr>
											<div>
												<input type="hidden" name="limpar" value="run">
												<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block btn-danger">Limpar nicho</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div> <!-- .card -->
					</div>
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
