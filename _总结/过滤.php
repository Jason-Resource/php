<?php
// ���������Ĭ������Ϊ��ֵ
$name = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $name = test_input($_POST["name"]);
  $comment = test_input($_POST["comment"]);
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/**********************************************************************************/

//��ȡ����
$content =  addslashes(htmlspecialchars($_POST['myEditor']));

//��ַ�����������ݣ���Ҫurldecode

//��ʾ
echo  "<div class='content'>".htmlspecialchars_decode($content)."</div>";

/**********************************************************************************/


/**
 * �� MYSQL LIKE �����ݽ���ת��
 *
 * @access      public
 * @param       string      string  ����
 * @return      string
 */
function mysql_like_quote($str)
{
    return strtr($str, array("\\\\" => "\\\\\\\\", '_' => '\_', '%' => '\%', "\'" => "\\\\\'"));
}

/**
 * �����û�����Ļ������ݣ���ֹscript����
 *
 * @access      public
 * @return      string
 */
function compile_str($str)
{
    $arr = array('<' => '��', '>' => '��','"'=>'��',"'"=>'��');

    return strtr($str, $arr);
}


/**
 * �ݹ鷽ʽ�ĶԱ����е������ַ�����ת��
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}

/**
 * �������Ա������������������ַ�����ת��
 *
 * @access   public
 * @param    mix        $obj      �����������
 * @author   Xuan Yan
 *
 * @return   mix                  �����������
 */
function addslashes_deep_obj($obj)
{
    if (is_object($obj) == true)
    {
        foreach ($obj AS $key => $val)
        {
            $obj->$key = addslashes_deep($val);
        }
    }
    else
    {
        $obj = addslashes_deep($obj);
    }

    return $obj;
}

/**
 * �ݹ鷽ʽ�ĶԱ����е������ַ�ȥ��ת��
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function stripslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
    }
}

/**
 * ȥ���ַ����Ҳ���ܳ��ֵ�����
 *
 * @param   string      $str        �ַ���
 *
 * @return  string
 */
function trim_right($str)
{
    $len = strlen($str);
    /* Ϊ�ջ򵥸��ַ�ֱ�ӷ��� */
    if ($len == 0 || ord($str{$len-1}) < 127)
    {
        return $str;
    }
    /* ��ǰ���ַ���ֱ�Ӱ�ǰ���ַ�ȥ�� */
    if (ord($str{$len-1}) >= 192)
    {
       return substr($str, 0, $len-1);
    }
    /* �зǶ������ַ����ȰѷǶ����ַ�ȥ��������֤�Ƕ������ַ��ǲ���һ���������֣�������ԭ��ǰ���ַ�Ҳ��ȡ�� */
    $r_len = strlen(rtrim($str, "\x80..\xBF"));
    if ($r_len == 0 || ord($str{$r_len-1}) < 127)
    {
        return sub_str($str, 0, $r_len);
    }

    $as_num = ord(~$str{$r_len -1});
    if ($as_num > (1<<(6 + $r_len - $len)))
    {
        return $str;
    }
    else
    {
        return substr($str, 0, $r_len-1);
    }
}

/**
 * �ؼ��ּӺ�
 * echo GetRedKeyWord($content,"�ؼ���1,�ؼ���2,�ؼ���3");
 */
function GetRedKeyWord($content, $Keywords) {
	$ks = explode(",", $Keywords);
	foreach ($ks as $k) {
		$k = trim($k);
		if ($k == "")
			continue;
		if (ord($k[0]) > 0x80 && strlen($k) < 3)
			continue;
		$content = str_replace($k, "<font color='red'>$k</font>", $content);
	}
	return $content;
}

/**
 * ���������������ַ���
 */
function FilterSearch($keyword,$lang)
{
	if($lang=='utf-8')
	{
		$keyword = ereg_replace("[\"\r\n\t\$\\><']",'',$keyword);
		if($keyword != stripslashes($keyword))
		{
			return '';
		}
		else
		{
			return $keyword;
		}
	}
	else
	{
		$restr = '';
		for($i=0;isset($keyword[$i]);$i++)
		{
			if(ord($keyword[$i]) > 0x80)
			{
				if(isset($keyword[$i+1]) && ord($keyword[$i+1]) > 0x40)
				{
					$restr .= $keyword[$i].$keyword[$i+1];
					$i++;
				}
				else
				{
					$restr .= ' ';
				}
			}
			else
			{
				if(eregi("[^0-9a-z@#\.]",$keyword[$i]))
				{
					$restr .= ' ';
				}
				else
				{
					$restr .= $keyword[$i];
				}
			}
		}
	}
	return $restr;
}

/**
 * ���������ؼ���
 * �����������˿ո񣬹������������ھ�ȷ��ѯ��
 * ck_search_key($str,$len)
 * ��һ��������Ҫ���Ĺؼ����ַ���
 * �ڶ�������Ϊ��ѡ�����ؼ��ʳ����趨�ĳ������иĬ����30�ַ�����15������
 */
function ck_search_key($k,$len=30){
	$keyword = cn_substr(trim(ereg_replace("[><\|\"\r\n\t%\*\.\?\(\)\$ ;,'%-]", "", stripslashes($k))), $len);
	$keyword = addslashes($keyword);
	return $keyword;
}

/**
* �����������ߵĿո񣬻���
*/
function mytrim($m) {
	$str = preg_replace("'([\r\n])[\s]+'", "", $m);
	$str = preg_replace("/[\n| ]{2,}/", "", $str);
	$str = preg_replace("/\s/", " ", $str);
	return $str;
}

/**
 * ��ֹע��(���������ʱ������ݵĺϷ���)
 * e.g: inject_check("select");
 */
function inject_check($check_str) {
	$check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $check_str);
	if ($check) {
		return true;
	} else {
		return false;
	}
}

/**
 * �ж��Ƿ��зǷ��ؼ��� true-->�зǷ��ؼ���
 * e.g: echo is_varikey("�Ҳ�");
 */
function is_varikey($check_str) {

	$arr_msg = array (
		"�Ҳ�",
		"�����"
	);

	for ($i = 0; $i < sizeof($arr_msg); $i++) {
		if (preg_match("/($arr_msg[$i])/", $check_str)) {
			return true;
			break;
		}
	}

	return false;
}

/**
 * �ж��Ƿ��зǷ��ؼ���(���ۣ�����У�����**����)
 * e.g: echo replace_varikey("�Ҳ�!���ǲ����˰�");
 */
function replace_varikey($check_str) {
	$arr_msg = array (
		"�Ҳ�",
		"�����"
	);

	for ($i = 0; $i < sizeof($arr_msg); $i++) {
		$check_str = preg_replace("/($arr_msg[$i])/i", "***", $check_str);
	}

	return $check_str;
}