\n -> newline
\r -> return
\t -> tab

<?php 
/*
��һ��д��: 
$content=str_replace("\n","",$content); 
echo $content; 

�ڶ���д��: 
str_replace("\r\n","",$str); 

������д��: 
$content=preg_replace("/\s/","",$content); 
echo $content; 

��: 

����˵˵\n,\r,\t 
\n ��س��� 
��Windows �б�ʾ�����һص���һ�е��ʼλ�� 
��Linux��unix ��ֻ��ʾ���У�������ص���һ�еĿ�ʼλ�á� 
\r ��ո� 
��Linux��unix �б�ʾ���ص����е��ʼλ�á� 
��Mac OS �б�ʾ�����ҷ��ص���һ�е��ʼλ�ã��൱��Windows ��� \n ��Ч���� 
\t ����������һ�У�
����˵����
������˫���Ż򶨽����ʾ���ַ�������Ч���ڵ����ű�ʾ���ַ�������Ч��
\r\n һ��һ���ã�������ʾ�����ϵĻس���(Linux,Unix��)��Ҳ��ֻ�� \n(Windwos��)����Mac OS����\r��ʾ�س���
\t��ʾ�����ϵġ�TAB������
�ļ��еĻ��з��ţ�
windows : \n
linux,unix: \r\n
*/


//php ��ͬϵͳ�Ļ��� 
//��ͬϵͳ֮�任�е�ʵ���ǲ�һ���� 
//linux ��unix���� /n 
//MAC �� /r 
//window Ϊ��������linux��ͬ ���� /r/n 
//�����ڲ�ͬƽ̨�� ʵ�ַ����Ͳ�һ�� 
//php �����ַ�������� 

//1��ʹ��str_replace ���滻���� 
$str = str_replace(array("/r/n", "/r", "/n"), "", $str); 

//2��ʹ�������滻 
$str = preg_replace('//s*/', '', $str); 

//3��ʹ��php����õı��� ������ʹ�ã� 
$str = str_replace(PHP_EOL, '', $str); 
?>