<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\model;
use think\Model;

/**
 * 专业模型
 */
class Profession extends Model
{
    public function academey(){
        return $this->belongsTo('academey');
    }

    public function major(){
        return $this->hasMany('major','');
    }
   
}