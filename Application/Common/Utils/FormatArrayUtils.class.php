<?php
/**
 * Created by PhpStorm.
 * User: daweicc
 * Date: 2018/3/7
 * Time: 11:50
 */

namespace Common\Utils;


class FormatArrayUtils
{
    /**
     * 数组键名转换为指定字段值
     * @param array $data
     * @param string $key
     * @return array
     */
    public static function changeKey($data=array(), $key='')
    {
        if(empty($data) || empty($key)) return $data;

        $returnRes = array();
        foreach ($data as $k => $v) {
            if($v[$key])
                $returnRes[$v[$key]] = $v;
        }

        return $returnRes;
    }


    /**
     * 数组键名转换为指定字段值
     * (根据字段分组)
     * @param $data
     * @param $key
     * @return array
     */
    public static function changeKeyArray($data, $key)
    {
        if(empty($data) || empty($key)) return $data;

        $resData = array();
        foreach ($data as $k=>$v) {
            $resData[$v[$key]][] = $data[$k];
        }

        return $resData;
    }


    /**
     * @param $data     被匹配数据源
     * @param $key      被匹配数据对应的字段名
     * @param $val      匹配值
     * @param $fields   返回的数据对应的字段名
     * @param string $default  默认值
     * @return mixed  字段$fields对应的值
     */
    public static function returnValueByKv($data, $key, $val, $fields, $default = '')
    {
        $reVal = $default;
        foreach ($data as $k => $v) {
            if ($v[$key] == $val) {
                $reVal = $fields ? $v[$fields] : $data[$k];
                break;
            }
        }

        return $reVal;

    }

    /**
     * @param $initVal     初始值
     * @param array $data  数据源
     * @param $key         想要获取数据的键名
     * @return array
     */
    public static function unionValueByKey($data=array(),$key,$initVal){
        unset($v);
        $lists = array();

        if (!empty($initVal)) $lists[] = $initVal;
        unset($v);
        foreach($data as $k=>$v){

            $lists[] = $v[$key];
        }

        $lists = array_unique($lists);
        return $lists;
    }

}