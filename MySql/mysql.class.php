<?php
/**
* ���ݿ����
$dbhost = 'localhost';        //���ݿ����������(host:port)
$dbuser = 'root';                //���ݿ��ʺ�
$dbpw = 'jason7862102';  //���ݿ�����
$dbname = 'yxeee';       //���ݿ���
$dbpre = 'ds_';                   //���ݱ�ǰ׺
$pconnect = 0;                    //���ݿ�־����� 0=�ر�, 1=��
$dbcharset = 'latin1';            //���ݿ����

require_once ROOT.'plugins/mysql.class.php';
$db = new Db_class($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
*/


class Db_class {
	var $query_num = 0;
	var $link;

	function Db_class($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
		$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	}

	/**
	 * �������ݿ�
	 *
	 * @param string $dbhost ���ݿ��������ַ
	 * @param string $dbuser ���ݿ��û���
	 * @param string $dbpw ���ݿ�����
	 * @param string $dbname ���ݿ���
	 * @param integer $pconnect �Ƿ�־����� [0=��] [1=��]
	 */
	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
        global $dbcharset;
        $func = empty($pconnect) ? "mysql_connect" : "mysql_pconnect";
        if(!$this->link = @$func($dbhost, $dbuser, $dbpw, 1)) {
        	$this->halt("Can not connect to MySQL server");
        }
        if($this->version() > '4.1' && $dbcharset)
			mysql_query("SET NAMES '" . $dbcharset . "'", $this->link);
		if($this->version() > '5.0')
			mysql_query("SET sql_mode=''", $this->link);
		if($dbname) {
			if (!@mysql_select_db($dbname, $this->link)) $this->halt('Cannot use database '.$dbname);
		}
	}

	/**
	 * ѡ��һ�����ݿ�
	 *
	 * @param string $dbname ���ݿ���
	 */
	function select_db($dbname) {
		$this->dbname = $dbname;
		if (!@mysql_select_db($dbname, $this->link))
			$this->halt('Cannot use database '.$dbname);
	}

	/**
	 * ��ѯ���ݿ�汾��Ϣ
	 *
	 * @return string
	 */
	function version() {
		return mysql_get_server_info();
	}

	/**
	 * ����һ�� MySQL ��ѯ
	 *
	 * @param string $SQL SQL�﷨
	 * @param string $method ��ѯ��ʽ [��=�Զ���ȡ����������] [unbuffer=������ȡ�ͻ���������]
	 * @return resource ��Դ��ʶ��
	 */
	function query($SQL, $method = '') {
        if($method == 'unbuffer' && function_exists('mysql_unbuffered_query'))
			$query = mysql_unbuffered_query($SQL, $this->link);
		else
			$query = mysql_query($SQL, $this->link);
		if (!$query && $method != 'SILENT')
            $this->halt('MySQL Query Error: ' . $SQL);
        $this->query_num++;
        //echo $SQL.'<br />';
		return $query;
	}

	/**
	 * ����һ�����ڸ��£�ɾ���� MySQL ��ѯ
	 *
	 * @param string $SQL
	 * @return resource
	 */
	function update($SQL) {
		return $this->query($SQL, 'unbuffer');
	}

	/**
	 * ����һ��SQL��ѯ����Ҫ�󷵻�һ���ֶ�ֵ
	 *
	 * @param string $SQL
	 * @param int $result_type
	 * @return string
	 */
    function get_value($SQL, $result_type = MYSQL_NUM) {
        $query = $this->query($SQL,'unbuffer');
        $rs =& mysql_fetch_array($query, MYSQL_NUM);
        return $rs[0];
    }

    /**
     * ����һ��SQL��ѯ��������һ�����ݼ�
     *
     * @param string $SQL
     * @return array
     */
	function get_one($SQL) {
		$query = $this->query($SQL,'unbuffer');
		$rs =& mysql_fetch_array($query, MYSQL_ASSOC);
		return $rs;
	}

	/**
	 * ����һ��SQL��ѯ��������ȫ�����ݼ�
	 *
	 * @param string $SQL
	 * @param int $result_type
	 * @return array
	 */
    function get_all($SQL, $result_type = MYSQL_ASSOC) {
        $query = $this->query($SQL);
        while($row = mysql_fetch_array($query, $result_type)) $result[] = $row;
        return $result;
    }

    /**
     * �ӽ������ȡ��һ����Ϊ�������飬���������飬����߼���
     *
     * @param resource $query
     * @param int $result_type
     * @return array
     */
    function fetch_array($query, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($query, $result_type);
    }

    /**
     * ������һ��ִ��SQL�󣬱�Ӱ���޸ĵ���(��)��
     *
     * @return int
     */
	function affected_rows() {
		return mysql_affected_rows($this->link);
	}

	/**
	 * �ӽ������ȡ��һ����Ϊö������
	 *
	 * @param resource $query
	 * @return array
	 */
	function fetch_row($query) {
		return mysql_fetch_row($query);
	}

	/**
	 * ȡ�ý�������е���Ŀ
	 *
	 * @param resource $query
	 * @return int
	 */
	function num_rows($query) {
		return mysql_num_rows($query);
	}

	/**
	 * ȡ�ý�������ֶε���Ŀ
	 *
	 * @param resource $query
	 * @return int
	 */
	function num_fields($query) {
		return mysql_num_fields($query);
	}

	/**
	 * ȡ�ý������
	 *
	 * @param resource $query
	 * @param int $row �ֶε�ƫ���������ֶ���
	 * @return mixed
	 */
	function result($query, $row) {
		$query = mysql_result($query, $row);
		return $query;
	}

	/**
	 *  �ͷŽ���ڴ�
	 *
	 * @param resource $query
	 * @return bool
	 */
	function free_result($result) {
		return mysql_free_result($result);
	}

	/**
	 * ȡ����һ�� INSERT ���������� ID
	 *
	 * @return int
	 */
	function insert_id() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	/**
	 * �ر� MySQL ��
	 *
	 * @return bool
	 */
	function close() {
		return mysql_close($this->link);
	}

	/**
	 * ������һ�� MySQL �����������ı�������Ϣ
	 *
	 * @return string
	 */
    function error() {
        return (($this->link) ? mysql_error($this->link) : mysql_error());
    }

    /**
     * ������һ�� MySQL �����еĴ�����Ϣ�����ֱ���
     *
     * @return integer
     */
    function errno() {
        return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
    }

    /**
     * ��ѯ���������ݼ���ֻ֧�ֵ�һ���ݱ�
     *
     * @param string $fields ���ֶ�","�ָ�
     * @param string $table ���ݱ���
     * @param array $where ��ѯ����
     * @return resource
     */
    function select_query($fields, $table, $where, $limit='') {
        if(!$fields) return;
        if(!$table) return;
        $where = $where ? "WHERE $where" : '';
        $limit = $limit ? "LIMIT $limit" : '';
        return $this->query("SELECT $fields FROM $table $where $limit");
    }

    function select_one($fields, $table, $where) {
        if(!$fields) return;
        if(!$table) return;
        $where = $where ? "WHERE $where" : '';
        return $this->get_one("SELECT $fields FROM $table $where");
    }

    function select_all($fields, $table, $where, $limit='') {
        if(!$fields) return;
        if(!$table) return;
        $where = $where ? "WHERE $where" : '';
        $limit = $limit ? "LIMIT $limit" : '';
        return $this->get_all("SELECT $fields FROM $table $where $limit");
    }

    function select_value($field, $table, $where) {
        if(!$field) return;
        if(!$table) return;
        $where = $where ? "WHERE $where" : '';
        return $this->get_value("SELECT $field FROM $table $where");
    }

    // ��ѯ��������
    function select_count($table, $where) {
        return $this->select_value("COUNT(*)", $table, $where);
    }

    // ɾ��ĳ����¼
    function delete_new($table, $where) {
        if(!$table) return;
        $where = $where ? "WHERE $where" : '';
        return $this->query("DELETE FROM $table $where");
    }

    /**
     * ����/���������
     *
     * @param string $table ���ݱ���
     * @param array $uplist ��������,��������Ӧ�ֶ���
     * @return resource
     */
     function insert_new($table, $inlist) {
        if(!$table) return;
        if(!is_array($inlist) || count($inlist) == 0) return;
        foreach($inlist as $key => $val) {
            $set[] = "$key='$val'";
        }
        $SQL = "INSERT $table SET ".implode(", ", $set)." $where";
        return $this->query($SQL);
     }

    /**
     * ���±�����
     *
     * @param string $table ���ݱ���
     * @param string $where ��������
     * @param array $uplist ���µ���������,��������Ӧ�ֶ���
     * @return resource
     */
    function update_new($table,$where,$uplist,$replace=0) {
        if(!$table) return;
        if(!is_array($uplist) || count($uplist) == 0) return;
        $where = $where ? "WHERE $where" : '';
        foreach($uplist as $key => $val) {
            $set[] = "$key='$val'";
        }
        if($replace) {
            $SQL = "REPLACE INTO %s SET %s";
        } else {
            $SQL = "UPDATE %s SET %s";
        }
        $SQL = sprintf($SQL, $table, implode(", ", $set)." $where");
        return $this->query($SQL);
    }

	function halt($msg = '') {
        global $charset;
		$message = "<html>\n<head>\n";
		$message .= "<meta content=\"text/html; charset=$charset\" http-equiv=\"Content-Type\">\n";
		$message .= "<style type=\"text/css\">\n";
		$message .=  "body,p,pre {\n";
		$message .=  "font:12px Verdana;\n";
		$message .=  "}\n";
		$message .=  "</style>\n";
		$message .= "</head>\n";
		$message .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#006699\" vlink=\"#5493B4\">\n";

		$message .= "<p>���ݿ����:</p><pre><b>".htmlspecialchars($msg)."</b></pre>\n";
		$message .= "<b>Mysql error description</b>: ".htmlspecialchars($this->error())."\n<br />";
		$message .= "<b>Mysql error number</b>: ".$this->errno()."\n<br />";
		$message .= "<b>Date</b>: ".date("Y-m-d @ H:i")."\n<br />";
		$message .= "<b>Script</b>: http://".$_SERVER['HTTP_HOST'].getenv("REQUEST_URI")."\n<br />";

		$message .= "</body>\n</html>";
		echo $message;
		exit;
	}
}
?>