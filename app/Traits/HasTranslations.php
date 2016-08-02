<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Events\TranslationHasBeenSet;
use App\Exceptions\AttributeIsNotTranslatable;

trait HasTranslations
{


    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ( ! $this->isTranslatableAttribute($key) ) {
            return parent::setAttribute($key, $value);
        }

        if ( is_string($value) && ! json_decode($value) ) {
            if (getCurrentSessionAppLocale() == crminfo('locale')) {
                return $this->setTranslation($key, getCurrentSessionAppLocale(), $value);
            }

            foreach (getAvailableAppLocaleArrayKeys() as $locale){
                $this->setTranslation($key, $locale, $value);
            }

            return $this;
        }

        if ( is_string($value) && json_decode($value) ) {
            return $this->setTranslations($key, json_decode($value, true));
        }

        return $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        if ( ! $this->isTranslatableAttribute($key) ) {
            return parent::getAttributeValue($key);
        }

        return $this->getTranslation($key, getCurrentSessionAppLocale());
    }

    /**
     * @param $key
     * @param $locale
     *
     * @return mixed
     */
    public function translate($key, $locale = '')
    {
        return $this->getTranslation($key, $locale);
    }

    /**
     * @param $key
     * @param $locale
     *
     * @return mixed
     */
    public function getTranslation($key, $locale)
    {
        $locale = $this->normalizeLocale($key, $locale);

        $translations = $this->getTranslations($key);

        $translation = isset($translations[$locale]) ? $translations[$locale] : '';

        if ( $this->hasGetMutator($key) ) {
            return $this->mutateAttribute($key, $translation);
        }

        return $translation;
    }

    public function getTranslations($key)
    {
        $this->guardAgainstUntranslatableAttribute($key);

        return json_decode((isset($this->getAttributes()[$key]) ? $this->getAttributes()[$key] : '') ?: '{}', true);
    }

    /**
     * @param $key
     * @param $locale
     * @param $value
     *
     * @return $this
     */
    public function setTranslation($key, $locale, $value)
    {
        $this->guardAgainstUntranslatableAttribute($key);

        $translations = $this->getTranslations($key);

        $oldValue = isset($translations[$locale]) ? $translations[$locale] : '';

        if ( $this->hasSetMutator($key) ) {
            $method = 'set' . Str::studly($key) . 'Attribute';
            $value = $this->{$method}($value);
        }

        $translations[$locale] = $value;

        $this->attributes[$key] = $this->asJson($translations);

        event(new TranslationHasBeenSet($this, $key, $locale, $oldValue, $value));

        return $this;
    }

    /**
     * @param $key
     * @param array $translations
     *
     * @return $this
     */
    public function setTranslations($key, array $translations)
    {
        $this->guardAgainstUntranslatableAttribute($key);

        foreach ($translations as $locale => $translation) {
            $this->setTranslation($key, $locale, $translation);
        }

        return $this;
    }

    /**
     * @param $key
     * @param $locale
     *
     * @return $this
     */
    public function forgetTranslation($key, $locale)
    {
        $translations = $this->getTranslations($key);

        unset($translations[$locale]);

        $this->setAttribute($key, $translations);

        return $this;
    }

    public function getTranslatedLocales($key)
    {
        return array_keys($this->getTranslations($key));
    }

    protected function isTranslatableAttribute($key)
    {
        return in_array($key, $this->getTranslatableAttributes());
    }

    protected function guardAgainstUntranslatableAttribute($key)
    {
        if ( ! $this->isTranslatableAttribute($key) ) {
            throw AttributeIsNotTranslatable::make($key, $this);
        }
    }

    protected function normalizeLocale($key, $locale)
    {
        if ( in_array($locale, $this->getTranslatedLocales($key)) ) {
            return $locale;
        }

        return crminfo('locale');
    }

    public function getTranslatableAttributes()
    {
        return is_array($this->translatable) ? $this->translatable : [];
    }

    public function getCasts()
    {
        return array_merge(parent::getCasts(), array_fill_keys($this->getTranslatableAttributes(), 'array'));
    }
}
