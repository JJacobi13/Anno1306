<?php
include "buildings/Building.php";

class Player{

	private $money = 500;
	private $buildings = [];

    /**
     * @return a list of built buildings
     */
    public function getBuildings()
    {
        return $this->buildings;
    }
	
	function __construct() {
		$moneyDiv = new Div("stats");
		$moneyDiv->addInput("Money: ", $this->money, "money", true);
		echo $moneyDiv;
        $this->createStartingBuildings();
		$buildingDiv = new Div("buildingDiv");
		$buildingDiv->addHeader("Buildings");
        $buildingsContent = new Div(null, "buildings");
        $buildingsContent->addText($this->getBuildingsHTML());
        $buildingDiv->addText($buildingsContent);
		echo $buildingDiv;
	}
	
	function getBuildingsHTML(){
        $contentDiv = new Div("content");
        foreach($this->buildings as $building){

            $contentDiv->createButton("showDetails","",$building->getAppearanceClass());
        }
		return $contentDiv;
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
            array_push($this->buildings, $building->build($this));
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
		foreach ($this->buildings as $building) {
			$building->gameLoop($this);
		}
	}

    function getMoney(){
        return $this->money;
    }

    function pay($money){
        $this->money -= $money;
    }
}
?>