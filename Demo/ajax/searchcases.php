<?php
require_once 'dbconnection.php';

$app_num = $_POST['app_num'];

$sql = "SELECT APPLICATION.APP_NUMBER,APPLICATION.APP_STATUS,APPLICATION.APP_INIT_DATE,USERS.USR_USERNAME FROM APPLICATION INNER JOIN USERS ON APPLICATION.APP_CUR_USER = USERS.USR_UID WHERE APPLICATION.APP_NUMBER=". $app_num ."" ;
$result = mysql_query($sql) or die('[]');
$cases = array();
$i=1;

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $cases[] = array("ID" => $i, "APP_NUMBER" => $row['APP_NUMBER'],
   		 "APP_STATUS" => $row['APP_STATUS'],
   		 "APP_INIT_DATE" => $row['APP_INIT_DATE'],
   		 "USR_USERNAME" => $row['USR_USERNAME']);
	$i++;
}

                echo G::json_encode(array("success" => true, "resultTotal" => $i, "resultRoot" => $cases));

mysql_close($con);
//die('[' . $ret . ']');

?>