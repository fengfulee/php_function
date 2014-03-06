<?PHP
#	该文件是一些常用的处理url地址的函数...

	#获取文件的扩展名...
	function getExt($url){
		#使用parse_url函数来进行对url进行处理...
		$arr = parse_url($url);
		$path = $arr['path'];
		if($path){
			$offset = strrpos($path,'.');
			if($offset){
				return substr($path,$offset);
			}else{
				return false;
			}
		}else{
			return;
		}
	}
#	测试...
	$url = 'http://www.phpddt.com.cn/abc/de/fg.php?id=1';
	echo getExt($url)."\n";


	#以上是通过url地址来得到文件的拓展名..
	#下面通过pathinfo函数.
	#但是这里传递的必须是 
	function getExt_fromPath($path){
		$arr = pathinfo($path);
		if($arr['extension']) return $arr['extension'];
		else return;
	}

	$path = '/www/htdocs/index.html';
	echo getExt_fromPath($path),"\n";

?>
