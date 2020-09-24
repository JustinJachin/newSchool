<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use think\Controller;

use think\captcha\Captcha;
use think\Request;
use app\index\model\Useradmin;
use app\index\model\Userteacher;
use app\index\model\Userstudent;
use think\Session;
/**
 * 登录界面
 */
class Login extends Base
{
    public function _initialize() {
    }
    /**
     * @description 登录首页
     * @author byrant  2020-03-17
     */
    public function index()
    {
    	
        $isLogin=$this->is_login();
        if($isLogin){
            return $this->redirect('index/index');
        }else{
            return $this->fetch('login');
        }
        
    }
    /**
     * @description  登录验证
     * @author byrant  2020-03-17
     */
    public function usercheck(){
        
        $captcha = new Captcha();
        if(request()->isPost()){
            $data=input('post.');
            if($data['username']==''){
                $status=array(
                    'status'=>0,
                    'msg'=>'学号/编号为空，请重新填写！'
                );
                return json($status);
            }
            if($data['password']==''){
                $status=array(
                    'status'=>0,
                    'msg'=>'密码为空，请重新填写！'
                );
                return json($status);
            }
            if($data['code']==''){
                $status=array(
                    'status'=>0,
                    'msg'=>'验证码为空，请重新填写！'
                );
                return json($status);
            }
            if(!$captcha->check($data['code'])){
                $status=array(
                    'status'=>0,
                    'msg'=>'验证码错误，请重新填写！'
                );
                return json($status);
            }
            
            switch ($data['type']) {
                case "0":
                    $admin=new Useradmin;
                    $status=$admin->check($data['username'],$data['password']);
                    return json($status);
                case "1":
                    $admin=new Userteacher;
                    $status=$admin->check($data['username'],$data['password']);
                    return json($status);
                case "2":
                    $admin=new Userstudent;
                    $status=$admin->check($data['username'],$data['password']);
                    return json($status);
                default:
                    $status=array(
                        'status'=>0,
                        'msg'=>'系统错误'
                    );
                    return json($status);
            }
        }    
           
    }
    /**
     * @description  验证码设置
     * @return 验证码
     * @author byrant  2020-03-17
     */
    public function verify(){
        ob_clean();
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    20,    
            // 验证码位数
            'length'      =>    4,   
            // 关闭验证码杂点
            'useNoise'    =>  false, 
            //设置宽度
            'imageW'      =>  150,

            'imageH'      =>  40,
            //是否添加杂点
            'useNoise'    => true,
            //是否画混淆曲线
            'useCurve'    => true,
        ];
        $captcha = new Captcha($config);
        
        return $captcha->entry();
    }

    /**
     * @description  退出登录
     * @return 验证码
     * @author byrant  2020-03-17
     */
    public function logout(){
        //获取ip地址
        $ip=get_IP();
        $admin_type=session('admin_type');
        switch ($admin_type) {
            case 0:
                $user=new Useradmin;
                break;
            case 1:
                $user=new Userteacher;
                break;
            case 2:
                $user=new Userstudent;
                break;
            default:
                return $this->error('系统错误','login/index');
                break;
        }
         $data=array(
            'loginIP'    => $ip,
            'login_time' => time(),
          );
        //将ip地址写入数据库
        $user->updateLogin($data);

        //清空session
        \session(null);
        
        $this->redirect('login/index');
    }
}