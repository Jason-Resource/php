<?php
// --> PHP_EOL 
/*
* ����
*/

if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  $nameErr = "ֻ������ĸ�Ϳո�"; 
}
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
  $emailErr = "�Ƿ������ʽ"; 
}
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
  $websiteErr = "�Ƿ��� URL �ĵ�ַ"; 
}

$cardid = eregi_replace("[^a-z0-9-]", "", $cardid);
$cardid = eregi_replace("[^A-Z0-9-]", "", $cardid);

$cardid = ereg_replace("[^0-9A-Za-z-]", "", $cardid);
if (empty ($cardid)) {
	exit ("����Ϊ�գ�");
}

$softurl = stripslashes($softurl);
if (!preg_match("#[_=&///?\.a-zA-Z0-9-]+$#i", $softurl)) {
	exit ("ȷ�������ַ�ύ��ȷ��");
}

////////////////�ж���
if (!preg_match("/([a-zA-Z0-9\-\.\_])+$/", $url)) {
	return false;
}


/**
 * ����һ���ַ�������ȡ����A��ǩ��������Ӻ�����
 * e.g: $ss = match_alink($contents); print_r($ss);
 */
function match_alink($document) {
	preg_match_all("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</([^>]*)>'isx", $document, $links);

	for ($i = 0; $i < count($links[2]); $i++) {
		$match[$i] = array (
			'link' => $links[2][$i],
			'content' => $links[4][$i]
		);
	}
	return $match;
}


//http://www.imus.cn:8114/xinwen/p1.html	http://www.imus.cn:8114/xinwen/hot_p1.html
$sort_url = preg_replace('/(hot|comt)_p(.*?).html/i',"",$pc_url);
$sort_url = preg_replace('//p[0-9].html/i',"",$pc_url);

$contents = file_get_contents($_POST['caiji_url']);
$contents = preg_replace("'([\r\n])[\s]+'", "", $contents);
preg_match_all("/<div>(.*?)<\/div>/isU", $contents, $m);

//�ָ�е�����
$arr = explode("\n",$content);
       explode('\r\n',$content)

$lianxi = str_replace(chr(13),"<br>",$_POST[lianxi]);
$lianxi = str_replace(chr(32)," ",$lianxi);

$reg = array("\r\n", "\n", "\r"); 
$replace = array("<br>","<br>"," "); 
$shopdesc = str_replace($reg, $replace, $shopdesc); 

/////  $(this).val().replace(/<[^>]+>/ig,'')   js�õģ���֪��PHP�ܲ����õ����ȼ�¼����
$link = preg_replace('/http:\/\/www.youku.com\/v_show\/id_(.*)_rss.html/',"http://player.youku.com/player.php/sid/$1/v.swf",$link);

$id = ereg_replace("[^0-9]","",$id);if($id==""){exit;}

//��2��Ϊ8
preg_replace('/(page=)(\d+)/is', "\${1}8", "?page=2");

//�滻index.html
$remotefile = "/upload/index.html";
$remotedir = preg_replace('#[^\/]*\.html#', '', $remotefile);

//�滻����Ϊ��
echo preg_replace("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</a>'isx", "$4", $content);

//$2Ϊ�䱾������ӣ�$4Ϊ�䱾����������֣����������Ծ���ԭ����A��ǩ,���Լ��ĸ�ʽ�����
echo preg_replace("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</a>'isx", "<a href=\"$2\" target='_blank'>$4</a>", $content);

//�滻 ĳ�ַ��� Ϊ �Զ����ַ��� ���涨�滻����ߴ���
echo preg_replace('/Google/', '<a href="http://www.google.com/">�ȸ�</a>', $content, 4);
echo preg_replace("#".preg_quote($key)."#", $replace_key, $cur_str, $replace_num);//preg_quote Ϊת�������еĹؼ���

//���������滻
$key = $replace_key = array();

$key[]="/�ȸ�/";
$key[]="/�ٶ�/";

$replace_key[]="<font color='red'>�ùȸ�</font>";
$replace_key[]="<font color='red'>���ٶ�</font>";

