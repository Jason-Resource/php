<?php
set_time_limit(0);
header('Content-Type:text/html;charset=gb2312');
date_default_timezone_set('Asia/Shanghai');
ini_set("display_errors","Off");
//ini_set("mssql.datetimeconvert","0");

/**
 * ���ݿ�����
 */
$hostname = "222.122.118.101"; //������
$username = "meinvbingyue"; //�û���
$password = "wang7862102"; //����
$dataname = "houtai"; //���ݿ���
$code = "gb2312"; //���� latin1

/**
 *�������ݿ�
 */
$conn = FALSE;
$conn = mysql_connect($hostname,$username,$password,TRUE);
mysql_select_db($dataname,$conn);
mysql_query("SET NAMES $code;");
mysql_query("SET character_set_connection=$code, character_set_results=$code;");

if (!$conn){
	die('Could not connect: ' . mysql_error());
}

mysql_close($conn);
?>