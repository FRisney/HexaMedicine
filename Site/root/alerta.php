<?php
	function alerta($tipo,$msg){
		switch($tipo){
			case "info";
				echo "
					<div class=\"sufee-alert alert with-close alert-$tipo alert-dismissible fade show\" >
						$msg
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">
								x
							</span>
						</button>
					</div>";
			break;
			case "danger";
				echo "
					<div class=\"sufee-alert alert with-close alert-$tipo alert-dismissible fade show\" >
						$msg
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">
								x
							</span>
						</button>
					</div>";
			break;
			case "success";
				echo "
					<div class=\"sufee-alert alert with-close alert-$tipo alert-dismissible fade show\" >
						$msg
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">
								x
							</span>
						</button>
					</div>";
			break;
		}
	}

?>