<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\model;
use think\Model;

/**
 * 专业模型
 */
class Class extends Model
{
    public function prossion(){
        return $this->belongsTo('prossion');
    }

    
   
}