<?PHP
#	字符集的一些转换..这里主要针对于那些提交数据 GET,POST,COOKIE 数据的操作....
	function base_protect($word){
		if(is_array($word)){
			$temp = array();
			foreach($word as $key => $value){
				$tmp[base_protected($key)] = base_protectd($value);
			}
			return $temp;
		}
		if(get_magic_quotes_gpc()){
			//这里表示已经对传递过来的数据进行转义操作....
			$word = stripslashes($word); 
		}else{
			$word = addslashes($word);
		}
		return $word;
	}


#	预防数据库攻击的正确做法....
	function check_input($vlaue){
		//去除斜杠...
		if(get_magic_quotes_gpc()){
			$value = stripslashes($value);
		}
		//如果不是数字的话,可以进行数据库转义....
		if(!is_numeric($value)){
			$value = "'".mysql_real_escape_string($value)."'";
		}
		return $value;
	}

#	将html代码进行转义,原样输出.不会被浏览器解析.
	function base_escape($str){
		//str_replace 
		//第一个参数 在$sr 中查找 
		//第二个参数 用该参数替换 查找的字符串..
		//第三个参数 在哪里查找.....
		$str = str_replace('<','&lt',$str);
		$str = str_replace('>','&gt',$str);
		$str = str_replace('\n','<br/>',$str);
		$str = str_replace(' ','&nbsp',$str);
		$str = str_replace('\t','&nbsp;&nbsp;&nbsp;&nbsp;',$str);
		return $str;
	}


#	获取系统时间,
#	该方法与 microtime(true)返回结果相同.
	function get_microtime(){
		list($usec,$sec) = split(' ',microtime());
		#$usec 表示精确到微秒级.
		#$sec 表示从1970年到现在的秒数.
		return ((float)$usec+(float)$sec);
	}

#	字节格式化...
#	$number 表示字节大小
#	$precision 表示精度.
	function byte_format($number,$precision){
		$size = array('B','KB','MB','GB','TB','PB');		
		$offset = 0;
		while($number > 1024 ){
			$number/=1024;
			$offset ++;
		}
		return round($number,$precision)." ".$size[$offset];
	}
#	测试..
/*
	$n = byte_format(1000000,2);
	echo $n;
	result:976.56 KB
*/


#	判断是否是AJax方式提交的.
#	这里我们要考虑一点,Ajax提交的作用是什么:
#	个人见解,主要是用于不同方式验证返回数据不同.
	function isAjax(){
		if(isset('HTTP_X_REQUESTED_WITH')){
			if('xmlhttprequest'==strtolower('HTTP_X_REQUESTED_WITH'))
				return true;
		}
		# 还有一种情况是:如果用户在表单中添加了某个字段来标明这是Ajax方式提交.
		if(!empty($_POST['some_var']))|| !empty($_GET['some_var'])
			return true;
		return false;
	}





############################
?>
