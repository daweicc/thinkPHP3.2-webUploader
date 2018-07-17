<?php
/**
 * Created by PhpStorm.
 * User: daweicc
 * Date: 2018/3/8
 * Time: 10:19
 */

namespace Common\Utils;
use Common\Utils\FormatArrayUtils;

class CommonUtils
{
    static $children = array();
    static $parents = array();


    /**
     * 获取指定字段相加的和
     * @param $arr 二维数组
     * @param $key 字段名
     * @return int
     */
    public static function getSumByKey($arr, $key)
    {
        if (!$arr || !$key) return 0;

        $sum = 0;

        foreach ($arr as $item) {
            $sum += $item[$key];

        }

        return $sum;
    }

    /**
     * 获取当前分类所有子元素
     * $model 表名   $field要返回的字段
     * $hasThis为true时返回的结果包括自己
     * return string
     * @date: 2016-12-15 下午4:44:29
     */
    public static function getChildren($model,$pid,$field,$hasThis = false){
        self::$children = array();
        $datas = $model->select();
        $datas = self::treeIn($datas,$pid);

        $initVal = $hasThis == true ? $pid : 0;

        $datas = FormatArrayUtils::unionValueByKey($datas,$field,$initVal);

        return $datas;
    }

    /**
     * 递归获取子元素
     * @date: 2016-11-26 下午4:53:10
     */
    public static function treeIn($arr=array(),$pid=0){
        unset($v);
        foreach($arr as $k=>$v){
            if($v['pid'] == $pid){
                self::$children[] = $arr[$k];
                self::treeIn($arr,$v['id']);
            }
        }
        return self::$children;
    }

    /**
     * 根据父id获取上级
     * $group_id 初始id
     * @date: 2017-8-1 下午4:18:08
     */
    public static function getPbyid($model,$group_id,$type=0){
        $pid = $model->where(array('id'=>$group_id))->getField('pid');
        if(intval($pid) != 0){
            $par = $model->where(array('id'=>$pid))->find();
            if(!empty($par)){
                self::$parents[] = $par;
                return self::getPbyid($model,$par['id']);
            }
        }
        return self::$parents;
    }


}