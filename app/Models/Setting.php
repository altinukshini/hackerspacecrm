<?php

namespace App\Models;

use App\Traits\Rememberable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	use Rememberable;

    protected $table = 'settings';

    protected $fillable = ['key', 'value'];
}
