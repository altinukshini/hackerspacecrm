<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPermission;

class Role extends Model
{

	use HasPermission;

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'roles';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * Relation between a Role and the Permission.
     *
     * @return Permissions
     */
    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }
    
}
