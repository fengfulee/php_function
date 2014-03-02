<?PHP
#	该文件主要包含两个比较好的方法,用来引入外部文件...

#	通过一个静态数组,然后判断是否存在.
	function static_require($filepath){
		static $require_array = array();
		#	静态数组保存.
		if(!isset($require_array[$filepath])){
			require $filepath;
			$require_array[$filepath] = TRUE;
		}else{
			$require_array[$filepath] = FALSE;
		}
		return $require_array[$filepath];
	}

#	首先检测类名是否存在,如果存在,表示代码中已经包含了该类,否则导入...
	function classTest_require($classname,$classpath){
		if(class_exists($classname))	return ;
		#	判断文件是否存在.
		if(file_exists($classpath)){
			require $classpath;
			return true;
		}else{
			return false;
		}

	}

?>
