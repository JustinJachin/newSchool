<?php
// +----------------------------------------------------------------------
// | Author: Byrant <941201742@qq.com> 
// +----------------------------------------------------------------------

namespace app\index\model;
use think\Model;

/**
 * 学院模型
 */
class Announcement extends Model
{
    public function useradmin(){
        return $this->belongsTo('useradmin','adminId');
    }
   
}