window.onload = function (){
	updateBuildings();
	updateMoney();
	updateWarehouseDetails();
}


function actionOutputToLogger(phpScript){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("logger").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET",phpScript,true);
	xmlhttp.send();
}

function updateWarehouseDetails(){
    var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("detail").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","php/actions/showDetails.php",true);
	xmlhttp.send();
}

function createBuilding(buildingName){
    actionOutputToLogger("php/actions/buildBuilding.php?building="+buildingName);
    updateBuildings();
    updateMoney();
    updateWarehouseDetails();
}

function nextTurn(){
	actionOutputToLogger("php/actions/executeTurn.php");	
	updateBuildings();
	updateMoney();
	updateWarehouseDetails();
}

function updateMoney() {
    var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("money").value=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","php/actions/getters/getMoney.php",true);
	xmlhttp.send();
}

function updateBuildings(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("buildings").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","php/actions/getters/getBuildings.php",true);
	xmlhttp.send();
}

function BuildWoodcutter(){
	
}