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

    protected $fillable = [
        'birthday',
        'gender',
        'socialid',
        'phone',
        'address',
        'website',
        'github_username',
        'facebook_username',
        'twitter_username',
        'linkedin_username',
        'skills',
        'biography'
    ];

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
