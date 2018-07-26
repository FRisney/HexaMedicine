		<?php
			require 'config.php';
			$query = $db->query("SELECT nome FROM usuario where login = '{$_SESSION['usuario']}'");
			$nome = $query->fetch_assoc();
			$photo = "nophoto";
			if(file_exists('images/profile/'.$_SESSION['usuario'].'.jpg')){
				$photo = $_SESSION['usuario'];
			}			
			clearstatcache(); 
		?>
		<header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">

                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/profile/<?php echo $photo;?>.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link"><i class="fa fa- user"></i> <?php echo $nome['nome'];?></a>

                                <a class="nav-link" href="sair.php"><i class="fa fa-power-off"></i> Sair</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-br"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <a href="index.php"><span class="flag-icon flag-icon-us"></span></a>
								
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
