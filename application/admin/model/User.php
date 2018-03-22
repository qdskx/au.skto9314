<?php
namespace app\admin\model;
use think\Model;

class User extends Model
{
	public function roles()
	{
		return $this->belongsToMany('Role');
	}
}

