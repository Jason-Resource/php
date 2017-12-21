<?php

function get_url_contents($url)
{
    if (ini_get("allow_url_fopen") == "1")
        return file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result =  curl_exec($ch);
    curl_close($ch);

    return $result;
}

/**
 * ����fopen(),file_get_contents()�ȹ��̵ĳ�ʱ���á����������������ʽ��ͷ��Ϣ���õ�������̡�
 */

$opts = array (
	'http' => array (
		'method' => "GET",
		'timeout' => 60,
//		'proxy' => 'tcp://127.0.0.1:8080',
//		'request_fulluri' => true,
//		'header'=>"Accept-language: en\r\n Cookie: foo=bar\r\n",
//		'header'=>"Content-Type: text/xml; charset=utf-8",
	)
);
//����������������
$context = stream_context_create($opts);

echo $html = file_get_contents('http://www.baidu.com', false, $context);

/********************************************************/
/**
 * ʧ��ʱ���Լ��Σ���Ȼʧ�ܾͷ���
 */
/*
$cnt = 0;
while ($cnt < 3 && ($str = @ file_get_contents('http://blog.sina.com/mirze')) === FALSE)
	$cnt++;

echo $str;
*/

/********************************************************/
/*
function Post($url, $post = null) {
	$context = array ();

	if (is_array($post)) {
		ksort($post);

		$context['http'] = array (
			'timeout' => 60,
			'method' => 'POST',
			'content' => http_build_query($post,
			'',
			'&'
		),);
	}
	return file_get_contents($url, false, stream_context_create($context));
}

$data = array (
	'name' => 'test',
	'email' => 'test@gmail.com',
	'submit' => 'submit',

);
echo Post('http://www.ej38.com', $data);
*/
?>