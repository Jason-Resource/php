<?php
/* 
string number_format ( float $number [, int $decimals ] )
string number_format ( float $number , int $decimals , string $dec_point , string $thousands_sep )
decimals :С�������2λ
dec_point ��С������ʲô����
thousands_sep��ÿ��3λʱ��ʲô����
*/
$number = 1234.56;

// english notation (default)
$english_format_number = number_format($number);
// 1,235

// French notation
$nombre_format_francais = number_format($number, 2, ',', ' ');
// 1 234,56

$number = 1234.5678;

// english notation without thousands seperator
$english_format_number = number_format($number, 2, '.', '');
// 1234.57


/**
 * ͨ��ǧλ��������ʽ������
 */
echo number_format("1000000"); //1,000,000
echo number_format("1000000", 2); //1,000,000.00
echo number_format("1000000", 2, ",", "."); //1.000.000,00
?>