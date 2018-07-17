<?php
/**
 * 图片，视频上传
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/7/6
 * Time: 11:58
 */

namespace Upload\Controller;


use Think\Controller;

class UploadController extends Controller
{
    public function index()
    {
        $this->display();
    }

    /**
     * 上传文件
     */
    public function upload()
    {
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

        $uploadData = array(
            'savePath' => "/Uploads/Picture/".date('Y-m-d') . '/',
        );
        $data = UploadFile($uploadData);
        if (is_string($data)) {                                                                        //上传失败
            $return['status'] = 0;
            $return['info']   = $data;
        } else {
            $data = $data['file'];
            $exitFile = $data['savepath'] . $data['savename'];
            $return['data'] = $exitFile;
        }

        $this->ajaxReturn($return);
    }

}