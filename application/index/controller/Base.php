<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use think\Controller;
/**
 * 基类控制器
 */
class Base extends Controller
{
    /**
     * @description 初始化
     * @author byrant  2020-03-17
     */
    public function _initialize(){
        $res=$this->is_login();
        if(!$res){
            return $this->redirect('login/index');
        }

    }
    /**
     * @description 验证是否已经登录
     * @author byrant  2020-03-17
     */
    public function is_login(){
        $uid=session('uid');
        
        if($uid){
            return true;
        }else{
            return false;
        }
    }
}
