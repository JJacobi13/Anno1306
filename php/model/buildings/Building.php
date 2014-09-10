<?php
include "Warehouse.php";
include "Woodcutter.php";

class Building{

    function __construct($name){
        global$dbConnection;
        $info = $dbConnection->getBuildingInfo($name);
        $this->name = $info["name"];
        $this->appClass = $info["appClass"];
        $this->woodCost = $info["woodCost"];
        $this->toolCost = $info["toolCost"];
        $this->buildingCost = $info["buildingCost"];
        $this->upkeep = $info["upkeep"];
        $this->product = $info["product"];
        $this->productQuantity = $info["productQuantity"];
        $this->productCondition = $info["productCondition"];
        $this->productConditionQuantity = $info["productConditionQuantity"];
        $this->productConditionRequired = $info["productConditionRequired"];
        $this->object = $info["object"];
        $this->inhabitants = $info["inhabitants"];
    }
	
	public function validResources($money, $warehouse){
		if ($money >= $this->buildingCost &&
            $warehouse->inventory["wood"] >= $this->woodCost &&
            $warehouse->inventory["tools"] >= $this->toolCost){
			return true;
		}
		return false;
	}
	
	function build(&$money, $warehouse){
        if($this->validResources($money, $warehouse)){
            $money -= $this->buildingCost;
            $warehouse->inventory["wood"] -= $this->woodCost;
            $warehouse->inventory["tools"] -= $this->toolCost;
            echo "Constructed a ".$this->name."!<br />";
            if ($this->object != null){
                return(new $this->object($this->name));
            }
            return $this;
        }else{
            throw new Exception("Not enough resources for building a ".$this->name."...");
        }
	}
	
	function production($player){
        $warehouse = $player->getWarehouse();
        if($this->productCondition == null || $warehouse->inventory[$this->productCondition] >= $this->productConditionQuantity){
            if($this->productCondition != null){
                $warehouse->inventory[$this->productCondition] -= $this->productConditionQuantity;
            }
            if($this->product != null){
                $warehouse->inventory[$this->product] += $this->productQuantity;
            }
        }else{
            if($this->productConditionRequired == true){
                $player->destroyBuilding($this);
            }
        }

    }
	
	function gameLoop($player){
		$player->money -= $this->upkeep;
		$this->production($player);
	}
	
	public function __toString(){
		return $this->name;
	}

    public function getAppearanceClass(){
        return "building " . $this->appClass;
    }
}
?>