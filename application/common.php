<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * @description  获取IP地址
 * @return string IP地址
 * @author Byrant  2020-03-17
 */
function get_IP(){
    static $realIP;
    if(isset($_SERVER)){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $realIP=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if(isset($_SERVER['HTTP_CLIENT_IP'])){
            $realIP=$_SERVER['HTTP_CLIENT_IP'];
        }else{
            $realIP=$_SERVER['REMOTE_ADDR'];
        }
    }else{
        if(getenv('HTTP_X_FORWARDED_FOR')){
            $realIP=getenv('HTTP_X_FORWARDED_FOR');
        }else if(getenv('HTTP_CLIENT_IP')){
            $realIP=getenv('HTTP_CLIENT_IP');
        }else{
            $realIP=getenv('REMOTE_ADDR');
        }
    }
    return $realIP;
}
/**
 * @description  验证手机号格式是否正确
 * @return $data string 手机号 
 * @author Byrant  2020-03-17
 */
//验证手机号格式是否正确
function checkPhone($data){
    $status=null;
    if(!preg_match("/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(16[6])|(17[0,3,5-8])|(18[0-9])|(19[89]))\d{8}$/", $data)){
        $status=[
            'status'=>0,
            'msg'=>'手机号格式不正确'
        ];
    }
    return $status;
}