<?php
header('Content-Type:text/html;charset=gbk');
date_default_timezone_set('Asia/Shanghai');
set_time_limit(0);

/**
 * ���ݿ�����
 */
$hostname = "localhost"; //������
$username = "root"; //�û���
$password = "jason20051"; //����
$dataname = "test"; //���ݿ���
$code = "gbk"; //����

/**
 *�������ݿ�
 */
$conn = FALSE;
$conn = mysql_connect($hostname,$username,$password,TRUE);
mysql_select_db($dataname,$conn);
mysql_query("SET NAMES $code;");
mysql_query("SET character_set_connection=$code, character_set_results=$code;");

if($conn==FALSE){
	die("���ݿ�����ʧ�ܣ�!");
}

//echo $conn;
?>
