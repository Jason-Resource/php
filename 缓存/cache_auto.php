<?php
/**
 * auto_cache.php ʵ�����ܵ��Զ����档
 * ʹ�ð취����򵥣�
 * ����Ҫʵ�ֻ��湦�ܵ�ҳ�� require 'auto_cache.php'; ��ok��
 * @author rains31@gmail.com
 */

//��Ż���ĸ�Ŀ¼,����Ƿŵ�/tmpĿ¼,���������������û�,��Ϊ/tmpĿ¼��ռ�Լ�����ҳ�ռ䰡:)

define('CACHE_ROOT', dirname(dirname(__FILE__)) . '/scache');

//�����ļ��������ڣ���λ�룬86400����һ��

define('CACHE_LIFE', 86400);

//�����ļ�����չ����ǧ����� .php .asp .jsp .pl �ȵ�

define('CACHE_SUFFIX', '.cache');

//�����ļ���

$file_name = md5($_SERVER['REQUEST_URI']) . CACHE_SUFFIX;

//����Ŀ¼������md5��ǰ��λ�ѻ����ļ���ɢ���������ļ����ࡣ����б�Ҫ�������õ�����λΪ�����ټ�һ��Ŀ¼��

//256��Ŀ¼ÿ��Ŀ¼1000���ļ��Ļ�������25���ҳ�档����Ŀ¼�Ļ�����65536*1000=��ǧ�����

//��Ҫ�õ���Ŀ¼����1000������Ӱ�����ܡ�

$cache_dir = CACHE_ROOT . '/' . substr($file_name, 0, 3) . '/' . substr($file_name, 3, 3);

//�����ļ�

$cache_file = $cache_dir . '/' . $file_name;

//GET��ʽ����Ż��棬POST֮��һ�㶼ϣ���������µĽ��

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	//��������ļ����ڣ�����û�й��ڣ��Ͱ�����������

	if (file_exists($cache_file) && time() - filemtime($cache_file) < CACHE_LIFE) {

		$fp = fopen($cache_file, 'rb');

		fpassthru($fp);

		fclose($fp);

		exit;

	}

	elseif (!file_exists($cache_dir)) {

		if (!file_exists(CACHE_ROOT)) {

			mkdir(CACHE_ROOT, 0777);

			chmod(CACHE_ROOT, 0777);

		}

		mkdir($cache_dir, 0777);

		chmod($cache_dir, 0777);

	}

	//�ص����������������ʱ�Զ����ô˺���

	function auto_cache($contents) {

		global $cache_file;

		$fp = fopen($cache_file, 'wb');

		fwrite($fp, $contents);

		fclose($fp);

		chmod($cache_file, 0777);

		//�����»����ͬʱ���Զ�ɾ�����е��ϻ��档�Խ�Լ�ռ䡣

		clean_old_cache();

		return $contents;

	}

	function clean_old_cache() {

		chdir(CACHE_ROOT);

		foreach (glob("*/*" . CACHE_SUFFIX) as $file) {

			if (time() - filemtime($file) > CACHE_LIFE) {

				unlink($file);

			}

		}

	}

	//�ص����� auto_cache

	ob_start('auto_cache');

} else {

	//����GET�������ɾ�������ļ���

	if (file_exists($cache_file))
		unlink($cache_file);

}
?>