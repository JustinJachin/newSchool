<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Userstudent;
/**
 * 教师
 */
class Student extends Base
{
    /**
     * @description  学生列表首页
     * @author Byrant  2020-03-24
     */
    public function index(){
        //获取搜索关键字
        $keyword=input('get.keyword');
        $pageParam= ['query'=>[]];
        if($keyword){
            $pageParam['query']['keyword']=$keyword;
            //查询条件
            $map=array(
                'status'=>['>=','0'],
                'username|penname|num'=>['like',"%{$keyword}%"]
            );
        }else{
            //查询条件
            $map=array(
                'status'=>['>=','0']
            );
        }
        $list=Userstudent::where($map)->order('id  asc')->paginate(10,false,$pageParam);
        $page=$list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('keyword',$keyword);
        return view('index');
    }
    /**
     * @description 个人信息详情页
     * @author Byrant  2020-03-24
     */
    public function detail(){
        if(request()->isGet()){
            $data=input();
            $data['status']=['=','1'];
            $res=Userstudent::where($data)->field('id,username,penname,sex,num,pic,phone,email,create_time,update_time,loginIP,login_time')->find();
            if($res){
                $this->assign('volist',$res);
                return view('details');
            }else{
                return view('public/404');
            }
        }else{
            return view('public/404');
        }
    }
    /**
     * @description 学生修改密码页面
     * @author Byrant  2020-03-24
     */
    public function edit(){
        $data=input();
        $map=[
            'id'=>$data['id'],
            'status'=>['>=',0]
        ];
        $res=Userstudent::where($map)->field('id')->find();
        if($res){
            $this->assign('id',$data['id']);
            return view('edit');
        }else{
            return view('public/404'); 
        }
    }
    /**
     * @description 学生修改密码页面
     * @author Byrant  2020-03-24
     */
    public function password(){
        $status['status']=0;
        $status['msg']='参数错误';
        if(request()->isPost()){
            $data=input('post.');
            $status['status']=0;
            $result=$this->validate($data,'Userstudent.personalPassword');
             if(true !== $result){
                // 验证失败 输出错误信息
                $status['msg']=$result;
                return json($status);
            }

            $map['id']=$data['id'];
            $list['password']=md5('my'.$data['password'].'project'.md5("my_project"));
            $list['create_time']=time();
            $user=new Userstudent;
            $res=$user->save($list,$map);
            if($res){
                $status=[
                    'status'=>1,
                    'msg'=>'修改成功！'
                ];
            }else{
                $status['msg']='修改失败';
            }
            
        }
        return json($status);
    }
    
    /**
     * @description 启用和禁用
     * @author Byrant  2020-03-24
     */
    public function store(){
        $status=[
            'status'=>0,
            'msg'=>'参数错误'
        ];
        if(request()->isGet()){
            $data=input('get.');
            
            if($data['id']===null){
                return json($status);
            }
            $id=['id'=>$data['id']];
            if($data['method']==='stop'){
                $map=['status'=>0,'update_time'=>time()];
            }elseif($data['method']==='start'){
                $map=['status'=>1,'update_time'=>time()];
            }else{
                return json($status);
            }
            $admin=new Userstudent;
            $result=$admin->save($map,$id);
            if($result){
                if($data['method']==='stop'){
                    $status=[
                        'status'=>1,
                        'msg'=>'禁用成功！'
                    ];
                }else{
                    $status=[
                        'status'=>1,
                        'msg'=>'启用成功！'
                    ];
                }
                
            }else{
                if($data['method']==='stop'){
                    $status=[
                        'status'=>0,
                        'msg'=>'禁用失败！'
                    ];
                }else{
                    $status=[
                        'status'=>0,
                        'msg'=>'启用失败！'
                    ];
                }
            }
            
        }
        return json($status);
    }
    /**
     * @description 删除,这里是软删除，就是将状态更改了，数据还是存在的
     * @author Byrant  2020-03-24
     */
    public function delete(){
        $status=[
            'status'=>0,
            'msg'=>'参数错误'
        ];
        if(request()->isGet()){
            $data=input('get.id');
            $id=['id'=>$data];
            if($data===''){
                return json($status);
            }
            $map=[
                'delete_time'=>time(),
                'status'=>'-1'
            ];
            $admin=new Userstudent;
            $result=$admin->save($map,$id);
            if($result){
                $status=[
                    'status'=>1,
                    'msg'=>'删除成功'
                ];
            }else{
                $status['msg']="删除失败！";
            }
            
        }
        return json($status);
    }
    /**
     * @description 批量删除,这里是软删除，就是将状态更改了，数据还是存在的
     * @author Byrant  2020-03-24
     */
    public function deletes(){
        $status=[
                'status'=>0,
                'msg'=>'参数错误'
            ];
        if(request()->isPost()){
            $data=input('post.');
            if(!$data){
                $status['msg']='请选择后再提交';
                return json($status);
            }
            foreach ($data['check_val'] as $key => $value) {
                $map[]=['id'=>$value,'status'=>'-1','delete_time'=>time()];
            }
            // var_dump($map);exit;
            $admin=new Userstudent;
            $result=$admin->saveAll($map);
            if($result){
                $status['status'] = 1;
                $status['msg']    = '删除成功';
            }else{
                $status['msg']    = '删除失败';
            }
        }
        return json($status);
    }
}