<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/7/6
 * Time: 14:07
 */
//上传文件
function UploadFile($uploadData = array()){
    $upload = new \Think\Upload();// 实例化上传类

    $upload->maxSize   =     20971520 ;// 设置附件上传大小
    $upload->exts      =     array('apk', 'gif', 'png', 'jpeg','mp4','mp3', 'jpg');// 设置附件上传类型
    $upload->rootPath  =     './';  //根
    $upload->savePath  =     '/Uploads/'; // 设置附件上传目录
    $upload->subName   =     '';

    foreach ($uploadData as $k=>$v) {
        if (isset($k)) $upload->$k = $v;
    }

    $info = $upload->upload();
    if(!$info){
        return $upload->getError();
    }else{
        return $info;
    }
}