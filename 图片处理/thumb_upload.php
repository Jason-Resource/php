<?php
if(isset($_POST['submit'])){

define("dir", "upload/"); //�洢��Ŀ¼�ļ�
if (is_uploaded_file($_FILES['file_image']['tmp_name'])) {
	$image_type = $_FILES['file_image']['type'];
	if ($image_type != "image/pjpeg") {
		echo "��֧�����ָ�ʽ";
	} else {
		$name = $_POST['name'];
		$result2 = move_uploaded_file($_FILES['file_image']['tmp_name'], dir . date("his", time()) . "." . fileext($_FILES['file_image']['name']));
		cutphoto(dir . date("his", time()) . ".jpg", dir . date("his", time()) . "_thumb.jpg", 256, 192); // ͼƬ�Ŀ�,��
		unlink(dir . date("his", time()) . ".jpg");
		if ($result2 == 1)
			echo "sucessful";
		else
			echo "fuck";
	}
}

}
//��ȡ�ļ���׺������
function fileext($filename) {
	return substr(strrchr($filename, '.'), 1);
}

//��������ͼ����
function cutphoto($o_photo, $d_photo, $width, $height) {

	$temp_img = imagecreatefromjpeg($o_photo);
	$o_width = imagesx($temp_img); //ȡ��ԭͼ��
	$o_height = imagesy($temp_img); //ȡ��ԭͼ��

	//�жϴ�����
	if ($width > $o_width || $height > $o_height) { //ԭͼ���߱ȹ涨�ĳߴ�С,����ѹ��

		$newwidth = $o_width;
		$newheight = $o_height;

		if ($o_width > $width) {
			$newwidth = $width;
			$newheight = $o_height * $width / $o_width;
		}

		if ($newheight > $height) {
			$newwidth = $newwidth * $height / $newheight;
			$newheight = $height;
		}

		//����ͼƬ
		$new_img = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);
		imagejpeg($new_img, $d_photo);
		imagedestroy($new_img);

	} else { //ԭͼ����߶��ȹ涨�ߴ��,����ѹ����ü�

		if ($o_height * $width / $o_width > $height) { //��ȷ��width��涨��ͬ,���height�ȹ涨��,��ok
			$newwidth = $width;
			$newheight = $o_height * $width / $o_width;
			$x = 0;
			$y = ($newheight - $height) / 2;
		} else { //����ȷ��height��涨��ͬ,width����Ӧ
			$newwidth = $o_width * $height / $o_height;
			$newheight = $height;
			$x = ($newwidth - $width) / 2;
			$y = 0;
		}

		//����ͼƬ
		$new_img = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);
		imagejpeg($new_img, $d_photo);
		imagedestroy($new_img);

		$temp_img = imagecreatefromjpeg($d_photo);
		$o_width = imagesx($temp_img); //ȡ������ͼ��
		$o_height = imagesy($temp_img); //ȡ������ͼ��

		//�ü�ͼƬ
		$new_imgx = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_imgx, $temp_img, 0, 0, $x, $y, $width, $height, $width, $height);
		imagejpeg($new_imgx, $d_photo);
		imagedestroy($new_imgx);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ϴ��ļ�ҳ��</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
<br/>�ϴ��ļ�<input type="file" name ="file_image" value="" />
<input type="submit" value="ȷ���ϴ�" name ="submit" />
</form>
</body>
</html>