```php
$yestoday = date('Y-m-d', strtotime('-1 day'));
echo $yestoday;
echo PHP_EOL;

$ss = date('Y-m-d', strtotime('2019-02 -1 month'));
echo $ss;
echo PHP_EOL;
$ss = date('Y-m-d', strtotime('2019-02 +1 month -1 day'));
echo $ss;

// 指定的月份有几天
$t = date('t',strtotime(date('2016-2')));
echo $t;

// 本月开始和结束时间
$begin_time = date ( "Y-m-d H:i:s", mktime ( 0, 0, 0, date ( "m" ), 1, date ( "Y" ) ) );
$end_time = date ( "Y-m-d H:i:s", mktime ( 23, 59, 59, date ( "m" ), date ( "t" ), date ( "Y" ) ) );

// 上个月开始和结束时间
$begin_time = date('Y-m-01 00:00:00',strtotime('-1 month'));
$end_time = date("Y-m-d 23:59:59", strtotime(-date('d').'day'));

// 上上个月开始和结束时间
$begin_time = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m")-2,1,date("Y")));
$end_time = date("Y-m-d H:i:s",mktime(23,59,59,date("m")-1 ,0,date("Y")));
```

----

```php

//当天的时间区间
$today_start = strtotime(date("Y/m/d 0:0:0")); //开始
$today_end = strtotime(date("Y/m/d 23:59:59")); //结束

$begin = strtotime(date("Y-m-d",time()));
$end = $begin+86400-1;

$ctime = strtotime(date("Y-m-d",time()))-1;

//昨天
$yestoday_end = strtotime(date("Y-m-d H:i:s",$ctime));
$yestoday_start = strtotime(date("Y-m-d H:i:s",($ctime-86399)));

//前天
$qian_start = strtotime(date("Y/m/d 0:0:0", strtotime("2 days ago")));
$qian_end = strtotime(date("Y/m/d 23:59:59", strtotime("2 days ago")));

//本周
$w=date('w',$_SERVER['REQUEST_TIME']);
$start_time = strtotime('today -'.($w?($w - 1):6).' day');
$benzhou_start = strtotime(Date('Y-m-d H:i:s',$start_time));
$benzhou_end = strtotime(Date('Y-m-d H:i:s',$start_time + 604799));

//最近七天
$week_start = strtotime(date("Y-m-d H:i:s",($ctime-(86400*7)+1)));
$week_end = $yestoday_end;

//3天内
//$start_3 = strtotime(date("Y-m-d H:i:s",($ctime-(86400*3)+1)));
$start_3 = strtotime(date("Y/m/d 0:0:0", strtotime("3 days ago")));
$end_3 = $yestoday_end;
echo date('Y-m-d H:i:s',$start_3)." - ".date('Y-m-d H:i:s',$end_3);exit;

// 一个月
$month_start = date("Ymd000000", strtotime("29 days ago"));
$month_end = date("Ymd235959",time());
```
