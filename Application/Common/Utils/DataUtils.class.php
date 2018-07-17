<?php
/**
 * Created by PhpStorm.
 * User: daweicc
 * Date: 2018/2/5
 * Time: 17:00
 */

namespace Common\Utils;


class DataUtils
{
    /**
     * 对查询到的数据库进行处理，
     * 返回格式如下
     * 例1：
     * array(
     *  '传入key获取的值，例如用户id' => value
     * )
     * 例2：
     * array(
     *   0 => array(
     *      '传入key获取的值，例如用户id' => value
     *   ),
     *   1 => array(
     *      '传入key获取的值，例如用户id' => value
     *   ),
     * )
     *
     * 这样，就直接可以通过  $arr[用户ID] 获取属于这个用户的信息了
     * @param $data             @需要处理的数据
     * @param $key              @通过这个key，返回的数组中的key，就是这个获取到的数据
     * @return array
     */
//    public static function formatData($data, $key, & $handle = array())
//    {
//        if (empty($data) || empty($key)) return $handle;
//
//        foreach ($data as $k => $item) {
//            if (is_array($item)) {
//                self::formatData($item, $key, $handle);
//            } else {
//                $newKey = $data[$key];
//                $handle[$newKey] = $data;
//            }
//
//        }
//        return $handle;
//    }
//
//    /**
//     * 获取in条件
//     * @param $array        @数组
//     * @param $field        @需要In的字段
//     * @return string       @返回In的字符串
//     */
//    public static function handleArrIN($array, $field)
//    {
//        $returnArr = array();
//        foreach ($array as $item) {
//            $returnArr[] = $item[$field];
//        }
//
//        if (empty($returnArr)) return null;
//        $returnArr = array_unique($returnArr);              // 去重
//
//        return $returnArr;
//    }
//
//
//
//    /**
//     * 获取in条件
//     * @param $array        @数组
//     * @param $field        @需要In的字段
//     * @return string       @返回In的字符串
//     */
//    public static function handleIN($array, $field)
//    {
//        $returnArr = array();
//        foreach ($array as $item) {
//            $returnArr[] = $item[$field];
//        }
//
//        if (empty($returnArr)) return null;
//        $returnArr = array_unique($returnArr);              // 去重
//
//        return implode(',', $returnArr);
//    }
//
//
//
//
//
//
//    /**
//     * 对数据进行处理，进行分组
//     * @param $data
//     * @param $key
//     * @return mixed
//     */
//    public static function groupHandle($data, $key)
//    {
//
//        $groupArr = array();
//        if (empty($data)) return $groupArr;
//
//        foreach ($data as $item) {
//            $k     = $item[$key];                       // 分组的key
//            $groupArr[$k][] = $item;                    // 对年月数据，进行分组
//        }
//        return $groupArr;
//    }
//
//
//    /**
//     *  对分组数据进行计算
//     * @param $data                 @这个data是通过groupHandle处理后的数据
//     * @param $returnKeyArr         @返回数组的key数组
//     * @param $calculationArr       @需要计算的key数组   k=> value  别名 => key值
//     * @return array
//     */
//    public static function groupCalculation($data, $returnKeyArr, $calculationArr)
//    {
//        $resultList = array();
//        if (empty($data) || empty($returnKeyArr) || empty($calculationArr)) return $resultList;
//
//        foreach ($data as $k => $dItem) {
//
//            foreach ($dItem as $tempItem) {
//
//                $resultItem = $resultList[$k];
//                $insert = array();
//
//                foreach ($returnKeyArr as $returnItem) { $insert[$returnItem] = $tempItem[$returnItem]; }
//
//                foreach ($calculationArr as $ck => $cItem) {
//
//                    $key = is_numeric($ck) ? $cItem : $ck;
//
//                    $insert[$key] = empty($resultItem) ? $tempItem[$cItem] : ($resultItem[$key] + $tempItem[$cItem]);
//
//                }
//
//                $resultList[$k] = $insert;
//            }
//        }
//        return $resultList;
//    }
}