<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;

class TranslationHasBeenSet
{
    /** @var Model */
    public $model;

    /** @var string */
    public $key;

    /** @var string */
    public $locale;

    public $oldValue;
    public $newValue;

    public function __construct(Model $model, $key, $locale, $oldValue, $newValue)
    {
        $this->model = $model;

        $this->attributeName = $key;

        $this->locale = $locale;

        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }
}
