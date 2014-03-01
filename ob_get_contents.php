<?php
#	这段代码用来测试使用缓冲区和不使用缓冲区的差别.
	$start_time = microtime(TRUE);#true 表示返回秒数和精确4位的浮点时间.
	$str = '';
	for($i=0;$i<1000000;$i++){
		$str .='a';
	}
	$middle_time = microtime(TRUE);
	
#	下面开始使用缓冲区
	ob_start();	#开启缓冲区.
	$str = '';
	for($i=0;$i<100000;$i++){
		$str .='a';	
	}
	$string = ob_get_contents();	#将缓冲区的内容放到一个变量中.
	ob_end_clean();			#清空缓冲区.
	$end_time = microtime(TRUE);
#	这里要注意一点,我是在Linux CLI 模式下进行测试的.
	echo "\n";
	echo "Normal mode:".($middle_time-$start_time);
	echo "\n";
	echo "Buffer mode:".($end_time-$middle_time);
	echo "\n";

#	my test result:
#	Normal mode:0.11229801177979
#	Buffer mode:0.010470867156982

?>
