<?php

//ÿ��1��ˢ��һ�����
echo date("H:m:s"), "<br>";
set_time_limit(100);
//ob_start(); //Ҫ����ȥ���Ż� ÿ��1��ˢ��һ�����
for ($i = 0; $i < 10; $i++)
{
	sleep(1);
	echo date("H:m:s"),"<br>";
	ob_flush();
	flush();
}

echo "Done!";
ob_end_flush();

echo "<hr>";
?>

<?php
ob_end_clean();
for ($i=10; $i>0; $i--)
{
	echo $i."<br>";
	flush();
	sleep(1);
}

echo "<hr>";
?>

<?php

ob_end_clean();
ob_implicit_flush(true);

echo str_repeat(' ', 1024);//Ϊ������������Ļ���������Щ�����Ҫ�ﵽһ���Ļ���ſ�ʼ��ʾ����

for ($i=10; $i>0; $i--){
echo $i."<br>";
sleep(1);
}
?>