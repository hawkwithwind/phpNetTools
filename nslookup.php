<HTML>
<HEAD>
<TITLE>ping</TITLE>
</HEAD>


<BODY>
<?php
$server = $_GET["server"];
$nonapi = $_GET["nonapi"];
$command = "nslookup ".$server;
if($nonapi != "true" && $server!="")
{
    exec($command, $result);
    echo "[";
    $begin = false;
    $head = "'";
    foreach($result as $line)
    {
    	if($line == "")
    	{
    		$begin = true;
    		continue;
    	}    	
    	$tags = explode(":",$line);
    	if($tags[0] == "Address" && $begin == true)
    	{
    		echo $head.trim($tags[1])."'";
    		if($head == "'")$head = ", '";
    	}
    }
    echo "]";
    exit;
}
if(($server == '127.0.0.1') || ($server == 'localhost') || ($server == getenv("SERVER_ADDR"))) {

echo "<HR noshade size=1 /><br />";

echo "<font color=red size=1 />...</font><br />";

echo "<HR noshade size=1 /><br />";
} else {
if($server =="") {
echo "<H2>input url</H2>";
}
?>
<FORM method='GET' action='nslookup.php' name='q'>
<INPUT type='text' name='server' /><INPUT type='submit' value='nslookup' /><INPUT type='hidden'
 name = 'nonapi' value='true' />
</FORM>
</BODY>
</HTML>

<?php
$ip = getenv("REMOTE_ADDR");
$hname = getenv("HTTP_HOST");

echo "<b>Your IP is:</b> <i>$ip</i><br>"
."<b>Trying to ping:</b> <i>$server</i><br>"
."<b>Using server:</b> <i>$hname</i>";

echo "<HR noshade size=1/><br/>";

echo "<b>STATS:</b><br/><br/>";

echo "...<br/>";
exec($command, $result);
echo "<br />.<br />";
foreach($result as $line)
{
    echo $line."<br />";
}

}
?>
