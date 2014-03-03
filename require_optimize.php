<?PHP
#	该文件主要包含两个比较好的方法,用来引入外部文件...

#	通过一个静态数组,然后判断是否存在.
	function static_require($filepath){
		static $require_array = array();
		#	静态数组保存.
		if(!isset($require_array[$filepath])){
			if(file_exists($filepath)){
				require $filepath;
				$require_array[$filepath] = TRUE;
			}else{
				return false;
			}
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

#	批量导入文件,并且使用 static_require()方法...
#	这里要求 $array 是数组,
	function static_require_array($array){
		if(!is_array($array)){
			static_require($array);
			return;
		}else{
			foreach($array as $key => $value){
				if(is_array($value))
					static_require_array($value);
				
				static_require($value);
			}
		}
		
	}

##	这里需要注意一点.每次调用static_require函数的时候,静态变量时不会每次进行初始化的
#	只在第一次进行初始化,因为多次调用的函数共享同一个静态变量
#	

?>
