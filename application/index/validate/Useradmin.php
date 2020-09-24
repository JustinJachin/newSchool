<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\validate;
use think\Validate;

/**
 * 管理员验证器
 * @author Byrant <941201742@qq.com>
 */
class Useradmin extends Validate
{
    /**
     * @description 验证规则
     * @author Byrant  2020-03-18
     */
    protected $rule=[
        'username'=>'max:15|require',
        'password'=>'confirm:passwordNew|regex:^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$',
        'email'=>'email|unique:Useradmin|require',
        'phone'=>"require|length:11|unique:Useradmin",
        'num'  =>'require|unique:Useradmin'
    ];
    /**
     * @description 错误信息
     * @author Byrant  2020-03-18
     */
    protected $message=[
        'username.require'=>'名字不能为空',
        'username.max'=>'名字长度最大为15位',
        'num.require'=>'管理员编号不能为空',
        'num.unique'=>'该管理员编号已被使用',
        'sex.require'=>'性别不能为空',
        'password.require'=>'密码不能为空',
        'password.regex'=>'密码必须由数字和字母组成，且要8-20位之间',
        'password.confirm'=>'确认密码与新密码不一致',
        'email.require'=>'邮箱不能为空',
        'email.email'=>'邮箱格式错误',
        'eamil.unique'=>'该邮箱已被使用',
        'phone.unique'=>'该手机号已被使用',
        'phone.max'=>'手机号长度超过了11位',
        'phone.length'=>'手机号长度为11位',
        'phone.require'=>'手机号不能为空',
       
    ];
    /**
     * @description 验证场景
     * @author Byrant  2020-03-18
     */
     protected $scene =  [
        'personal'  =>  [
            'email'=>"unique:Useradmin|email",
            'username'=>'max:15',
            'phone'=>[
                "length:11",
                "max:11",
                "unique:Useradmin",
            ]
        ],
        'personalPassword'=>  ['password'],
        'add'  =>[
            'username',
            'num',
            'email'=>"require|email|unique:Useradmin",
            'phone'=>[
                'require',
                "length:11",
                "max:11",
                "unique:Useradmin",
            ]
        ]
    
    ];
}
