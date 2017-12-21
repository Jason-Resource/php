<?php
/**
*��Ȩ˵�����ð汾���ڡ�IEB_UPLOAD CLASS Ver 1.1���Ļ����϶��ο����ģ�ԭ�����ͼƬ�Ĳü���ʹͼƬ���Ρ�ʧ�棡�����������ݲ�����ԭͼƬ�ļ�����(��Ҫ��ָ��͸�)���жԱȣ��ó�����ֵ����������ԭͼƬͬ�������ŵ�ͼƬ��Ȼ�����Ը��м�ͼ���Ŀ�ʼ��ȡ���Ӷ��������ͼ����Ȼ��ͼƬ�ᱻ�ü�����������С�޶ȵĲü���
*@author��swin.wang  Email: php_in_china@yahoo.com.cn
*@update:  sunbeam   Email: sunjingzhi2@126.com
*/
class ieb_upload{
 
 /**
  * ���� �ļ���<input type="file" id="FileName">����
  * @var string 
  */
 var $FileName = ""; 
 
 /**
  * �ϴ�Ŀ¼
  * @var string
  */
 var $Directroy = ""; 
 
 /**
  * ����ļ���С
  * @var int
  */
 var $MaxSize = 2097152; 
 
 /**
  * �Ƿ�����ϴ�
  * @var bool
  */
 var $CanUpload = true; 
 
 /**
  * �ϴ��ļ���
  * @var string
  */
 var $doUpFile = ''; 
 
 /**
  * ����ͼ��
  * @var string
  */
 var $sm_File = ''; 
 
 /**
  * �쳣��
  * @var int
  */
 var $Error = 0; 
 
 /**
 * ���캯��
 *
 * @param  string  $FileName
 * @param  string  $dirPath
 * @param  int  $maxSize
 * @return  null
 */
 function ieb_upload($FileName='', $dirPath='', $maxSize=2097152) //(1024*2)*1024=2097152 ���� 2M
 {
  //global $FileName, $Directroy, $MaxSize, $CanUpload, $Error, $doUpFile, $sm_File;
  //��ʼ�����ֲ���
  $this->FileName = $FileName;
  $this->MaxSize = $maxSize;
  
  if ($FileName == ''){
   $this->CanUpload = false;
   $this->Error = 1;
   break;
  }
  
  if ($dirPath != ''){
   $this->Directroy = $dirPath;
  }else{
   $this->Directroy = './';
  }
 }
 

 /**
  * ����ļ��Ƿ����
  * 
  * @return bool 
  */
 function scanFile()
 {  
  if ($this->CanUpload){ 
   $scan = is_readable($_FILES[$this->FileName]['name']);  
   if ($scan){   
    $Error = 2;
   }  
   return $scan;
  }
 }
 

 /**
  * ��ȡ�ļ���С
  * 
  * @return int 
  */
 function getSize($format = 'B')
 {
  
  if ($this->CanUpload){  
   if ($_FILES[$this->FileName]['size'] == 0){
    $this->Error = 3;
    $this->CanUpload = false;
   }  
   switch ($format){
    case 'B':
    return $_FILES[$this->FileName]['size'];
    break;
    
    case 'M':
    return ($_FILES[$this->FileName]['size'])/(1024*1024);
   }  
  }
 }
 


 /**
  * ��ȡ�ļ�����
  * 
  * @return string 
  */
 function getExt()
 { 
  if ($this->CanUpload){
   $ext=$_FILES[$this->FileName]['name'];
   $extStr=explode('.',$ext);
   $count=count($extStr)-1;
  }
  return $extStr[$count];
 }
 
 
 /**
  * ��ȡ�ļ�����
  * 
  * @return string 
  */
 function getName()
 { 
  if ($this->CanUpload){
   return $_FILES[$this->FileName]['name'];
  }
 }
 
 /**
  * �½��ļ���
  * 
  * @return string 
  */
 function newName()
 {  
  if ($this->CanUpload){
   $FullName=$_FILES[$this->FileName]['name'];
   $extStr=explode('.',$FullName);
   $count=count($extStr)-1;
   $ext = $extStr[$count];
   
   return date('YmdHis').rand(0,9).'.'.$ext;
  }
 }
 
 
 /**
  * �ϴ��ļ���ʧ��ʱ�����쳣���ͺ�
  * 
  * @param   string   $fileName
  * @return    
  */ 
 function upload($fileName = '')
 {  
  if ($this->CanUpload){
   if ($_FILES[$this->FileName]['size'] == 0){
    $this->Error = 3;
    $this->CanUpload = false;
    return $this->Error;
    break;
   }
  }
  
  if($this->CanUpload){ 
   if ($fileName == ''){
    $fileName = $_FILES[$this->FileName]['name'];
   }  
   $this->doUpload=@copy($_FILES[$this->FileName]['tmp_name'], $this->Directroy.$fileName);  
   if($this->doUpload)
   {
    $this->doUpFile = $fileName;
    chmod($this->Directroy.$fileName, 0777);
    return true;
   }else{
    $this->Error = 4;
    return $this->Error;
   }
  }
 }
 

