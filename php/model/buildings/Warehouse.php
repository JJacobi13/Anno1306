<?php
class Warehouse extends Building{
	public $name = "Warehouse";
    public $appClass = "warehouse";
	public $upkeep = 20;
	public $tax = 0;

    public $buildingCost = 500;
    public $woodCost = 5;
    public $toolCost = 5;

    public $inventory = ["wood" => 10, "tools" => 10, "food" => 10];

	function showInventory(){
		$invStr = "<h1>Warehouse:</h1>";
        foreach($this->inventory as $item => $quantity){
            //TODO use HtmlGenerator
            $invStr .= "<div>".$item.": <input class=\"showObjVar\" disabled value=".$quantity." /></div>";
        }
		return $invStr;
	}
}
?>