<?php

class AutoLoad{

	function core($className){
		$className = ltrim($className, rtrim('\ '));
		$fileName  = '';
		$namespace = '';
		if ($lastNsPos = strrpos($className, rtrim('\ '))) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace(rtrim('\ '), DS, $namespace) . DS;
		}
		$fileName .= str_replace('_', DS, $className) . '.php';
		//echo ROOT.DS.'core'.DS.$fileName;
		require DS.$fileName;
	}

}
?>