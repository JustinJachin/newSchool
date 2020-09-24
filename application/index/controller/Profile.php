<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\index\controller\Base;
use think\Session;
use app\index\model\Useradmin;
use app\index\model\Userteacher;
use app\index\model\Userstudent;
use think\Request;
use think\Loader;
/**
 * 个人信息页面
 */
class Profile extends Base
{
    /**
     * @description  修改个人资料首页
     * @author Byrant  2020-03-17
     */
    public function index(){

        $uid=session('uid');
        $type=session('admin_type');
        switch ($type) {
            case 0:
                $user = new  Useradmin();
                break;
            case 1:
                $user = new  Userteacher();
                break;
            case 2:
                $user = new  Userstudent();
                break;
            default:
                # code...
                break;
        }

        $data=$user->where('id',$uid)->order('id  asc')->field('id,username,email,phone,ischange,penname,num,sex')->find();

        $this->assign('list',$data);
        return $this->fetch('index');

    }

    /**
     * @description  修改个人资料修改页面
     * @return json 返回json格式，0修改失败，1修改成功
     * @author Byrant  2020-03-17
     */
    public function personal(){
        $status=[
            'status'=>0,
            'msg'=>'参数错误'
        ];
        if(request()->isPost()){
            $getdata=input('post.');
            $uid=session('uid');
            $type=session('admin_type');
            switch ($type) {
                case '0':
                    $user = new  Useradmin();
                    $validateModel='Useradmin.personal';
                    break;
                case '1':
                    $user = new  Userteacher();
                    $validateModel='Userteacher.personal';
                    break;
                default:
                    $user = new  Userstudent();
                    $validateModel='Userstudent.personal';
                    break;
            }
            $data=$user->where('id',$uid)->field('username,email,phone,sex')->find();
            if($getdata['username']===$data['username']||$getdata['username']==null){
                unset($getdata['username']);
            }
            if($getdata['email']===$data['email']||$getdata['email']==null){
                unset($getdata['email']);
            }
            if($getdata['phone']===$data['phone']||$getdata['phone']==null){
                unset($getdata['phone']);
            }
            if($getdata['sex']===$data['sex']||$getdata['sex']==null){
                unset($getdata['sex']);
            }
            $getdata['update_time']=time();
            //验证器验证数据是否合理
            
            $result = $this->validate($getdata,$validateModel);
            if(true !== $result){
                // 验证失败 输出错误信息
                $status['msg']=$result;
                return json($status);
            }
            //验证手机号格式是否正确
            if(array_key_exists('phone',$getdata)){
                $phone=checkPhone($getdata['phone']);
                if($phone!=null){
                    return json($phone);
                }
            }
            //更新数据库，$res返回数据
            $res=$user->save($getdata,['id'=>$uid]);
            //验证是否修改成功
            if($res){
                $status=[
                    'status'=>1,
                    'msg'=>'修改成功！'
                ];
            }else{
                $status['msg']="修改失败！";
            }
        } 
        return json($status);
    }

    /**
     * @description  修改密码页面
     * @author Byrant  2020-03-17
     */
    public function indexPassword(){
        return view('password');
    }
    /**
     * @description  修改密码 
     * @return json 返回json格式，0修改失败，1修改成功
     * @author Byrant  2020-03-17
     */
    public function editPassword(){
        $status=[
            'status'=>0,
            'msg'=>'参数错误'
        ];
        if(request()->isPost()){
            $getdata=input('post.');
            $uid=session('uid');
            $type=session('admin_type');
            switch ($type) {
                case 0:
                    $user = new  Useradmin();
                    $validateModel='Useradmin.personalPassword';
                    break;
                case 1:
                    $user = new  Userteacher();
                    $validateModel='Userteacher.personalPassword';
                    break;
                default:
                    $user = new  Userstudent();
                    $validateModel='Userstudent.personalPassword';
                    break;
            }
            if($getdata['passwordOld']===$getdata['password']){
                $status['msg']="新旧密码不允许一致！";
                return json($status);
            }
            $data=$user->where('id',$uid)->field('password')->find();
            if(md5('my'.$getdata['passwordOld'].'project'.md5("my_project"))!=$data['password']){
                $status['msg']="旧密码错误";
                return json($status);
            }else{
                unset($getdata['passwordOld']);
            }
            $result = $this->validate($getdata,$validateModel);

            if(true !== $result){
                // 验证失败 输出错误信息]
                $status['msg']=$result;
                return json($status);
            }else{
                unset($getdata['passwordNew']);
                $getdata=array(
                    'update_time'=>time(),
                    'password'=>md5('my'.$getdata['password'].'project'.md5("my_project"))
                );
            }
            //更新数据库，$res返回数据
            $res=$user->save($getdata,['id'=>$uid]);
            if($res){
                $status=[
                    'status'=>1,
                    'msg'=>'修改成功！'
                ];
            }else{
                $status['msg']="修改失败！";
            } 
        }
        return json($status);
    }
}