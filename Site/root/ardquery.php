<?php // SEMPRE imprime uma "string" de 69 caracteres, independente de quantos nichos foram programados e de seus horarios
	require 'config.php';
	date_default_timezone_set("America/Sao_Paulo");
	$result = $db->query("SELECT * FROM nicho WHERE equip='{$_GET['equip']}' order by idNicho");
	$agora = date('Y-m-d#H:i:s');
	$agoraU = date('U');
	$saida = array(1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
	$status = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false);
	
	while($query = $result->fetch_assoc()){
		$status[$query["idNicho"]] = true;
		$w = 1;
		$freq = date($query["freq"]);
		$calc = new DateTime($query["hora"]);
		do{
			$num = $freq * 1;
			$factor = "+".$num." hours";
			//$factor = "+".$num." minutes";
			$calc->modify($factor);
			$w++;
			if($calc->format('U')>$agoraU){
				$saida[$query["idNicho"]] = $query["idNicho"]."@".$calc->format('H:i')."@";
				$w = 1441;
			}
		}while($w<=1440);
	}
	
	echo"#".$agora."#";
	for($for=1;$for<=6;$for++){
		if($status[$for] == true){
			echo $saida[$for];
		}else{
			echo "$for@00:00@";
		}
	}
?>