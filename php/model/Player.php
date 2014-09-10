<?php
include "buildings/Building.php";

class Player{

	public $money = 500;
	private $buildings = [];
	
	function __construct() {
		$moneyDiv = new Div("stats");
		$moneyDiv->addInput("Money: ", $this->money, "money", true);
		echo $moneyDiv;
		$buildingDiv = new Div("buildingDiv");
		$buildingDiv->addHeader("Buildings");
		$buildingDiv->createList($this->buildings, "buildings");
		echo $buildingDiv;
	}
	
	function getBuildingNames(){
        $text = "";
        foreach($this->buildings as $building){
            $buildingDiv = new Div($building->getAppearanceClass());
            $text .= $buildingDiv->__toString();
        }
		return $text;
            //htmlListItems($this->buildings);
	}
	
	function getWarehouse(){
		return $this->buildings["warehouse"];
	}
	
	function createStartingBuildings(){
		$this->buildings = ["warehouse" => new Warehouse("warehouse")];
	}
	
	function createBuilding($buildingName){
        echo "Trying to build " . $buildingName . "...";
        try{
            $building = new Building($buildingName);
            array_push($this->buildings, $building->build($this->money, $this->getWarehouse()));
        }catch (Exception $e){
            echo $e->getMessage();
        }
	}
	
	function destroyBuilding($building){
		if(($key = array_search($building,$this->buildings)) !== false) {
			unset($this->buildings[$key]);
		}
		echo "Destoyed " . $building->name . "<br />";
	}
	
	function gameLoop(){
		if($this->money < 0){
			echo "LOST";
			exit;
			//echo("<div style=\"position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background-color: gray; z-index: 9; opacity:0.5; \">You lost...</div>");
		}
		var_dump($this->money < 0);
		foreach ($this->buildings as $building) {
			$building->gameLoop($this);
		}
	}
}
?>