 /**
  * ����ͼƬ����ͼ,�ɹ������棬���򷵻ش������ͺ�
  *
  * @param string $dscChar   ǰ׺
  * @param int $width    ����ͼ��
  * @param int $height   ����ͼ��
  * @return 
  */
 function thumb($dscChar='',$width=160,$height=120)
 {  
  if ($this->CanUpload && $this->doUpFile != ''){
   $srcFile = $this->doUpFile;
   
   if ($dscChar == ''){
    $dscChar = 'sm_';
   }
   
   $dscFile = $this->Directroy.$dscChar.$srcFile;
   $data = getimagesize($this->Directroy.$srcFile,&$info);
   
   switch ($data[2]) {
    case 1:
    $im = @imagecreatefromgif($this->Directroy.$srcFile);
    break;
    
    case 2:
    $im = @imagecreatefromjpeg($this->Directroy.$srcFile);
    break;
    
    case 3:
    $im = @imagecreatefrompng($this->Directroy.$srcFile);
    break;
   }
   
   $srcW=imagesx($im);
   $srcH=imagesy($im);
   
   if(($srcW/$width)>=($srcH/$height)){
    $temp_height=$height;
    $temp_width=$srcW/($srcH/$height);
    $src_X=abs(($width-$temp_width)/2);
    $src_Y=0;
   }
   else{
    $temp_width=$width;
    $temp_height=$srcH/($srcW/$width);
    $src_X=0;
    $src_Y=abs(($height-$temp_height)/2);
   }
   $temp_img=imagecreatetruecolor($temp_width,$temp_height);
   imagecopyresized($temp_img,$im,0,0,0,0,$temp_width,$temp_height,$srcW,$srcH);
      
   $ni=imagecreatetruecolor($width,$height);
   imagecopyresized($ni,$temp_img,0,0,$src_X,$src_Y,$width,$height,$width,$height);
   $cr = imagejpeg($ni,$dscFile);
   chmod($dscFile, 0777);
      
   if ($cr){
    $this->sm_File = $dscFile;
    return true;
   }else{
    $this->Error = 5;
    return $this->Error;
   }
  }
 }
 
 
 /**
  * ���ش������ͺţ������쳣����
  *
  * @return int
  */
 function Err(){
  return $this->Error;
 }
 
 
 /**
  * �ϴ�����ļ���
  *
  * @return unknown
  */
 function UpFile(){
  if ($this->doUpFile != ''){
   return $this->doUpFile;
  }else{
   $this->Error = 6;
  }
 }
 
 
 /**
  * �ϴ��ļ���·��
  *
  * @return unknown
  */
 function filePath(){
  if ($this->doUpFile != ''){
   return $this->Directroy.$this->doUpFile;
  }else{
   $this->Error = 6;
  }  
 }
 
 
 /**
  * ����ͼ�ļ�����
  *
  * @return unknown
  */
 function thumbMap(){
  if ($this->sm_File != ''){
   return $this->sm_File;
  }else{
   $this->Error = 6;
  }
 }
 
 /**
  * �汾��Ϣ
  *
  * @return unknown
  */
 function ieb_version(){
  return 'Ver 0.1';
 }
}

?>

<HTML> 
<HEAD> 
<TITLE>�ļ��ϴ����</TITLE> 
</HEAD> 
<BODY> 
<TABLE> 
<FORM ENCTYPE="multipart/form-data" NAME="MyForm"  METHOD="POST"> 
<TR><TD>ѡ���ϴ��ļ�</TD><TD>
<INPUT NAME="MyFile" TYPE="File"></TD></TR> 
<TR><TD COLSPAN="2">
<INPUT NAME="submit" VALUE="�ϴ�" TYPE="submit"></TD></TR> 
</TABLE> 
</BODY> 
</HTML> 

<?
 //var_dump($_FILES['MyFile']);
 $dir = dirname(__FILE__);
 $imgHandle = new ieb_upload('MyFile',$dir."/"); 
 $old_file_name = $imgHandle->getName();
 $old_file_fooder = $imgHandle->getExt();
 $file_size=$imgHandle-> getSize();
 $file_name=$imgHandle-> newName();
 $imgHandle->upload($file_name); 
 $imgHandle->thumb("small_",160,120);

?>

