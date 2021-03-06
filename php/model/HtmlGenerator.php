<?php
//TODO: Use DOM document
class Div{
	private $appearanceClass;
	private $divContent = [];
    private $action = null;
    private $id;
	
	public function __construct($appClass = null, $id = null){
		$this->appearanceClass = $appClass;
        $this->id = $id;
	}

    public function addAction($trigger, $javascriptFunction){
        $this->action = $trigger . "=\"" . $javascriptFunction . "(this.className)\"";
    }

    public function createButton($action, $caption, $class = null){
        $this->addText("<button ");
        if($class != null){
            $this->addText("class=\"".$class."\" ");
        }
        $this->addText("onclick=\"".$action."(this.className)\">".$caption."</button>");
    }
	
	public function createList($array, $id = null){
		$this->addText("<ul ");
		if($id != null){
			$this->addText("id=\"".$id."\" ");
		}
		$this->addText(">");
		htmlListItems($array);
		$this->addText("</ul>");
	}
	
	public function addText($text){
		array_push($this->divContent, $text);
	}
	
	public function addHeader($headerName){
		$this->addText("<h1>".$headerName."</h1>");
	}
	
	public function addInput($label = "", $field = "", $id = null, $disabled = true){
		$div = new Div();
		$div->addText($label);
		$div->addText("<input ");
		if($id != null){
			$div->addText("id=\"".$id."\" ");
		}
		if($disabled == true){
			$div->addText("class = \"showObjVar\" disabled ");
		}
		$div->addText("value=".$field." />");
		array_push($this->divContent, $div);
	}

	public function __toString(){
		$string = "<div ";
		if($this->appearanceClass != null){
			$string .= "class=\"" . $this->appearanceClass . "\"";
		}
        if($this->id != null){
            $string .= "id=\"" . $this->id . "\"";
        }
		$string .= ">";
		foreach ($this->divContent as $content){
			$string .= $content;
		}
		$string .= "</div>";
		return $string;
	}
}

function htmlListItems($array){
	$string = "";
	foreach($array as $item){
		$string .= "<li>".$item."</li>";
	}
	return $string;
}

?>