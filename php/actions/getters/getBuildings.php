<?php
include "../../Game.php";
session_start();
$game = $_SESSION['game'];
echo $game->player->getBuildingNames();
?>