<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Profession;
use app\index\model\Major as MajorModel;
use think\Db;

/**
 * 班级班级管理
 */
class Major extends Base
{
    /**
     * @description  班级管理
     * @author Byrant  2020-03-26
     */
    public function index(){
        $keyword=input('get.keyword');
        $pageParam=['query'=>[]];
        if($keyword){
        	$pageParam['query']['keyword']=$keyword;
        	$mapP=['profession_name'=>['like',"%{$keyword}%"]];
        	$res=Profession::where($mapP)->column('id');
        	$map=array(
        		'profession_id'=>['in',implode(',',$res)],
        		'major_name|year'=>['like',"%%{$keyword}%%"]
        	);
        	$status=['status'=>1];
        	$list=MajorModel::whereOr($map)->where($status)->with('profession')->order('id asc')->paginate(10,false,$pageParam);
        }else{
        	$status=['status'=>1];
        	$list=MajorModel::where($status)->with('profession')->order('id asc')->paginate(10,false,$pageParam);
        }
        
        $page=$list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('keyword',$keyword);
        return view('index');
    }
     /**
     * @description 班级修改页面
     * @author Byrant  2020-03-26
     */
    public function edit(){
        $map=input('param.');
        $id['id']=$map['id'];
        
        $mapprofession['status']=1;
        $list=MajorModel::where($id)->find();
        if($map['id']==null||$list==null){
            return view('public/404');
        }
        $profession=Profession::where($mapprofession)->field('id,profession_name')->select();
        $this->assign('list',$list);
        $this->assign('profession',$profession);
        return view('edit');
    }
     /**
     * @description 班级修改提交数据库
     * @author Byrant  2020-03-26
     */
    public function editDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            // var_dump($data);exit;
            if($data['id']===null){
                return json($status);
            }else{
                $id['id']=$data['id'];
                unset($data['id']);
            }
            $list=MajorModel::where($id)->field('major_name,year,profession_id')->find();
            $flag=0;
            if($list['major_name']===$data['major_name']){
                unset($data['major_name']);
                $flag++;
            }
            if($list['profession_id']===$data['profession_id']){
                unset($data['profession_id']);
                $flag++;
            }
            if($list['year']===$data['year']){
                unset($data['year']);
                $flag++;
            }
            if($flag>2){
                $status['msg']    = '请修改数据在提交';
                return json($status);
            }
            $data['update_time']=time();
            $major=new MajorModel;
            $result=$major->save($data,$id);
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
     * @description 添加班级页面
     * @author Byrant  2020-03-26
     */
    public function add(){
        $map['status']=1;
        $res=Profession::where($map)->field('id,profession_name')->select();
        $this->assign('list',$res);
        return view('add');
    }
    /**
     * @description 添加班级提交数据库
     * @author Byrant  2020-03-26
     */
    public function addDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            if($data['major_name']===null){
                $status['msg']="班级名不能为空";
                return json($status);
            }
            if($data['profession_id']===null){
                $status['msg']="所属学院必须选择";
                return json($status);
            }
            if($data['year']===null){
                $status['msg']="年级不能为空";
                return json($status);
            }
            $data['create_time']=time();
            $data['update_time']=time();
            //添加到数据库
            $major=new MajorModel;
            $major->data($data);
            $result=$major->save();
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
     * @author Byrant  2020-03-26
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
            $profession=['classId'=>$data];
            Db::startTrans();
            $result=false;
            try{
                Db::table('my_major')->where($id)->update($map);
                Db::table('my_userstudent')->where($profession)->update($maps);
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
     * @author Byrant  2020-03-26
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
            $id=['id'=>['in',implode(',',$data['check_val'])]];
            $map=['status'=>'0','delete_time'=>time()];
            $maps=['classId'=>['in',implode(',',$data['check_val'])]];
            $mapstudent=[
                'delete_time'=>time(),
                'status'=>'-1'
            ];
            //开启事务
            Db::startTrans();
            $result=false;
            try{
                Db::table('my_major')->where($id)->update($map);
                Db::table('my_userstudent')->where($maps)->update($mapstudent);
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
}