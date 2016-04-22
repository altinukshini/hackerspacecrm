<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

	/**
     * Relation between a profile and the user.
     *
     * @return User
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
