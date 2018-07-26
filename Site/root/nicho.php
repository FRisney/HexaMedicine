<?php
	session_start();
	require 'config.php';
	$ID = $_POST['id'];
	$query = $db->query("SELECT equip FROM usuario WHERE login = '{$_SESSION['usuario']}'");
	$equip = $query->fetch_assoc();
	if (!empty($_POST['inserir'])) {
		$query = $db->query("SELECT nomeRem FROM nicho where idNicho = $ID and equip = '{$equip["equip"]}'");
		
		if($query->num_rows == 0){
			$sentenca = "INSERT INTO nicho (idNicho, nomeRem, hora, freq, equip) VALUES (?, ?, ?, ?, ?)";
			$insert = $db->prepare($sentenca);
			$insert->bind_param('isssi',$ID,$Rem,$Hora,$Freq,$Serial);
			$Serial = $equip["equip"];
			$Rem = $_POST['rem'];
			$Hora = $_POST['hora'];
			$Freq = $_POST['freq'];
			$insert->execute();
			$insert->close();
			$db->close();
			
			header('Location: /agendamento.php?status=inserted');			
		}else{
			header('Location: /agendamento.php?status=notinserted');
		}
	}
	if (!empty($_POST['limpar'])) {
		$limpar = $db->query("DELETE FROM nicho WHERE `idNicho` = $ID and equip = '{$equip["equip"]}'");
		$db->close();
		header('Location: /agendamento.php?status=clear');
	}
?>