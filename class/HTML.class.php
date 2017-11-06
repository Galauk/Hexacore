<?php
class HTML {
	public $head;
	public $body = null;
	function show(){
		if ($this->head) {
			echo "<head>";
			echo $this->head;
			echo "</head>";
			$this->head = null;
		}
		if ($this->body) {
			echo $this->body;
			$this->body = null;
		}
	}
	function add($content){
		$this->body .= $content;
	}
	private function append($content,$type=null){
		if($type == "head"){
			$this->head .= $content;
		}
		if($type == "body"){
			$this->body .= $content;
		}
	}
	function title($titulo){
		$x = "<title>";
		$x .= $titulo;
		$x .= "</title>";
		$this->append($x,"head");
	}
	function java($script=""){
		$x = "<script>";
		$x .= $script;
		$x .= "</script>";
		$this->append($x,"head");
	}
	function css($style=""){
		$x = "<style>";
		$x .= $style;
		$x .= "</style>";
		$this->append($x,"head");
	}
	function loadJava($file=null){
		$x = "<script src='".$file."'>";
		$x .= "</script>";
		$this->append($x,"head");
	}
	function loadCss($file=null){
		$x = "<link href='".$file."' rel='stylesheet' type='text/css'>";
		$x .= "</link>";
		$this->append($x,"head");
	}
	function icon($file=null){
		$x = "<link rel='shortcut icon' href='".$file."'>";

		$this->append($x,"head");
	}
	function div($content,$atrib=null){
		$x = "<div";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		$x .= $content;
		$x .= "</div>";
		return $x;
	}
	function openDiv($atrib=null){
		$x = "<div";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		return $x;
	}
	function closeDiv(){
		$x = "</div>";
		return $x;
	}
	function label($content,$atrib=null){
		$x = "<label";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		$x .= $content;
		$x .= "</label>";
		return $x;
	}
	function form($content,$action="",$method="post",$enctype="multipart/form-data",$atrib=null){
		$x = "<form";
		$x .= " action='".$action."'";
		$x .= " method='".$method."'";
		$x .= " enctype='".$enctype."'";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		$x .= $content;
		$x .= "</form>";
		return $x;
	}
	function openForm($action="",$method="post",$enctype="multipart/form-data",$atrib=null){
		$x = "<form";
		$x .= " action='".$action."'";
		$x .= " method='".$method."'";
		$x .= " enctype='".$enctype."'";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		return $x;
	}
	function closeForm(){
		$x = "</form>";
		return $x;
	}
	function linha($atrib=null){
		$x = "<hr";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x.= ">";
		return $x;
	}
	function listaMenu($array,$atrib=null){
		$x = "<ul";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		foreach ($array as $key => $value){
			$x .= "<li>";
			$x .= $this->link($value,$key);
			$x .= "</li>";
		}

		$x .= "</ul>";
		return $x;
	}
	function listaItem($array){
		$x = "<ul";
		$x .= ">";
		foreach ($array as $key => $value){
			$x .= "<li";
			$x .= " class='".$key."'";
			$x .= ">";
			$x .= $value;
			$x .= "</li>";
		}
		$x .= "</ul>";
		return $x;
	}
	function listaTabela($array){
		$x = "<ul";
		$x .= ">";
		$i = 0;
		foreach ($array as $key => $value){
			$x .= "<li";
			if($i%2 == 0){
				$x .= " class='linha1'";
			}else{
				$x .= " class='linha2'";
			}
			$x .= ">";
			$x .= $value;
			$x .= "</li>";
			$i++;
		}

		$x .= "</ul>";
		return $x;
	}

	function input($type,$array2=null){
		$x = "<input";
		$x .= " type='".$type."'";
		if($array2){
			if(is_array($array2)){
				foreach($array2 as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		return $x;
	}
	function select($array,$atrib=null){
		$x = "<select";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		foreach ($array as $key => $value){
			$x .= "<option value=".$key.">".$value."</option>";
		}
		$x .= "</select>";
		return $x;
	}
	function textarea($content='',$atrib=null){
		$x = "<textarea";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		$x .= $content;
		$x .= "</textarea>";
		return $x;
	}
	function img($src,$atrib=null){
		$x = "<img";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= " src='".$src."'>";
		return $x;
	}
	function link($content,$href="#",$atrib=null){
		$x = "<a";
		$x.= " href='".$href."'";
		if($atrib){
			if(is_array($atrib)){
				foreach($atrib as $key => $value){
					$x .= " ".$key."='".$value."'";
				}
			}
		}
		$x .= ">";
		$x .= $content;
		$x .= "</a>";
		return $x;
	}
	function quebra(){
		$x = "<br>";
		return $x;
	}
}
?>