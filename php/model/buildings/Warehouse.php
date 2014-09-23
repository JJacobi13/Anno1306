<?php
class Warehouse extends Building{
    private $inventory = ["wood" => 10, "tools" => 10, "food" => 10];

    function showDetails(){
        $detailDiv = parent::showDetails();
        return $this->showInventory($detailDiv);
    }

	function showInventory($detailDiv){
        foreach($this->inventory as $item => $quantity){
            $detailDiv->addInput($item, $quantity);
        }
		return $detailDiv;
	}

    function hasEnoughResources($key, $quantity){
        if($this->getInventoryItem($key) >= $quantity){
            return true;
        }
        return false;
    }

    function getInventoryItem($key){
        if(array_key_exists($key, $this->inventory) == false){
            $this->inventory[$key] = 0;
        }
        return $this->inventory[$key];
    }

    function removeResource($key, $quantity){
        if($this->hasEnoughResources($key, $quantity)){
            $this->inventory[$key] -= $quantity;
        }else{
            throw new Exception("Not enough " + $key + "!");
        }
    }

    function addResource($key, $quantity){
        $this->removeResource($key, -$quantity);
    }
}
?>