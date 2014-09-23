<?php
include "Warehouse.php";

class Building{
    private $properties;

    function __construct($name){
        global $dbConnection;
        $this->properties = $dbConnection->getBuildingInfo($name);
    }

    public function showDetails(){
        $detailDiv = new Div("content");
        $detailDiv->addHeader($this->getProperty("name"));
        /*Draw the default statistics*/
        $statsDiv = new Div("stats");
        if($this->getProperty("upkeep") > 0){
            $statsDiv->addInput("upkeep: ", $this->getProperty("upkeep"));
        }elseif($this->getProperty("upkeep") == 0){
            $statsDiv->addText("<p>No upkeep</p>");
        }else{
            $statsDiv->addInput("tax: ", $this->getProperty("upkeep") * -1);
        }

        $detailDiv->addText($statsDiv);

        /*Draw the production*/
        if($this->getProperty("productCondition") != null){
            if($this->getProperty("productConditionRequired")){
                echo $this->getProperty("productConditionQuantity");
                $detailDiv->addInput("Requires: ", sprintf("%s x %d",$this->getProperty("productCondition"), $this->getProperty("productConditionQuantity")));
            }else{
                $detailDiv->addInput("Turns: ", sprintf("%s x %d",$this->getProperty("productCondition"), $this->getProperty("productConditionQuantity")));
                $detailDiv->addText("<p>Into</p>");
            }
        }
        if($this->getProperty("product") != null){
            $detailDiv->addInput("Production: ", sprintf("%s x %d",$this->getProperty("product"), $this->getProperty("productQuantity")));
        }

        return $detailDiv;
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