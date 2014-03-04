<?PHP
#	对打印数组arr_dump进行优化.参考 thinkPHP
	function dump($arr,$echo=true,$label=null,$strict=true){
		#这里的作用是给标签作下判断和优化...
		$label = (null==$label)?'':rtrim($label).' ';
		if(!$strict){
			if(ini_get('html_errors')){
				$output = print_r($arr,true);
				$output = '<pre>'.$label.htmlspecialchars($output,ENT_QUOTES).'</pre>';
				#	label 表示标签,或者标题之类的东西....
			}else{
				$output = $label.print_r($arr,true);
			}
		}else{
			ob_start();	#开启缓冲区...
			var_dump($arr);
			$output = ob_get_clean();
			if(!extension_loaded('xdebug')){
				$output = preg_replace('/\]\=\>\n(\s+)/m',']=>',$output);
				$output = '<pre>'.$label.htmlspecialchars($output,ENT_QUOTES).'</pre>';
			}
		}	
		if($echo){
			echo $output;
			return null;
		}else{
			return $output;
		}
	}

######################test##########################
	$arr = array(
		'one' => 1,
		'two' => 2,
		'three' => 3,
		'four' => 4
	);

	dump($arr);
	
?>
