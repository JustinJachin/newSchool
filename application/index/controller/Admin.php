<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Useradmin;
/**
 * 管理员
 */
class Admin extends Base
{
	/**
     * @description 错误信息
     * @author Byrant  2020-03-18
     */
	public function index()
	{	
		$keyword=input('get.keyword');
		$pageParam= ['query'=>[]];
		if($keyword){
			$pageParam['query']['keyword']=$keyword;
			$map=array(
				'status'=>['>=','0'],
				'username|penname|num'=>['like',"%{$keyword}%"]
			);
		}else{
			$map=array(
				'status'=>['>=','0']
			);
		}
		$list=Useradmin::where($map)->order('id asc')->paginate(10,false,$pageParam);
		$page=$list->render();
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->assign('keyword',$keyword);
		return view('index');

	}
    /**
     * @description 个人信息详情页
     * @author Byrant  2020-03-20
     */
	public function detail(){
		if(request()->isGet()){
			$data=input();
			$data['status']=['>=','0'];
			$res=Useradmin::where($data)->field('id,username,penname,sex,num,type,pic,phone,email,create_time,update_time,loginIP,login_time')->find();
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
     * @description 管理员修改密码页面
     * @author Byrant  2020-03-20
     */
	public function edit(){
		$data=input();
        $map=[
            'id'=>$data['id'],
            'status'=>['>=',0]
        ];
        $res=Useradmin::where($map)->field('id')->find();
        if($res){
            $this->assign('id',$data['id']);
            return view('edit');
        }else{
            return view('public/404'); 
        }
		
	}
    /**
     * @description 管理员修改密码页面
     * @author Byrant  2020-03-20
     */
    public function password(){
        $status['status']=0;
        $status['msg']='参数错误';
        if(request()->isPost()){
            $data=input('post.');

            $result=$this->validate($data,'Useradmin.personalPassword');
             if(true !== $result){
                // 验证失败 输出错误信息
                $status['msg']=$result;
                return json($status);
            }
            $map['id']=$data['id'];
            $list['password']=md5('my'.$data['password'].'project'.md5("my_project"));
            $list['create_time']=time();
            $user=new Useradmin;
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
     * @description 添加管理员页面
     * @author Byrant  2020-03-18
     */
	public function add(){
		return view('add');
	}
    /**
     * @description 添加管理员到数据库
     * @author Byrant  2020-03-18
     */
    public function addDB(){
        $status=[
            'status'=>0,
            'msg'=>'参数错误'
        ];
        if(request()->isPost()){
            $data=input('post.');
            //验证数据是否符合实际，比如手机号长度是否是11位，是否为空等
            $result = $this->validate($data,'Useradmin.add');
            if(true !== $result){
                // 验证失败 输出错误信息
                $status['msg']=$result;
                return json($status);
            }
            //验证手机号是否正确
            $phone=checkPhone($data['phone']);
            if($phone!=null){
                return json($phone);
            }
            $data['create_time']=time();
            $data['update_time']=time();
            //添加到数据库
            $admin=new Useradmin;
            $admin->data($data);
            $result=$admin->save();
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
     * @description 启用和禁用
     * @author Byrant  2020-03-19
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
			$admin=new Useradmin;
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
     * @author Byrant  2020-03-19
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
			$admin=new Useradmin;
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
     * @author Byrant  2020-03-19
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
			$admin=new Useradmin;
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