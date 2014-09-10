<?php
include "Warehouse.php";

class Building{
    private $properties;

    function __construct($name){
        global $dbConnection;
        $this->properties = $dbConnection->getBuildingInfo($name);
    }
	
	public function validResources($money, $warehouse){
		if ($money >= $this->getProperty("buildingCost") &&
            $warehouse->getInventoryItem("wood") >= $this->getProperty("woodCost") &&
            $warehouse->getInventoryItem("tools") >= $this->getProperty("toolCost")){
			return true;
		}
		return false;
	}
	
	function build($player){
        if($this->validResources($player->getMoney(), $player->getWarehouse())){
            $player->pay($this->getProperty("buildingCost"));
            $player->getWarehouse()->removeResource("wood", $this->getProperty("woodCost"));
            $player->getWarehouse()->removeResource("tools", $this->getProperty("toolCost"));
            echo "Constructed a ".$this->getProperty("name")."!<br />";
            if ($this->getProperty("object") != null){
                $obj = $this->getProperty("object");
                return new $obj($this->getProperty("name"));
            }
            return $this;
        }else{
            throw new Exception("Not enough resources for building a ".$this->getProperty("name")."...");
        }
	}
	
	function production($player){
        $warehouse = $player->getWarehouse();
        try{
            if($this->getProperty("productCondition") == null || $warehouse->hasEnoughResources($this->getProperty("productCondition"), $this->getProperty("productConditionQuantity"))){
                if($this->getProperty("productCondition") != null){
                    $warehouse->removeResource($this->getProperty("productCondition"), $this->getProperty("productConditionQuantity"));
                }
                if($this->getProperty("product") != null){
                    $warehouse->addResource($this->getProperty("product"), $this->getProperty("productQuantity"));
                }
            }
        }catch (Exception $e){
            if($this->getProperty("productConditionRequired") == true){
                $player->destroyBuilding($this);
            }
        }
    }
	
	function gameLoop($player){
		$player->pay($this->getProperty("upkeep"));
		$this->production($player);
	}
	
	public function __toString(){
		return (String) $this->getProperty("name");
	}

    public function getAppearanceClass(){
        return "building " . $this->getProperty("appClass");
    }

    public function setProperty($key, $value){
        $this->properties[$key] = $value;
    }

    public function getProperty($key){
        return $this->properties[$key];
    }
}
?>