<?php 

Heredoc技术。可用来输出大段的html和javascript脚本

1.PHP定界符的作用就是按照原样，包括换行格式什么的，输出在其内部的东西； 
2.在PHP定界符中的任何特殊字符都不需要转义； 
3.PHP定界符中的PHP变量会被正常的用其值来替换。 
如下：

<?php
    $name = '浅水游';
    //下面<<<EOT后面不能有空格
    print <<<EOT
            <html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
            <title>Untitled Document</title>
            </head>
            <body>
            <!--12321-->
            Hello,{$name}!
            Hello,$name!
            </body>
            </html>
EOT; //注意末尾的结束符必须靠边，其前面不能有空格

?>
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
<?php
$out = 
<<<EOF
    <a href="javascript:edit('asd', 'aaa')">编辑</a> |

    <font color="#ccc">删除</font>

    <a href="javascript:confirmurl('?m=admin&posid=12')">删除</a> |

    <font color="red">启用</font></a> |  

    <a href="javascript:preview('3','ds')"><font color="green">演示</font></a>
EOF;

echo $out;
?>
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
注意：

1.以<<<End开始标记开始，以End结束标记结束，**结束标记必须顶头写**，不能有缩进和空格，且在结束标记末尾要有分号 。

2.开始标记和开始标记相同，比如常用大写的EOT、EOD、EOF来表示，但是不只限于那几个，只要保证开始标记和结束标记不在正文中出现即可。

3.位于开始标记和结束标记之间的变量可以被正常解析，但是函数则不可以。在heredoc中，变量不需要用连接符.或,来拼接，如下：
$v=2;
$a= <<<EOF
"abc"$v"123"
EOF;
echo $a; //结果连同双引号一起输出："abc"2 "123"
1
2
3
4
5
6
7
8
9
10
4.heredoc常用在输出包含大量HTML语法d文档的时候。比如：函数outputhtml()要输出HTML的主页。可以有两种写法。很明显第二种写法比较简单和易于阅读。
第一种

function outputhtml(){
    echo "<html>";
    echo "<head><title>主页</title></head>";
    echo "<body>主页内容</body>";
    echo "</html>;
}
第二种
function outputhtml()
{
    echo <<<EOT
    <html>
    <head><title>主页</title></head>
    <body>主页内容</body>
    </html>
EOT;
}
outputhtml();

?>