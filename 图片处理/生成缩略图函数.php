<?php
/**
* ���ɸ�����������ͼ����
*
* @param ԭͼƬ��ַ $img_tempname
* @param ����ͼ����� $max_width
* @param ��������ͼ��ַ $dst_url
* @return unknown
*/
function createDstImage($img_tempname, $max_width, $dst_url) {
	global $uploadpath, $id, $uploadtype;

	if (!file_exists($img_tempname)) {
		die('��Ǹ����Ҫ�ϴ���ͼƬ������!');
	}
	$img_src = file_get_contents($img_tempname);
	$image = imagecreatefromstring($img_src); //�ø÷������ͼ��,���Ա��⡰ͼƬ��ʽ��������
	$width = imagesx($image); //ȡ��ͼ����
	$height = imagesy($image); //ȡ��ͼ��߶�
	$x_ratio = $max_width / $width; //��ȵı���

	if ($width <= $max_width) {
		$tn_width = $width;
		$tn_height = $height;
	} else {
		$tn_width = $max_width;
		//$tn_height=round($x_ratio*$height);
		echo $tn_height = 90;
	}

	if (function_exists('imagecreatetruecolor') && (function_exists('imagecopyresampled'))) {
		/*���ɸ�����������ͼ����*/
		$dst = imagecreatetruecolor($tn_width, $tn_height); //�½�һ�����ɫͼ��
		imagecopyresampled($dst, $image, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height); //�ز�����������ͼ�񲢵�����С
	} else {
		$dst = imagecreate($tn_width, $tn_height);
		imagecopyresized($dst, $image, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
	}

	imagejpeg($dst, $dst_url, 100); //��JPEG��ʽ��ͼ���������������ļ�,100(�������,�ļ����)��Ĭ��ΪIJGĬ�ϵ�����ֵ(��Լ75)
	imagedestroy($image);
	imagedestroy($dst);

	if (!file_exists($dst_url)) {
		return false;
	} else {
		return basename($dst_url);
	}
}
?>