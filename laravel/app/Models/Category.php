<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use ModelTree, AdminBuilder;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setOrderColumn('sort');

    }

    public function article()
    {
    	return $this->hasMany(Article::class, 'category_id', 'id');	
    }
}
