<?php
class DbConnector{
    private $connection;

    public function __construct(){
        $this->connection = mysqli_connect("localhost:3307","annoUser","myPass","anno1306");
    }

    public function addBuildingButtonsToDiv($div){
        $query = "SELECT name, appClass FROM buildings WHERE canBuild = true";
        $result = $this->connection->query($query);

        while($building = mysqli_fetch_array($result)) {
            $div->createButton("createBuilding","Build " . $building["name"], $building["appClass"]);
        }
    }

    public function getBuildingInfo($buildingClass){
        $query = "SELECT * FROM buildings WHERE appClass = \"" . $buildingClass . "\"";
        $result = $this->connection->query($query);

        while($building = mysqli_fetch_array($result)) {
            return($building);
        }

    }

    public function __destruct(){
        mysqli_close($this->connection);
    }
}
?>