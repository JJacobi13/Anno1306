<?php
include "../Game.php";
session_start();
$game = $_SESSION['game'];
$warehouse = $game->player->getWarehouse();
echo $warehouse->showInventory();
?>