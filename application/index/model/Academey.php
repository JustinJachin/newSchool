<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\model;
use think\Model;

/**
 * 学院模型
 */
class Academey extends Model
{
    public function prossion(){
        return $this->hasMany('prossion','academey_id');
    }
   
}