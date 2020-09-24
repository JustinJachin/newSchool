<?php

// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\model;
use think\Model;
use think\Session;
/**
 * 管理员模型
 */
class Useradmin extends Model
{

    /**
     * @description  获取器获取性别，重新赋值
     * @param  int    $value
     * @return string 
     * @author Byrant  2020-03-17
     */
    public function getSexAttr($value){

      $sex=[1=>'男',0=>'女'];

      return $sex[$value];

    }
    /**
     * @description  获取器获取类型，重新赋值
     * @param  int    $value
     * @return string 
     * @author Byrant  2020-03-17
     */
    public function getTypeAttr($value){

      $sex=[1=>'管理员',0=>'超级管理员'];

      return $sex[$value];

    }
    /**
     * @description  获取器获取状态，重新赋值
     * @param  int    $value
     * @return string 
     * @author Byrant  2020-03-17
     */
    public function getStatusAttr($value){

      $status=[-1=>'删除',0=>'禁用',1=>'正常'];

      return $status[$value];

    }
    public function announcement(){
        return $this->hasMany('announcement');
    }
    /**
     * @description  登录验证
     * @param  string $name 学号/编号 string $pwd 密码 
     * @return bool 正确返回1错误返回0
     * @author Byrant  2020-03-17
     */
    public function check($name,$pwd)
    {
        $user=Useradmin::where('num',$name)->find();
        if(empty($user)){
            $status=[
              'status'=>0,
              'msg'=>'该用户不存在'
            ];
            return $status;
        }
        if($user['status']!='正常'){
            $status=[
              'status'=>0,
              'msg'=>'该用户被禁用或删除'
            ];
            return $status;
        }

        if(md5('my'.$pwd.'project'.md5("my_project"))===$user['password']){
            $uid=session('uid');
            if($uid===$user['id']){
                $status=[
                    'status'=>2,
                    'msg'=>'index/index'
                ];
            }else{
                $status=[
                    'status'=>1,
                    'msg'=>'index/index'
                ];

                \session('uid',$user['id']);
                \session('unum',$user['num']);
                \session('admin_name',$user['username']);
                \session('admin_type',0);
                \session('pic',$user['pic']);
            }
        }else{
            $status=[
                'status'=>0,
                'msg'=>'账号或者密码错误'
            ];
        }
        return $status;
    }

    /**
     * @description  更新登录信息
     * @param  string $data 数组
     * @author Byrant  2020-03-17
     */
    public function updateLogin($data){
      $userId=session('uid');
      Useradmin::save($data,['id'=>$userId]);
    }
}