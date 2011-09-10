<?php
	
	function ng($ng)		{return preg_split('/[\s]+/',$ng);}
	function down($do)		{if ($do==NULL) $do="down"; return $do;}
	function zero($zr)		{if ($zr==NULL) $zr="0"; return $zr;}

	$tme = date(' H:i:s ');
	$upd = zero(exec('uptime | grep -o -e "[0-9]* d" | sed "s/d//"'));
	$usr = exec('uptime | grep -o -e "[0-9]* u" | sed "s/ u//"');
	$lod = ng(exec('uptime | grep -o -e "average.*[0-9].*" | sed "s/,//g"'));
	$hdd = ng(exec('df -h /'));
	$hd2 = ng(exec('df -h /mnt/seed'));
	$hd3 = ng(exec('df -h /mnt/stor'));
	$net = ng(shell_exec('vnstat'));
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$uname = php_uname("r");
	$server = $_SERVER['SERVER_SOFTWARE'];
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$cpu = exec("grep 'model name' /proc/cpuinfo | sort -u | sed -e 's/.*: //'");
	$mem = ng(exec('free -m | grep Mem'));
	$tem = ng(exec("sensors | grep temp1 | sed -e 's/+//' | sed -e 's/.0//'"));

	//enter your own image here
	//$img = ('<img src="path.to.image"></img>');
	
	if (preg_match("/iphone/i",$browser)) { 	
			$css = ('./css/mobile.css');
			$img = (' ');
		}
	else
		{ $css = ('./css/default.css');}
	

echo('
	<html>
	<head>
		<title>uguu</title>
		<link rel="stylesheet" type="text/css" href="'.$css.'" />
		<meta name="viewport" content="width=device-width; initial-scale = 1.0; maximum-scale=1.0; user-scalable=no" />
	</head>
	<body>
	uptime <span>'.$upd.'<ww> days</ww></span>
	users <span>'.$usr.'<ww> logged in</ww></span>
	load <span>'. $lod[1].'<ww>1</ww><small> '.$lod[2].'</small><ww>5</ww><small> '.$lod[3].'</small><ww>15</ww></span>
	mem <span>'.$mem[3].'MB<small> '.$mem[1].'MB</small></span>
	hdd <span>'
		.$hdd[3].'iB<small>  '.$hdd[1].'iB</small><ww> sda</ww><br>'
		.$hd2[3].'iB<small>  '.$hd2[1].'iB</small><ww> sdb</ww><br>'
		.$hd3[3].'iB<small>  '.$hd3	[1].'iB</small><ww> sdc</ww><br></span>
	temp <span>'.$tem[1].'&deg;<ww> celcius</ww></span>
	net <span>'.$net[11].$net[12].'<ww> tx</ww><br>'.$net[14].$net[15].'<ww> rx</ww></span><br>'.$img.'
	<i>you: '.$hostname.'<br>'.$server." on ".$uname.'<br>'.$cpu.'</i>
	</body>
	</html>
'); 	

?>
