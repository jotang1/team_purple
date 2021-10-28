<?php
$dbhost="aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
$dbuser = "purpleteam";
$dbpass = "purpleteam";
$dbname = "LYALPurple";
if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	die("Failed to connect! Check again!");
}
?>
