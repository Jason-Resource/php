<?php

//�����ʱ������
$today_start = strtotime(date("Y/m/d 0:0:0")); //��ʼ
$today_end = strtotime(date("Y/m/d 23:59:59")); //����

$begin = strtotime(date("Y-m-d",time()));
$end = $begin+86400-1;

$ctime = strtotime(date("Y-m-d",time()))-1;

//����
$yestoday_end = strtotime(date("Y-m-d H:i:s",$ctime));
$yestoday_start = strtotime(date("Y-m-d H:i:s",($ctime-86399)));

//ǰ��
$qian_start = strtotime(date("Y/m/d 0:0:0", strtotime("2 days ago")));
$qian_end = strtotime(date("Y/m/d 23:59:59", strtotime("2 days ago")));

//����
$w=date('w',$_SERVER['REQUEST_TIME']);
$start_time = strtotime('today -'.($w?($w - 1):6).' day');
$benzhou_start = strtotime(Date('Y-m-d H:i:s',$start_time));
$benzhou_end = strtotime(Date('Y-m-d H:i:s',$start_time + 604799));

//�������
$week_start = strtotime(date("Y-m-d H:i:s",($ctime-(86400*7)+1)));
$week_end = $yestoday_end;

//3����
//$start_3 = strtotime(date("Y-m-d H:i:s",($ctime-(86400*3)+1)));
$start_3 = strtotime(date("Y/m/d 0:0:0", strtotime("3 days ago")));
$end_3 = $yestoday_end;
echo date('Y-m-d H:i:s',$start_3)." - ".date('Y-m-d H:i:s',$end_3);exit;