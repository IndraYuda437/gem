<?php

system("clear");
function curl($url, $headers, $mode="get", $data=0)
	{
	if ($mode == "get" || $mode == "Get" || $mode == "GET")
		{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie2.txt');
                curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie2.txt');
		$result = curl_exec($ch);
		}
	elseif ($mode == "post" || $mode == "Post" || $mode == "POST")
		{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie2.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie2.txt');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		}
	else
		{
		$result = "Not define";
		}
	return $result;
	}


echo "Checking data \r";
sleep(1);
if (file_exists("config.json"))
{
echo "Your data is avaible ";
sleep(1);
echo "getting your data ";
sleep(1);
$a = json_decode(file_get_contents("config.json"), true);
$dev_id = $a["dev_id"];
$model = $a["model"];
sleep(1);
echo "SUCCESS\n";
}else{
echo "Your data is not avaible\r";
sleep(2);
echo "Ambil data dari https://gs.gemhunter.top/api/user/register/anonymity \n";
echo "Masukkan DeviceId	> ";
$dev_id = trim(fgets(STDIN));
echo "Masukkan Model		> ";
$model = rawurlencode(trim(fgets(STDIN)));
$a["dev_id"] = $dev_id;
$a["model"] = $model;
$a = json_encode($a, JSON_PRETTY_PRINT);
file_put_contents("config.json", $a);
}

// Login
$u_login = "https://gs.gemhunter.top/api/user/register/anonymity?deviceId=".$dev_id."&model=".$model."&channelId=gemhunter-gp&gameId=GemHunter&appKey=452d29107099456387eea9c64a72fa4d";
$respon = file_get_contents($u_login);
$a = json_decode($respon, true);
$openId = $a["data"]["user"]["openId"];
echo "Do you want to continue (y/n) : ";
$jawab = trim(fgets(STDIN));
if ($jawab == "y" || $jawab == "Y"){
}else{
exit();
}

while (true){
echo "claim ";
$r = rand(7,10);
$r2 = $r*2;
$u_claim = "https://gs.gemhunter.top/api/game/outCombat?openId=".$openId."&channelId=gemhunter-gp&gameId=GemHunter&stage=1&appKey=452d29107099456387eea9c64a72fa4d&diamondGemNum=".$r."&isAd=false";
$a = file_get_contents($u_claim);
$a = json_decode($a, true);
$diamond = $a["data"]["game"]["resource"]["diamond"];
if ($diamond){
echo "SUKSES ";
echo '|| get '.$r2." diamond ballance => ".$diamond."\n";
}else{
echo "FAILED\n";
sleep(1);
}
}









?>
