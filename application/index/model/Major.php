<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\model;
use think\Model;

/**
 * 专业模型
 */
class Major extends Model
{
    public function profession(){
        return $this->belongsTo('profession');
    }
    
    
   
}