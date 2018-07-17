<?php
/**
 * Created by PhpStorm.
 * User: daweicc
 * Date: 2018/2/26
 * Time: 10:12
 */

namespace Common\Utils;


class PrintUtils
{

    /**
     * 格式化数据
     * @param int $code     状态码 0 成功
     * @param array $data   数据体
     * @param string $msg   信息
     * @return array
     */
    public static function P($code = 0,$data = array(), $msg = '')
    {
        $parseData = array();
        if (empty($msg)) $msg = 'success';

        $parseData['code'] = $code;
        $parseData['data'] = $data;
        $parseData['msg'] = $msg;
        return $parseData;
    }

    /**
     * 正确返回
     * @param string $msg
     * @param null $data
     * @return array
     */
    public static function S($msg = '', $data = null)
    {
        return self::P(0, $data, $msg);
    }

    /**
     * 错误返回
     * @param $msg
     * @return array
     */
    public static function E($msg='')
    {
        return self::P(-1, null, $msg);
    }

    /**
     * Json格式输出 相当于ajaxReturn
     * @param $data
     * @param int $json_option
     */
    public static function R($data, $json_option=0)
    {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data,$json_option));
    }



}