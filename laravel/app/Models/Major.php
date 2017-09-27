<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use ModelTree, AdminBuilder;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setOrderColumn('sort');
        $this->setTitleColumn('major_name');

    }
    public $timestamps = false;
    public function scopeAcademy()
    {
        return $this->where('parent_id',0);
    }
    public function scopeMajor($id)
    {
        return $this->where('parent_id',$id);
    }


}
