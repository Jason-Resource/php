<?php
exit;
set_time_limit(0);
ini_set("display_errors", "Off");

//��ȡhttpͷ��Ϣ
$arr = get_headers($url);

//����
echo "<script language='javascript'>location=\"$link\";</script>";

/*********************************************************************************
 * Header ����
 */
header('Content-Type:text/html;charset=gb2312');

//�˴������ҳ�����ǰ���Ȳ��ҿͻ��˻����ļ���ֻ�пͻ��˻����ļ������ڡ����ڡ��û�F5ˢ�²Ŵӷ�������ȡҳ�棬������Ч���ٷ�����ѹ�������Ƕ�����Ҫʱʱ���µ�ҳ�治���ã�����̳��ͶƱ�ȳ���
header('Cache-Control:max-age=86400, must-revalidate');//24Сʱ
header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
header('Expires:'.gmdate('D, d M Y H:i:s', time() + '86400').'GMT');

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

header("Cache-Control: no-store, no-cache, must-revalidate");

Header( "HTTP/1.1 301 Moved Permanently" );
Header( "Location: http://www.kan3.com" );

header('Content-Type:application/json;charset=utf-8'); //���JSON��ʽ


/*********************************************************************************
* ��Ԫ�ж�
*/
$mtypesid = isset ($mtypesid) && is_numeric($mtypesid) ? $mtypesid : 0;
$aid = isset ($aid) && is_numeric($aid) ? $aid : 0;
$money = is_array($row) ? $row['money'] : 0;
$ischeck = ($cfg_mb_msgischeck == 'Y') ? 0 : 1;

/*********************************************************************************
 * ���ú���
 */
intval();
is_numeric();// �ж��Ƿ�Ϊ����
is_null();
strip_tags(string,allow);//��ȥ HTML��XML �Լ� PHP �ı�ǩ���ú���ʼ�ջ���� HTML ע�͡�����޷�ͨ�� allow �����ı䡣��
strpos();//��ȡ�ַ����±�
str_replace();
strtolower();
strlen();
substr();
nl2br(); //���ַ����е�ÿ������ (\n) ֮ǰ���� HTML ���з� (<br/>)


?>