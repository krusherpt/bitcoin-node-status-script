<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <title>YOUR NAME HERE Bitcoin Node</title>
    <style type="text/css">
	.auto-style1 {
		text-align: center;
		font-size: xx-large;
	}
	.auto-style2 {
		margin-bottom: 0px
	}
	.auto-style3 {
		margin-top: 0px;
	}
	</style>
  </head>
  <body>
<?php
function curl_get_file_contents($URL)
    {
        $c = curl_init();
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT ,3); 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
    }

$http_status = curl_get_file_contents("http://IPHERE/status.php"); // edit the URL to your status.php location
if ($http_status == "ON")
{
include_once("Bitcoin.php");

$rpcUser = "userhere"; // RPC Username from your node.
$rpcPass = "passhere";  // RPC Password from your node.
$url = "http://ip:port";  // IP and Port from your node.

// create bitcoin object
$bitcoin = new Bitcoin($url, $rpcUser, $rpcPass);

$status = file_get_contents('http://www.example.com/'); // Working on this, but already have the script to install on the node.
$blocks = $bitcoin->getblockcount(); 
$connect = $bitcoin->getconnectioncount();
$diff = $bitcoin->getdifficulty();
$status3 = "ON";
}else {
$blocks = "OFF"; 
$connect = "OFF"; 
$diff = "OFF";
$status3 = "OFF"; 
}
?>
    <div id="container" class="container" style="margin-bottom: 20px">
	    <table style="width: 100%; height: 75px;">
			<tr>
				<td class="auto-style1"><span lang="pt"><br><br>YOUR NAME HERE Bitcoin Node</span>
	<script src="bootstrap.min.js"></script>
    			<br><br><br></td>
			</tr>
		</table>
    <script src="jstz.min.js"></script>
    	</div>
    	<div style="text-align: center;">
    <table style="width: 494px; height: 286px;" class=" table table-bordered table-striped table-hover" align="center">
		<tr>
			<td class="text-center" style="width: 159px; height: 45px"><span lang="pt">Status</span></td>
			<td style="width: 68px; height: 45px;"><span lang="pt">&nbsp;ON</span></td>
		</tr>
		<tr>
			<td class="text-center" style="width: 159px; height: 45px">Number Of Connections</td>
			<td style="width: 68px; height: 45px;">&nbsp;<?php echo("$connect"); ?></td>
		</tr>
		<tr>
			<td class="text-center" style="width: 159px; height: 45px;">Block Number</td>
			<td style="width: 68px; height: 45px;">&nbsp;<?php echo("$blocks"); ?></td>
		</tr>
		<tr>
			<td class="text-center" style="width: 159px; height: 45px;">Bitcoin Difficulty</td>
			<td style="width: 68px; height: 45px;">&nbsp;<?php echo("$diff"); ?></td>
		</tr>
		<tr>
			<td class="text-center" style="width: 159px; height: 45px">Contact</td>
			<td style="width: 68px; height: 45px;">&nbsp;YOUR@MAIL.HERE</td>
		</tr>
	</table>
	</div>
  </body>
</html>