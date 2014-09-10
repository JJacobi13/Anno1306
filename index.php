<?php
include "php/Game.php";
session_start(); 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Anno 1306</title>
		
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/main.js" ></script>
	</head>
	<body>
		<div class="wrapper">
            <?php
            $_SESSION['game'] = new Game();
            ?>


			<div class="game">
				<?php
                $game = $_SESSION['game'];
                $game->createPlayer();
				?>
				<div id="detail">

				</div>
			</div>

			<div id="logger">
				<?php
				$game = $_SESSION['game'];
				$game->start();
				?>
			</div>
		</div>
	</body>
</html>