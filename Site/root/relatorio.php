<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location:login.php');
	}
	$dataRow = "";
	require 'config.php';
	$query = $db->query("SELECT equip FROM usuario WHERE login = '{$_SESSION['usuario']}'");
	$equip = $query->fetch_assoc();
	$result = $db->query("SELECT * FROM nicho WHERE equip = '{$equip["equip"]}' order by idNicho");
	$equipamento = $equip["equip"];
	$db->close();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HexaMedicine - Relatório</title>
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
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <?php include('menu.php'); ?> <!--Barra lateral-->
    
    <div id="right-panel" class="right-panel">

    <?php include('header.php'); ?> <!--Topo da página-->

		<div class="content mt-3">
			<div class="animated fadeIn">
				<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<table id="bootstrap-data-table" class="table table-striped table-bordered">
								<thead class="thead-dark">
									<tr>
										<th>Nicho</th>
										<th>Nome</th>
										<th>Horário inicial</th>
										<th>Freqência</th>
										<th>ID Equipamento</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if($result->num_rows == 0){
												echo"<tr>";
												echo"<td>NA</td>";
												echo"<td>NA</td>";
												echo"<td>NA</td>";
												echo"<td>NA</td>";
												echo"<td>".$equipamento."</td>";
												echo"</tr>";
										}else{
											while($row = $result->fetch_array()){
												echo"<tr>";
												echo"<td>".$row[0]."</td>";
												echo"<td>".$row[1]."</td>";
												echo"<td>".$row[2]."</td>";
												echo"<td>A cada ".$row[3]/1 ." horas</td>";
												echo"<td>".$row[4]."</td>";
												echo"</tr>";
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>


				</div>
			</div><!-- .animated -->
		</div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

<!--
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>-->


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

</body>
</html>
