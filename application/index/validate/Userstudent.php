<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\validate;
use think\Validate;

/**
 * 学生验证器
 * @author Byrant <941201742@qq.com>
 */
class Userstudent extends Validate
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
    ];
    /**
     * @description 错误信息
     * @author Byrant  2020-03-18
     */
    protected $message=[
        'username.require'=>'名字必须填写',
        'username.max'=>'名字长度最大为5位',
        'sex.require'=>'性别必须选择',
        'password.require'=>'密码必须填写',
        'password.regex'=>'密码必须由数字和字母组成，且要8-20位之前',
        'password.confirm'=>'密码不一致',
        'email.require'=>'邮箱必须填写',
        'email.email'=>'邮箱格式错误',
        'eamil.unique'=>'邮箱已使用',
        'phone.unique'=>'手机号已使用',
        'phone.max'=>'手机号长度超过了11位',
        'phone.length'=>'手机号长度为11位',
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
    
    ];
}
