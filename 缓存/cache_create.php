<?php
require_once(dirname(__FILE__)."/config.php");
$dsql = new DedeSql(false);

//�м���������
$sql = "select a.litpic,a.source,a.color,a.writer,a.title,a.subject,a.year,a.letter,a.content,a.sex,a.lang,m.zt from dede_archives as a inner join dede_addonmanhua as m on a.id=m.aid";
$result = mysql_query($sql);
$total = mysql_num_rows($result);
$flag = 1;
while($row = mysql_fetch_array($result)){
	$middle .=" array ( 'year' => '$row[year]',
                        'letter' => '$row[letter]',
                        'content' => '$row[content]',
                        'subject' => '$row[subject]',
                        'status' => '$row[zt]',
						'litpic' => '$row[litpic]',
						'writer' => '$row[writer]',
						'sex' => '$row[sex]',
						'lang' => '$row[lang]',
						'new_hua_id' => '$row[color]',
						'new_hua_title' => '$row[source]',
						'title' => '".addslashes($row[title])."'
                      )";
	if($total!=$flag){
		$middle .= ",
		";
	}
	$flag++;
}

//����ͷ��
$content .="<?php
\$manhua = array( ";

//��������
$content.=$middle;

//���ӵײ�
$content.=");
?>";

$num = file_put_contents(dirname(dirname(__FILE__))."/scache/filecache.php",$content);

//ɾ�����л����ļ�
chdir(dirname(dirname(__FILE__))."/scache");
foreach (glob("*/*" .cache) as $file) {
	unlink($file);
}

if($num>1000){
	echo "success!";
}else{
	echo "fail!";
}

?>