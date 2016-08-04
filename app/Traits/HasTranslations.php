<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Events\TranslationHasBeenSet;
use App\Exceptions\AttributeIsNotTranslatable;

trait HasTranslations
{

    /**
     * Overwritten method.
     * Automatically assign a locale to the created attribute
     * based on the session locale or default locale
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        // If not translatable, create it the default way
        // via the parent method
        if ( ! $this->isTranslatableAttribute($key) ) {
            return parent::setAttribute($key, $value);
        }

        if ( is_string($value) && ! json_decode($value) ) {

            // If model is being created while in a session that does
            // not have the default locale active, then create the attribute
            // in default locale as well. Prevents empty attribute for default locale.
            if ( getCurrentSessionAppLocale() != crminfo('locale') ) {
                $this->setTranslation($key, crminfo('locale'), $value);
            }

            return $this->setTranslation($key, getCurrentSessionAppLocale(), $value);
        }

        if ( is_string($value) && json_decode($value) ) {
            return $this->setTranslations($key, json_decode($value, true));
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Overwritten method
     * Get a plain translatable attribute (if translatable)
     *
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
     * Alias method of getTranlsation()
     *
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
     * Get single (requested) translation of an attribute
     *
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

    /**
     * Get all available translations of the attribute
     *
     * @param $key
     *
     * @return array
     */
    public function getTranslations($key)
    {
        $this->guardAgainstUntranslatableAttribute($key);

        $translations = isset($this->getAttributes()[$key]) ? $this->getAttributes()[$key] : '';

        // If attribute value is not a json string, force default locale and return array
        if ( ! json_decode($translations) || empty($translations)) {
            return [getDefaultAppLocale() => $translations];
        }

        return json_decode($translations, true);

    }

    /**
     * Set a translation for a single attribute
     *
     * @param $key
     * @param $locale
     * @param $value
     *
     * @return $this
     */
    public function setTranslation($key, $locale, $value)
    {
        $this->guardAgainstUntranslatableAttribute($key);

        // If given locale is not in crm available locales, don't do
        // anything, just return the same object
        if (!in_array($locale, getAvailableAppLocaleArrayKeys())) {
            return $this;
        }

        $translations = $this->getTranslations($key);

        $oldValue = isset($translations[$locale]) ? $translations[$locale] : '';

        if ( $this->hasSetMutator($key) ) {
            $method = 'set' . Str::studly($key) . 'Attribute';
            $value = $this->{$method}($value);
        }

        $translations[$locale] = $value;

        if (empty($translations[crminfo('locale')])) {
            $translations[crminfo('locale')] = $value;
        }

        $this->attributes[$key] = $this->asJson($translations);

        event(new TranslationHasBeenSet($this, $key, $locale, $oldValue, $value));

        return $this;
    }

    /**
     * Set multiple translations for a single attribute
     *
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
     * Remove a translation for a single attribute
     *
     * @param $key
     * @param $locale
     *
     * @return $this
     */
    public function forgetTranslation($key, $locale)
    {
        $translations = $this->getTranslations($key);

        unset($translations[$locale]);

        $this->setAttribute($key, empty($translations) ? '' : $translations);

        return $this;
    }

    /**
     * Get all locales in which the attribute is translated
     *
     * @param $key
     *
     * @return array
     */
    public function getTranslatedLocales($key)
    {
        return array_keys($this->getTranslations($key));
    }

    /**
     * Check if attribute is translatable
     *
     * @param $key
     *
     * @return boolean
     */
    protected function isTranslatableAttribute($key)
    {
        return in_array($key, $this->getTranslatableAttributes());
    }

    /**
     * Throw exception if attribute is not translatable
     *
     * @param $key
     *
     * @throws AttributeIsNotTranslatable
     * @return void
     */
    protected function guardAgainstUntranslatableAttribute($key)
    {
        if ( ! $this->isTranslatableAttribute($key) ) {
            throw AttributeIsNotTranslatable::make($key, $this);
        }
    }

    /**
     * Normalize locale
     *
     * @param $key
     * @param $locale
     *
     * @return string
     */
    protected function normalizeLocale($key, $locale)
    {
        if ( in_array($locale, $this->getTranslatedLocales($key)) ) {
            return $locale;
        }

        return crminfo('locale');
    }

    /**
     * Get all translatable attributes from class property
     *
     * @return array
     */
    public function getTranslatableAttributes()
    {
        return is_array($this->translatable) ? $this->translatable : [];
    }

    /**
     * Overwritten method
     * If attribute value is not json_decodeable (not an array)
     * by accident, force return it as array
     * Decode the given JSON back into an array or object.
     *
     * @param  string $value
     * @param  bool $asObject
     *
     * @return mixed
     */
    public function fromJson($value, $asObject = false)
    {
        if ( ! json_decode($value, ! $asObject) || empty($value)) {
            return [crminfo('locale') => (!empty($value) ? $value : '')];
        }

        return parent::fromJson($value, $asObject);
    }

    /**
     * Overwritten method
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts()
    {
        return array_merge(parent::getCasts(), array_fill_keys($this->getTranslatableAttributes(), 'array'));
    }
}
