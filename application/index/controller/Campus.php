<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Campus as CampusModel;
/**
 * 学院管理
 */
class Campus extends Base
{
    /**
     * @description  学院管理列表
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
                'status'=>['=','1'],
                'campusname'=>['like',"%{$keyword}%"]
            );
        }else{
            //查询条件
            $map=array(
                'status'=>['=','1']
            );
        }
        $list=CampusModel::where($map)->order('id  asc')->paginate(10,false,$pageParam);
        $page=$list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('keyword',$keyword);
        return view('index');
    }
    /**
     * @description  学院编辑
     * @author Byrant  2020-03-24
     */
    public function edit(){
        $map=input('param.');
        $id['id']=$map['id'];
        $list=CampusModel::where($id)->find();
        if($map['id']==null||$list==null){
            return view('public/404');
        }
        $this->assign('list',$list);
        return view('edit');

    }
    /**
     * @description  学院编辑提交数据库
     * @author Byrant  2020-03-24
     */
    public function editDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            if($data['id']===null){
                return json($status);
            }else{
                $id['id']=$data['id'];
                unset($data['id']);
            }
            $list=CampusModel::where($id)->field('campusname,address')->find();
            $flag=0;
            if($list['campusname']===$data['campusname']){
                unset($data['campusname']);
                $flag++;
            }
            if($list['address']===$data['address']){
                unset($data['address']);
                $flag++;
            }
            if($flag>1){
                $status['msg']    = '请修改数据在提交';
                return json($status);
            }
            $data['update_time']=time();
            $campus=new CampusModel;
            $result=$campus->save($data,$id);
            if($result){
                $status['status'] = 1;
                $status['msg']    = '修改成功';
            }else{
                $status['msg']    = '修改失败';
            }
        }
        return json($status);
    }
    /**
     * @description 添加学院页面
     * @author Byrant  2020-03-24
     */
    public function add(){
        return view('add');
    }
    /**
     * @description 添加学院到数据库
     * @author Byrant  2020-03-24
     */
    public function addDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            if($data['campusname']===null){
                $status=[
                    'status'=>0,
                    'msg'=>"校区名不能为空"
                ];
                return json($status);
            }
            if($data['address']===null){
                $status=[
                    'status'=>0,
                    'msg'=>"校区地址不能为空"
                ];
                return json($status);
            }
            $data['create_time']=time();
            $data['update_time']=time();
            // var_dump($data);exit;
            //添加到数据库
            $campus=new CampusModel;
            $campus->data($data);
            $result=$campus->save();
            // 验证是否添加成功
            if($result){
                $status=[
                    'status'=>1,
                    'msg'=>'添加成功'
                ];
            }else{
                $status['msg']="添加失败！";
            } 
        }
        //返回json格式数据
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
                'status'=>'0'
            ];
            $campus=new CampusModel;
            $result=$campus->save($map,$id);
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
                $map[]=['id'=>$value,'status'=>'0','delete_time'=>time()];
            }
            // var_dump($map);exit;
            $campus=new CampusModel;
            $result=$campus->saveAll($map);
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