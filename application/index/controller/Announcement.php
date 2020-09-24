<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Announcement as AnnouncementModel;
use app\index\model\Useradmin;
/**
 * 公告管理
 */
class Announcement extends Base
{
    /**
     * @description  公告管理列表
     * @author Byrant  2020-03-27
     */
    public function index(){
        $keyword=input('get.keyword');
        $pageParam=['query'=>[]];
        if($keyword){
            $pageParam['query']['keyword']=$keyword;
            $mapAdmin=['username'=>['like','%{$keyword}%']];
            $res=Useradmin::where($mapAdmin)->column('id');
            //查询条件
            $map=array(
                'adminId'=>['in',implode(',',$res)],
                'title'=>['like',"%{$keyword}%"],
            );
            $status=['status'=>['=','1']];
            $list=AnnouncementModel::whereOr($map)->where($status)->with('useradmin')->order('id  asc')->paginate(10,false,$pageParam);
        }else{
            //查询条件
            $status=['status'=>['=','1']];
            $list=AnnouncementModel::where($status)->with('useradmin')->order('id  asc')->paginate(10,false,$pageParam);
        }
        $page=$list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('keyword',$keyword);
        return view('index');
    }
    /**
     * @description 公告修改页面
     * @author Byrant  2020-03-27
     */
    public function edit(){
        $map=input('param.');
        $id['id']=$map['id'];
        
        $mapAcademey['status']=1;
        $list=ProfessionModel::where($id)->find();
        if($map['id']==null||$list==null){
            return view('public/404');
        }
        $academey=Academey::where($mapAcademey)->field('id,academey_name')->select();
        $this->assign('list',$list);
        $this->assign('academey',$academey);
        return view('edit');
    }
     /**
     * @description 公告修改提交数据库
     * @author Byrant  2020-03-27
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
            $list=ProfessionModel::where($id)->field('profession_name,academey_id')->find();
            $flag=0;
            if($list['profession_name']===$data['profession_name']){
                unset($data['profession_name']);
                $flag++;
            }
            if($list['academey_id']===$data['academey_id']){
                unset($data['academey_id']);
                $flag++;
            }
            if($flag>1){
                $status['msg']    = '请修改数据在提交';
                return json($status);
            }
            $data['update_time']=time();
            $profession=new ProfessionModel;
            $result=$profession->save($data,$id);
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
     * @description 添加公告页面
     * @author Byrant  2020-03-27
     */
    public function add(){
        $map['status']=1;
        $res=Academey::where($map)->field('id,academey_name')->select();
        $this->assign('list',$res);
        return view('add');
    }
    /**
     * @description 添加公告提交数据库
     * @author Byrant  2020-03-27
     */
    public function addDB(){
        $status['status'] = 0;
        $status['msg']    = '参数错误';
        if(request()->isPost()){
            $data=input('post.');
            if($data['profession_name']===null){
                $status['msg']="公告名不能为空";
                return json($status);
            }
            if($data['academey_id']===null){
                $status['msg']="所属学院必须选择";
                return json($status);
            }
            $data['create_time']=time();
            $data['update_time']=time();
            //添加到数据库
            $profession=new ProfessionModel;
            $profession->data($data);
            $result=$profession->save();
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
     * @author Byrant  2020-03-27
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
            $profession=['profession_id'=>$data];
            Db::startTrans();
            // echo 11;exit;
            $result=false;
            try{
                Db::table('my_profession')->where($id)->update($map);
                Db::table('my_major')->where($profession)->update($map);
                Db::table('my_userstudent')->where('classId','in',function($query)use($profession){
                    $query->table('my_major')->where($profession)->field('id');
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
            exit;
        }
        return json($status);
    }
    /**
     * @description 批量删除,这里是软删除，就是将状态更改了，数据还是存在的
     * @author Byrant  2020-03-27
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
            $maps=['profession_id'=>['in',implode(',',$data['check_val'])]];
            $mapstudent=[
                'delete_time'=>time(),
                'status'=>'-1'
            ];
            Db::startTrans();
            $result=false;
            try{
                Db::table('my_profession')->where($id)->update($map);
                Db::table('my_major')->where($maps)->update($map);
                Db::table('my_userstudent')->where('classId','in',function($query)use($maps){
                    $query->table('my_major')->where($maps)->field('id');
                })->update($mapstudent);
                // Db::table('my_userstudent')->where($maps)->update($mapstudent);
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
