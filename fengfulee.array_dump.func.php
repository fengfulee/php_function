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

#	dump($arr);
	
#下面的这个函数是array_map函数..
	function showSpanish($m,$n){
		return "The number $m is called $n in Spanish";
	}	

	#这个函数用来将两个数组进行关联...感觉不错哦...
	function mapSpanish($m,$n){
		#这里要注意了.这里其实定义了一个匿名数组...
		#其实可以这样写的:
		#	$arr = array();
		#	$arr[$m] = $n;	可能这样写感觉会更好一点吧....
		return (array($m=>$n));
	}
	
#测试方法..
	$a = array(1,2,3,4,5);
	$b = array('uno','dos','tres','cuatro','cinco');
	$c = array_map("showSpanish",$a,$b);
	$d = array_map('mapSpanish',$a,$b);
	print_r($c);
	print_r($d);


	








?>