echo preg_replace($key, $replace_key, $content, 4);

//ȥ������HTML��ǩ
strip_tags($content);

echo preg_replace('/\$(\d)/', '\\\$$1', "$0.95");//--> \$0.95
echo preg_replace('/\s\s+/', ' ', 'foo   o');    //--> 'foo o'

//�޳�����
$content = preg_replace (array("'<a[^>]*?>'si", "'</a>'si"), array("", ""), $content);

//��ȡ����
//<a href="http://data.movie.xunlei.com/movie/48109"
preg_match("/<a href=\"(?<link>http:\/\/data\.movie\.xunlei\.com\/movie\/(?<id>\d+))\"/is", $li, $m_link);
$m_link['link']  $m_link['id']  //�������

/*
 * �ո񣬻���
 * ���ڻس�����:
 * macϵͳ�� \r
 * windows \r\n
 * linux \n
 */
$arr = explode("\n", $key_str);//���ò�ƱȽϿ���
$arr = explode(chr(13), $key_str);


foreach ( explode("\r", $body) as $bodyline){
		$dataline = explode("|", $bodyline);
}



//�����е�ASCII���滻ΪHTML�Ļ��з�
$str = str_replace(chr(13), "<br>", $str);
//���ո��ASCII���滻ΪHTML�Ŀո��
$str = str_replace(chr(32), "&nbsp;", $str);

//�滻���л��У�������ո������ڲɼ���ҳ����ַ����Ĵ���  dm456��Ч��
$str = preg_replace("'([\r\n])[\s]+'", "", $str);

//������������ҳʱʹ�ã�ѹ����ҳ
$str = preg_replace("/[\n| ]{2,}/", "", $str);//���۶��ٸ��ո���ʶ��Ϊһ���ո�

//������пհ��ַ���
$str = preg_replace("/\s/", "", $str);//һ���ո��ʶ��Ϊһ���ո�


$out = strtolower(@ file_get_contents($url));
if ($out) {
	if (is_utf8($out))
		$out = mb_convert_encoding($out, "GBK", "UTF-8");
		preg_match_all('/<a(.*?)href=(.*?)>(.*?)<\/a>/i', $out, $m);
}


$str = '';
for ($i = 0; $i < count($content[1]); $i++) {
	$search = array (
		"'onmousedown=\"[^\"]*?\"'si",
		"'- <a href=(.*?)�ٶȿ���<\/a>'si"
	);
	$replace = array (
		"",
		""
	);
	$temp = preg_replace($search, $replace, $content[1][$i]);
	$temp = str_replace("����", "<font color='red'>����</font>", $temp);
	$str .= $temp . '<br />';
	if (preg_match("/163.com/", $temp)) {
		$str .= ($i +1) . "��ƥ�����ַ<hr/>";
	} else {
		$str .= ($i +1) . "��ƥ�����ַ<hr/>";
	}
}
echo $str;

////���������滻
$search = array (
	"'&nbsp; <a href=(.*?)Ԥ��<\/a>'si"
);
$replace = array (
	""
);
echo $str = preg_replace($search, $replace, $str);

/**
 * ѹ��html : ������з�,����Ʊ��,ȥ��ע�ͱ��  
 * @param	$string  
 * @return  ѹ�����$string 
 * */
function compress_html($string) {  
    $string = str_replace("\r\n", '', $string); //������з�  
    $string = str_replace("\n", '', $string); //������з�  
    $string = str_replace("\t", '', $string); //����Ʊ��  
    $pattern = array (  
                    "/> *([^ ]*) *</", //ȥ��ע�ͱ��  
                    "/[\s]+/",  
                    "/<!--[^!]*-->/",  
                    "/\" /",  
                    "/ \"/",  
                    "'/\*[^*]*\*/'"  
                    );  
    $replace = array (  
                    ">\\1<",  
                    " ",  
                    "",  
                    "\"",  
                    "\"",  
                    ""  
                    );  
    return preg_replace($pattern, $replace, $string);  
} 
?>