<?php

namespace HackerspaceCRM\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Profile;
use App\Models\Permission;
use App\Traits\HasRole;

class User extends Authenticatable
{

    use HasRole;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Generate email_token for user.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->email_token = str_random(30);
        });
    }

    /**
     * Verify user in db, since the user has verified
     * the email.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->email_token = null;
        
        $this->save();
    }

    /**
     * Set last login datetime
     *
     * @return void
     */
    public function setLastLogin()
    {
        $this->last_login = date('Y-m-d H:i:s');
        $this->save();
        
        $this->save();
    }

    /**
     * Set default locale
     *
     * @return void
     */
    public function setDefaultLocale($locale)
    {
        $this->locale = $locale;
        
        $this->save();
    }

    /**
     * Relation between a User and Role.
     *
     * @return Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relation between a user and the profile.
     *
     * @return Profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get users profile page path.
     *
     * @return string
     */
    public function profilePath()
    {
        return $this->hasProfile() ? '/members/' . $this->username : '/';
    }

    /**
     * Check if user has profile.
     *
     * @return boolean
     */
    public function hasProfile()
    {
        return $this->profile ? true : false;
    }
}
