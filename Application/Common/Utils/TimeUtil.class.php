<?php
/**
 * Created by PhpStorm.
 * User: daweicc
 * Date: 2018/5/11
 * Time: 2:12
 */

namespace Common\Utils;


class TimeUtil
{

    /**
     * 格式化时间
     * @param $data
     * @param string $format
     * @return bool
     */
    public static function formatTime(& $data, $format = 'Y-m-d H:i:s')
    {
        if(empty($data)) return false;
        foreach($data as $key => $item){
            if(is_array($item)){
                self::formatTime($data[$key], $format);
            }else{

                if(strpos($key, 'time') && is_numeric($data[$key])){
                    $data[$key] = $item > 0 ? date($format, $item) : '';
                    //$data[$key] = $item = date($format, $item);
                }
            }
        }
        return $data;

    }

}