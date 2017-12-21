<?php

//ѭ��ɾ���ļ����µ��ļ�
chdir(dirname(dirname(__FILE__))."/scache");
foreach (glob("*/*" .cache) as $file) {
	unlink($file);
}

/**
* recursiveDelete(�ݹ�ɾ��)
* ɾ���ļ���ݹ�ɾ��Ŀ¼
* @param string $str Path to file or directory
*/
function recursiveDelete($str) {
	if (is_file($str)) {
		return @ unlink($str);
	}
	elseif (is_dir($str)) {
		$scan = glob(rtrim($str, '/') . '/*');
		foreach ($scan as $index => $path) {
			recursiveDelete($path);
		}
		return @ rmdir($str);
	}
}

/**
 * ѭ������Ŀ¼
 * echo make_dir(ROOT."/text/text1/text2");
 * ����1 ˵�������ɹ�
 */
function make_dir($folder) {
	$reval = false;

	if (!file_exists($folder)) {
		/** ���Ŀ¼���������Դ�����Ŀ¼ */
		@ umask(0);

		/** ��Ŀ¼·����ֳ����� */
		preg_match_all('/([^\/]*)\/?/i', $folder, $atmp);

		/** �����һ���ַ�Ϊ/��������·������ */
		$base = ($atmp[0][0] == '/') ? '/' : '';

		/** ��������·����Ϣ������ */
		foreach ($atmp[1] AS $val) {
			if ('' != $val) {
				$base .= $val;

				if ('..' == $val || '.' == $val) {
					/** ���Ŀ¼Ϊ.����..��ֱ�Ӳ�/������һ��ѭ�� */
					$base .= '/';

					continue;
				}
			} else {
				continue;
			}

			$base .= '/';

			if (!file_exists($base)) {
				/** ���Դ���Ŀ¼���������ʧ�������ѭ�� */
				if (@ mkdir(rtrim($base, '/'), 0777)) {
					@ chmod($base, 0777);
					$reval = true;
				}
			}
		}
	} else {
		/** ·���Ѿ����ڡ����ظ�·���ǲ���һ��Ŀ¼ */
		$reval = is_dir($folder);
	}

	clearstatcache();

	return $reval;
}

/***
 * ������
 * �ļ������ļ���
 */
function makeFile($file_name, $c) {
	$status = 0;  //0,�ɹ� 1,�ļ���ʧ�ܣ� 2, "�ļ�д��ʧ�ܣ�"
	if (!$fp = fopen($file_name,"w")) {
		$status = 1 ;
	}
	if (fwrite($fp,$c)==FALSE) {
		$status = 2;
	}
	fclose($fp);
	return $status;
}

