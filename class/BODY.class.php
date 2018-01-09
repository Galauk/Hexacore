<?php
class BODY {
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
	public function add($content,$type="body"){
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
		$this->add($x,"head");
	}
	function java($script=""){
		$x = "<script>";
		$x .= $script;
		$x .= "</script>";
		$this->add($x,"head");
	}
	function css($style=""){
		$x = "<style>";
		$x .= $style;
		$x .= "</style>";
		$this->add($x,"head");
	}
	function loadJava($file=null){
		$x = "<script src='".$file."'>";
		$x .= "</script>";
		$this->add($x,"head");
	}
	function loadCss($file=null){
		$x = "<link href='".$file."' rel='stylesheet' type='text/css'>";
		$x .= "</link>";
		$this->add($x,"head");
	}
	function icon($file=null){
		$x = "<link rel='shortcut icon' href='".$file."'>";

		$this->add($x,"head");
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
		$this->body .= $x;
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
		$this->body .= $x;
	}
	function closeDiv(){
		$x = "</div>";
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
	}
	function closeForm(){
		$x = "</form>";
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
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
		$this->body .= $x;
	}
	function quebra(){
		$x = "<br>";
		$this->body .= $x;
	}
}
?>