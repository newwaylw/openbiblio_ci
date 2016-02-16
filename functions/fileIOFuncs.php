<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 require_once("../shared/global_constants.php");
/*********************************************************************************
 * Does the same as file_get_contents but will work with PHP version < 4.3
 * @return string
 * @access public
 *********************************************************************************
 */
function fileGetContents($filename){
  $result = "";
  $handle = @fopen ($filename, "rb");
  if ($handle === FALSE) {
    return FALSE;
  }
  while (!feof ($handle)) {
    $buffer = fgets($handle, 4096);
    if ($buffer === FALSE && !feof($handle)) {
      return FALSE;
    }
    $result .= $buffer;
  }
  if (!fclose ($handle)) {
    /* We don't care because we've finished reading. */
    // return FALSE;
  }
  return $result;
}

function fileUpload($inputname){
  $target_path =  UPLOAD_DIR;
  #use date time as part of the file name
  $fname = date("YmdHis");
  #add random prefix to avoid file name duplicate
  #$fname .= rand(1,10000);
  $fname .= basename( $_FILES[$inputname]['name']);

  $target_path = $target_path . $fname; 
  $upload_status=$_FILES[$inputname]["error"];   //获取文件出错情况

  if(move_uploaded_file($_FILES[$inputname]['tmp_name'], $target_path)) {  
  //  echo " file has been uploaded to $target_path ";
    return $target_path;
  } else{
    return "";
  //  $msg = file_upload_error_message($_FILES['file']['error']);
  //  echo "Error:$msg</br>";
  }

}

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}

?>
