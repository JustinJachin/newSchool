<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\index\controller\Base;
/**
 * 进入首页
 */
class Index extends Base
{
    public function index()
    {
        // var_dump(session('admin_type'));exit;
        // $res=new Login;
        // $data=$res->usercheck();
        // var_dump($data);
        // exit;
        // var_dump(session('uid'));exit;
        return $this->fetch('index');
    }
}
