<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;

class EmailTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'email_subject',
        'email_body',
        'syntax_help',
        'locale',
    ];

    /**
     * Compile the blade template and replace the template variables with their
     * values that are given in the $data array parameter
     *
     * @param array
     *
     * @return string;
     **/
    public function bladeCompile(array $data = array())
    {
        $generated = Blade::compileString($this->email_body);

        ob_start();

        extract($data,  EXTR_SKIP);

        try {
            eval('?>'.$generated);
        } catch (Exception $e) {
            // We just don't want to throw an exception. If a variable is missing or something, then just don't show it
            // ob_get_clean(); throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}
