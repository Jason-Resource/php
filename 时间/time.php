<?php
$fdate_time_array = getdate();//����
$fyear = $fdate_time_array["year"];  //��
$fmon = $fdate_time_array["mon"];  //��
$fmday = $fdate_time_array["mday"]; //��
$fhours = $fdate_time_array["hours"];  //ʱ
$fminutes = $fdate_time_array["minutes"];//��
$fseconds = $fdate_time_array["seconds"];//��
$fwday = $fdate_time_array["wday"];   //����(����)
$fweekday = $fdate_time_array["weekday"];//����(Ӣ��)
$fmonth = $fdate_time_array["month"];  //�·�(Ӣ��)
$fyday = $fdate_time_array["yday"];  //һ���еĵڼ���
$ftime = $fdate_time_array[0];  //ʱ���

echo date('Ymd', strtotime('-30 days')).'000000'; // ���30��

echo date("Y/m/d 0:0:0", strtotime("1 days ago")); //���쿪ʼ
echo "<br>";
echo date("Y/m/d 23:59:59", strtotime("1 days ago")); //�������
echo "<hr>";
echo date("Y/m/d 0:0:0", strtotime("2 days ago")); //ǰ�쿪ʼ
echo "<br>";
echo date("Y/m/d 23:59:59", strtotime("2 days ago")); //ǰ�����


//��ʱ���ת��Ϊʱ������ʾ��ʽ
gmstrftime('%H:%M:%S',800);

strftime("%Y-%m-%d %H:%I:%S",time())


//�����ʱ������
$begin = strtotime(date("Y-m-d",time()));
$end = $begin+86400-1;

echo $ctime = strtotime(date("Y-m-d",time()))-1;
echo "<hr>";

//����
echo $yestoday_end = date("Y-m-d H:i:s",$ctime);
echo "<br>";
echo $yestoday_start = date("Y-m-d H:i:s",($ctime-86399));
echo "<hr>";

//�������
echo $week_start = date("Y-m-d H:i:s",($ctime-(86400*7)+1));
echo "<br>";
echo $week_end = $yestoday_end;

echo "<hr>";

echo date("Ymd",strtotime("now")), "\n";
echo date("Ymd",strtotime("-1 week Monday")), "\n";
echo date("Ymd",strtotime("-1 week Sunday")), "\n";
echo date("Ymd",strtotime("+0 week Monday")), "\n";
echo date("Ymd",strtotime("+0 week Sunday")), "\n";

//��ȡ���ڼ�
$weekarray=array("��","һ","��","��","��","��","��");
echo "����".$weekarray[date("w")];

//date('n') �ڼ�����
//date("w") �����ܼ�
//date("t") ��������

echo '<br>����:<br>';
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1-7,date("Y"))),"\n";
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7-7,date("Y"))),"\n";
echo '<br>����:<br>';
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),"\n";
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))),"\n";

echo '<br>����:<br>';
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m")-1,1,date("Y"))),"\n";
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m") ,0,date("Y"))),"\n";
echo '<br>����:<br>';
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y"))),"\n";
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y"))),"\n";

$getMonthDays = date("t",mktime(0, 0 , 0,date('n')+(date('n')-1)%3,1,date("Y")));//������δ���һ������
echo '<br>������:<br>';
echo date('Y-m-d H:i:s', mktime(0, 0, 0,date('n')-(date('n')-1)%3,1,date('Y'))),"\n";
echo date('Y-m-d H:i:s', mktime(23,59,59,date('n')+(date('n')-1)%3,$getMonthDays,date('Y'))),"\n";
?>
