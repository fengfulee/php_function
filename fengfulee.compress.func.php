<?PHP
#	这个文件写一些有关于bzip2函数的一些用法吧..
	
	#首先写 压缩字符串..
	#$str 表示的是要压缩的字符串..
	#$level 表示压缩的等级...0-9 等级越高,时间越多...通常使用4 ,压缩率80%左右...
	function mybzcompress($str,$level=4)  {
		if(!$str)	return;
		$str = 	bzcompress($str,$level);
		return $str;
	}

	#解压缩...
	function mybzdecompress($str,$small=0){
		if(!$str) return;
		$str = bzdecompress($str,$small);
		return $str;
	}

	#压缩文件....
	function bzcompressfile($in,$out){
		if(!file_exists($in)||!is_readable($in)){
			return false;
		}
		if((file_exists($out)&&!is_writable($out))||(!file_exists($out)&&!is_writable(dirname($out)))){
			return false;	
		}
		$in_handle = fopen($in,'r');
		$out_handle = bzopen($out,'w');
		if(!feof($in_handle)){
			$buffer =fgets($in_handle,4096);
			$buffer = bzcompress($buffer);
			bzwrite($out_handle,$buffer,4096);
		}

		fclose($in_handle);
		bzclose($out_handle);
		
	}

	function bzdecompressfile($in,$out){
		if(!file_exists($in)||!is_readable($in)){
			return false;
		}
		if((file_exists($out)&&!is_writable($out))||(!file_exists($out)&&!is_writable(dirname($out)))){
			return false;	
		}
		$in_handle = bzopen($in,'r');
		$out_handle = fopen($out,'w');
		if($buffer = bzread($in_handle,4096)){
			$buffer = bzdecompress($buffer);
			fwrite($out_handle,$buffer,4096);
		}

		bzclose($in_handle);
		fclose($out_handle);
		
		
	}











?>
