<?php
require_once (dirname(__FILE__) .
"/config.php");
$dsql = new DedeSql(false);

//�м���������
$sql = "select a.title,a.subject,a.year,a.letter,a.content,m.zt from dede_archives as a inner join dede_addonmanhua as m on a.id=m.aid";
$result = mysql_query($sql);
$total = mysql_num_rows($result);
$flag = 1;
while ($row = mysql_fetch_array($result)) {
	$middle .= " '" . addslashes($row[title]) . "'  => array ( 'year' => '$row[year]',
	                                       'letter' => '$row[letter]',
	                                       'content' => '$row[content]',
	                                       'subject' => '$row[subject]',
	                                       'status' => '$row[zt]'
	                                     )";
	if ($total != $flag) {
		$middle .= ",
				";
	}
	$flag++;
}

//����ͷ��
$content .= "<?php
\$manhua = array( ";

//��������
$content .= $middle;

//���ӵײ�
$content .= ");
?>";

echo file_put_contents("test.php", $content);
?>