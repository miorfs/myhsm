<?php
// include "../function/session_custom.php";
// sec_session_start(); 
session_start();
require "../models/fileupload.php";


if(isset($_POST["upload-btn"])){
    extract($_POST);

    // give new file name
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    // original file location
    $file_loc = $_FILES['file']['tmp_name'];
    // size of the file
    $file_size = $_FILES['file']['size'];
    // type of the file
    $file_type = $_FILES['file']['type'];
    // folder to move the file
    $folder="../plugins/images/users/";
    
    // new file size in KB
    $new_size = $file_size/1024;  
    // new file size in KB
    
    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case
    
    $final_file=str_replace(' ','-',$new_file_name);

    if(move_uploaded_file($file_loc,$folder.$final_file))
    {
        $upload = new fileupload();
        $upload -> uploadFile($final_file,$file_type,$new_size,$user_id);
    }
    
}else if(isset($_POST["update-btn"])){
    extract($_POST);

    // give new file name
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    // original file location
    $file_loc = $_FILES['file']['tmp_name'];
    // size of the file
    $file_size = $_FILES['file']['size'];
    // type of the file
    $file_type = $_FILES['file']['type'];
    // folder to move the file
    $folder="../plugins/images/users/";
    
    // new file size in KB
    $new_size = $file_size/1024;  
    // new file size in KB
    
    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case
    
    $final_file=str_replace(' ','-',$new_file_name);

    if(move_uploaded_file($file_loc,$folder.$final_file))
    {
        $upload = new fileupload();
        $upload -> updateFile($pic_id,$final_file,$file_type,$new_size,$user_id);
    }
    
}


?>