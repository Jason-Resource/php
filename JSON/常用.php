<?php
/**
* jsonp����json�������ݣ�����jsonp
*/
function jsonp_json_callback($arr){
	
	if(isset($_REQUEST['test'])){
		print_r($arr);exit;
	}

	if(isset($_REQUEST['jsoncallback'])){
		die($_REQUEST['jsoncallback'].'('.json_encode($arr).')');
	}

	die(json_encode($arr));
}

/**
 * ����Ƿ�Ϊjson string
 */
function isJSON($data)
{
	return (@json_decode($data) !== null);
}