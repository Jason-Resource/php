<?php
header ( 'Content-type:text/html;charset=utf-8' );

/**
 * key1=value1&key2=value2תarray
 * @param $str key1=value1&key2=value2���ַ���
 * @param $$needUrlDecode �Ƿ���Ҫ��url���룬Ĭ�ϲ���Ҫ
 */
function parseQString($str, $needUrlDecode=false){
	$result = array();
	$len = strlen($str);
	$temp = "";
	$curChar = "";
	$key = "";
	$isKey = true;
	$isOpen = false;
	$openName = "\0";

	for($i=0; $i<$len; $i++){
		$curChar = $str[$i];
		if($isOpen){
			if( $curChar == $openName){
				$isOpen = false;
			}
			$temp = $temp . $curChar;
		} elseif ($curChar == "{"){
			$isOpen = true;
			$openName = "}";
			$temp = $temp . $curChar;
		} elseif ($curChar == "["){
			$isOpen = true;
			$openName = "]";
			$temp = $temp . $curChar;
		} elseif ($isKey && $curChar == "="){
			$key = $temp;
			$temp = "";
			$isKey = false;
		} elseif ( $curChar == "&" && !$isOpen){
			putKeyValueToDictionary($temp, $isKey, $key, $result, $needUrlDecode);
			$temp = "";
			$isKey = true;
		} else {
			$temp = $temp . $curChar;
		}
	}
	putKeyValueToDictionary($temp, $isKey, $key, $result, $needUrlDecode);
	return $result;
}


function putKeyValueToDictionary($temp, $isKey, $key, &$result, $needUrlDecode) {
	if ($isKey) {
		$key = $temp;
		if (strlen ( $key ) == 0) {
			return false;
		}
		$result [$key] = "";
	} else {
		if (strlen ( $key ) == 0) {
			return false;
		}
		if ($needUrlDecode)
			$result [$key] = urldecode ( $temp );
		else
			$result [$key] = $temp;
	}
}

/**
 * �ַ���ת��Ϊ ����
 *
 * @param unknown_type $str
 * @return multitype:unknown
 */
function convertStringToArray($str) {
	return parseQString($str);
}



/**
 * ������ת��Ϊstring
 *
 * @param $para ����        	
 * @param $sort �Ƿ���Ҫ����        	
 * @param $encode �Ƿ���ҪURL����        	
 * @return string
 */
function createLinkString($para, $sort, $encode) {
	if($para == NULL || !is_array($para))
		return "";
	
	$linkString = "";
	if ($sort) {
		$para = argSort ( $para );
	}
	while ( list ( $key, $value ) = each ( $para ) ) {
		if ($encode) {
			$value = urlencode ( $value );
		}
		$linkString .= $key . "=" . $value . "&";
	}
	// ȥ�����һ��&�ַ�
	$linkString = substr ( $linkString, 0, count ( $linkString ) - 2 );
	
	return $linkString;
}

/**
 * ����������
 *
 * @param $para ����ǰ������
 *        	return ����������
 */
function argSort($para) {
	ksort ( $para );
	reset ( $para );
	return $para;
}

