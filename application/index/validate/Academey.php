<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\validate;
use think\Validate;
/**
 * 学院验证
 */
class Academey extends Validate
{
    /**
     * @description 验证规则
     * @author Byrant  2020-03-24
     */
    protected $rule=[
        'academey_name'=>'require|unique:academey',
        'address'=>'require',
        'num'=>'require|unique:academey|number',
        // 'phonenumber'=>'require|unique:academey|length:13'
    ];
    /**
     * @description 错误信息
     * @author Byrant  2020-03-24
     */
    protected $message=[
        'academey_name.require'=>'学院名不能为空!',
        'academey_name.unique'=>'该学院名已经被使用',
        'address.require'=>'地址不能为空',
        'num.require'=>'编号不能为空',
        'num.unique'=>'该编号已经被使用',
        'num.number'=>'编号只能为数字',
        // 'phonenumber.require'=>'电话不能为空',
        // 'phonenumber.unique'=>'该号码已被使用',
        // 'phonenumber.length'=>'电话只能为13位',
    ];
    /**
     * @description 验证场景
     * @author Byrant  2020-03-24
     */
    protected $scene=[
        'add'=>['academey_name','address','num'],
        'edit'=>['academey_name','address'],
    ];
}