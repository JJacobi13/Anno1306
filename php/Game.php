<?php
include "model/Player.php";
include "model/HtmlGenerator.php";
include "db/DbConnector.php";
$dbConnection = new DbConnector();

class Game{

	public $player;

	function __construct() {
        $buttonDiv = new Div("buttons");
        global $dbConnection;
        $dbConnection->addBuildingButtonsToDiv($buttonDiv);
        $buttonDiv->createButton("nextTurn","Next turn");
		echo $buttonDiv;
	}

    function createPlayer(){
        $this->player = new Player();
    }
	function start(){
		$this->gameLoop();
	}
	
	function gameLoop(){
		echo "Starting game loop...<br />";
		echo "Money before: " . $this->player->getMoney() . "<br />";
		$this->player->gameLoop();
		echo "Money After: " . $this->player->getMoney() . "<br />";
	}
}
?>