<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17
 * Time: 21:37
 */

function p($data = array())
{
    header('Content-type:text/html;charset=utf-8');

    echo '<pre>';

    print_r($data);;

}



/**
 * 逗号拼接数据
 * $arr:数据来源，$key:需要拼接的字段
 * @date: 2016-12-5 下午2:16:02
 */
function unionD($list='',$arr=array(),$key='id'){
    unset($v);
    foreach($arr as $k=>$v){
        if($list == ''){
            $v[$key] && $list = $v[$key];
        }else{
            $v[$key] && $list = $list . ',' . $v[$key];
        }
    }
    return $list;
}



/**
 * 导出数据
 * @param string $xlsName 	表前缀
 * @param array $xlsCell	第一行的文字
 * @param array $xlsData 	导出的数据
 * @return boolean 			返回真假
 */
function expData($expTitle,$expCellName,$expTableData,$str = '') {
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = $expTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);
    vendor('PHPExcel.Classes.PHPExcel');
    vendor('PHPExcel.Classes.PHPExcel.IOFactory');
    vendor('PHPExcel.Classes.PHPExcel.Reader.Excel5');
    $objPHPExcel = new PHPExcel();
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
    for($i=0;$i<$cellNum;$i++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
    }
    // Miscellaneous glyphs, UTF-8
    for($i=0;$i<$dataNum;$i++){
        for($j=0;$j<$cellNum;$j++){
            $len = mb_strlen($expTableData[$i][$expCellName[$j][0]],'utf8') + 5;
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellName[$j])->setWidth($len);
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
        }
    }

    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}