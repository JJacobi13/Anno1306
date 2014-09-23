<?php
include "../Game.php";
session_start();
$game = $_SESSION['game'];
$buildings = $game->player->getBuildings();
if($_GET["building"] != "undefined"){
    $_SESSION['details'] = explode(" ", $_GET["building"])[1];
}
foreach ($buildings as $building){
    if($building->getProperty("appClass") == $_SESSION["details"]){
        echo $building->showDetails();
        break;
    }
}
?>