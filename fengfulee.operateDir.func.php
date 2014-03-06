<?PHP
	#循环方式输出指定文件夹下的所有文件盒目录...
	function listDir($dir){
		if($handle=opendir($dir)){
		echo "The look dir is :".$dir."\n";
			while(false!==($file=readdir($handle))){
				if($file=='.'||$file=='..'){
					continue;
				}
				if(is_dir($sub_file=realpath($dir.'/'.$file))){
					echo "File in Path".$dir.'/'.$file;
					listDir($sub_file);
				}else{
					echo "\t>>>>File is ".$file."\n";
				}
			} 

			closedir($handle);
		}
	}

#这里我才用传递参数的方式...
#	if($argv[1]){
#		listDir($argv[1]);
#	}else	exit;	

	
	#下面的这个函数是用来拷贝文件夹的...
	function copyDir($src,$dst){
		$dir = opendir($src);
		#这里在递归调用的时候,会创建子目录...
		mkdir($dst);
		while(false!==($file=readdir($dir))){
			#这里会循环读入所有的文件,或者目录....
			if($file!='.'&&($file!='..')){
				if(is_dir($src.'/'.$file)){
					#查看是否是目录....如果是目录,继续调用该函数..递归调用..
					copyDir($src.'/'.$file,$dst.'/'.$file);
					continue;
					
				}else{
					#否则进行文件的拷贝...
					copy($src.'/'.$file,$dst.'/'.$file);
				}
			}
		}
		closedir($dir);
	}
#	test...
#	copyDir('/git','/git1');
#	测试成功!...
	
