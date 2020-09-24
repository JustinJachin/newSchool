<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Academey as AcademeyModel;
use think\Db;
/**
 * 学院管理
 */
class Academey extends Base
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
                'academey_name'=>['like',"%{$keyword}%"]
            );
        }else{
            //查询条件
            $map=array(
                'status'=>['=','1']
            );
        }
        $list=AcademeyModel::where($map)->order('id  asc')->paginate(10,false,$pageParam);
        $page=$list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('keyword',$keyword);
        return view('index');
    }
    /**
     * @description  学院修改页面
     * @author Byrant  2020-03-24
     */
    public function edit(){
        $map=input('param.');
        $id['id']=$map['id'];
        $list=AcademeyModel::where($id)->find();
        if($map['id']==null||$list==null){
            return view('public/404');
        }
        $this->assign('list',$list);
        return view('edit');
    }
    /**
     * @description  学院修改到数据库
     * @author Byrant  2020-03-24
     */
    public function editDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            $validate = new \app\index\validate\Academey();
            $result = $validate->scene('edit')->check($data);
            //验证数据是否符合实际
            if(true !== $result){
                // 验证失败 输出错误信息
                $status['msg']    = $result;
                return json($status);
            }
            if($data['id']===null){
                return json($status);
            }else{
                $id['id']=$data['id'];
                unset($data['id']);
            }
            $list=AcademeyModel::where($id)->field('academey_name,address')->find();
            $flag=0;
            if($list['academey_name']===$data['academey_name']){
                unset($data['academey_name']);
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
            $academey=new AcademeyModel;
            $result=$academey->save($data,$id);
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
     * @description 添加学院页面
     * @author Byrant  2020-03-24
     */
    public function addDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            $validate = new \app\index\validate\Academey();
            $result = $validate->scene('add')->check($data);
            //验证数据是否符合实际
            // $result = $this->validate($data,'AcademeyValidate.add');
            if(true !== $result){
                // 验证失败 输出错误信息
                $status['msg']    = $result;
                return json($status);
            }
            
            $data['create_time']=time();
            $data['update_time']=time();
            //添加到数据库
            $academey=new AcademeyModel;
            $academey->data($data);
            $result=$academey->save();
            // 验证是否添加成功
            if($result){
                $status=[
                    'status'=>1,
                    'msg'=>'添加成功'
                ];
            }else{
                $status['msg']    = "添加失败！";
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
            $maps=[
                'delete_time'=>time(),
                'status'=>'-1'
            ];
            $academy=['academey_id'=>$data];
            Db::startTrans();
            $result=false;
            try{
                Db::table('my_academey')->where($id)->update($map);
                Db::table('my_profession')->where($academy)->update($map);
                Db::table('my_major')->where('profession_id','in',function($query)use($academy){
                    $query->table('my_profession')->where($academy)->field('id');
                })->update($map);
                Db::table('my_userstudent')->where('classId','in',function($query)use($academy){
                    $query->table('my_major')->where('profession_id','in',function($query)use($academy){
                        $query->table('my_profession')->where($academy)->field('id');
                    })->field('id');
                })->update($maps);
                Db::commit(); //提交事务

                $status=[
                    'status'=>1,
                    'msg'=>'删除成功'
                ];

            }catch(\Exception $e) {
                // 回滚事务
                Db::rollback();
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
            $academey=new AcademeyModel;
            $result=$academey->saveAll($map);
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