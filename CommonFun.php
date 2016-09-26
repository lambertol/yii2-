<?php
/**
* 公共函数类
* @author lambert
*/
namespace common\helper;

use Yii;

class CommonFun
{
    /**
    * 项目小部件  前台select显示 数据格式
    * @param $info 数据库查出来的二位数组
    * @param $passkey 建名的字段名
    * @param $passvalue 建值的字段名
    * @author lambert
    */
    public static function selectStyle($info, $passkey, $passvalue, $isAdd = false)
    {
        if (is_array($info)) {
            foreach ($info as $key => $value) {
                if ($isAdd) {
                    $datas[$value[$passkey]] = $passvalue[$value[$passkey]];
                } else {
                    $datas[$value[$passkey]] = $value[$passvalue];
                }
            }
            return $datas;
        } else {
            return false;
        }
        
    }
    /**
    * 地址三级联动返回数据格式
    * @param $info 数据库查出来的二位数组 所有数据
    * @author lambert
    * @return array()
    */
    public static function provice($info){
        if (!is_array($info)) {
            return '请传入数组';
        }
        $data = array();
        //处理省份
        foreach ($info as $key => $value) {
            if ($value['parent_code'] == 1) {
                $data['provice'][] = array("id" => $value['area_code'], 'province' => $value['name'], 'parent' => $value['parent_code']);
                $keys[] = $value['area_code'];  
            }
        }
        //处理城市
        foreach ($info as $key => $value) {
            if (in_array($value['parent_code'], $keys) || $value['parent_code'] == 1) {
                $data['city'][] = array("id" => $value['area_code'], 'city' => $value['name'], 'parent' => $value['parent_code']);
                $keys[] = $value['area_code'];
            }
        }
        //处理镇
        foreach ($info as $key => $value) {
            $data['county'][] = array("id" => $value['area_code'], 'county' => $value['name'], 'parent' => $value['parent_code']);
        }
        return $data;
    }
}
