window.onload = function (){
	updateBuildings();
	updateMoney();
    showDetails();
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

function showDetails(clickedItem){
    var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("detail").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","php/actions/showDetails.php?building="+clickedItem,true);
	xmlhttp.send();
}

function createBuilding(buildingName){
    actionOutputToLogger("php/actions/buildBuilding.php?building="+buildingName);
    updateBuildings();
    updateMoney();
    showDetails();
}

function nextTurn(){
	actionOutputToLogger("php/actions/executeTurn.php");	
	updateBuildings();
	updateMoney();
    showDetails();
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