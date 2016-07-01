<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Atributi :attribute duhet të pranohet.',
    'active_url'           => 'Atributi :attribute nuk është URL valide.',
    'after'                => 'Atributi :attribute duhet të jetë datë pas :date.',
    'alpha'                => 'Atributi :attribute mund të përmbajë vetëm shkronja.',
    'alpha_dash'           => 'Atributi :attribute mund të përmbajë vetëm shkronja, numra dhe dashes.',
    'alpha_num'            => 'Atributi :attribute mund të përmbajë vetëm shkronja dhe numra.',
    'array'                => 'Atributi :attribute duhet të jetë një array.',
    'before'               => 'Atributi :attribute duhet të jetë një datë para :date.',
    'between'              => [
        'numeric' => 'Atributi :attribute duhet të jetë në mes të :min dhe :max.',
        'file'    => 'Atributi :attribute duhet të jetë në mes të :min dhe :max kilobajt.',
        'string'  => 'Atributi :attribute duhet të jetë në mes të :min dhe :max karaktere.',
        'array'   => 'Atributi :attribute duhet të ketë items në mes të :min dhe :max.',
    ],
    'boolean'              => 'Fusha :attribute duhet të jetë e vërtetë apo jo e vërtetë.',
    'confirmed'            => 'Konfirmimi i atributit :attribute nuk përshtatet.',
    'date'                 => 'Atributi :attribute nuk është datë valide.',
    'date_format'          => 'Atributi :attribute nuk përshtatet me formatin :format.',
    'different'            => 'Atributi :attribute dhe :other duhen të jenë të ndryshme.',
    'digits'               => 'Atributi :attribute duhet të jetë :digits digits.',
    'digits_between'       => 'Atributi :attribute duhet të jetë në mes :min dhe :max.',
    'distinct'             => 'Fusha e atributit :attribute ka vlerë duplikative.',
    'email'                => 'Atributi :attribute duhet të jetë e-mail adresë valide.',
    'exists'               => 'Atributi i zgjedhur :attribute nuk është valid.',
    'filled'               => 'Fusha e atributit :attribute është e kërkuar',
    'image'                => 'Atributi :attribute duhet të jetë imazh.',
    'in'                   => 'Atributi :attribute i zgjedhur është valid.',
    'in_array'             => 'Fusha e atributit :attribute nuk egziston në :other.',
    'integer'              => 'Atributi :attribute duhet të jetë integer.',
    'ip'                   => 'Atributi :attribute duhet të jetë IP adres valide',
    'json'                 => 'Atributi :attribute duhet të jetë Json String valid.',
    'max'                  => [
        'numeric' => 'Atributi :attribute nuk duhet të jetë më i madh se :max.',
        'file'    => 'Atributi :attribute nuk duhet të jetë më i madh se :max kilobajt.',
        'string'  => 'Atributi :attribute nuk duhet të jetë më i madh se :max karaktere.',
        'array'   => 'Atributi :attribute nuk duhet të ket më shum se :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Atributi :attribute duhet të jetë së paku :min.',
        'file'    => 'Atributi :attribute duhet të jetë së paku :min kilobajt.',
        'string'  => 'Atributi :attribute duhet të jetë së paku :min karaktere.',
        'array'   => 'Atributi :attribute duhet të jetë së paku :min items.',
    ],
    'not_in'               => 'Atributi i selektuar :attribute nuk është valid.',
    'numeric'              => 'Atributi :attribute duhet të jetë numër.',
    'present'              => 'Fusha e atributit :attribute duhet të jetë prezent.',
    'regex'                => 'Formati i atributit :attribute është jo-valid.',
    'required'             => 'Fusha e atributit :attribute është e kërkuar.',
    'required_if'          => 'Fusha e atributit :attribute është e kërkuar kur :other është :value.',
    'required_unless'      => 'Fusha e atributit :attribute është e kërkuar me përjashtim kur :other është në :values.',
    'required_with'        => 'Fusha e atributit :attribute është e kërkuar kur :values është present.',
    'required_with_all'    => 'Fusha e atributit :attribute është e kërkuar kur :values është present.',
    'required_without'     => 'Fusha e atributit :attribute është e kërkuar kur :values është not present.',
    'required_without_all' => 'Fusha e atributit :attribute është e kërkuar kur asnjë nga :values është prezent.',
    'same'                 => 'Atributi :attribute dhe :other duhet të përputhen',
    'size'                 => [
        'numeric' => 'Atributi :attribute duhet të jetë :size.',
        'file'    => 'Atributi :attribute duhet të jetë :size kilobajt.',
        'string'  => 'Atributi :attribute duhet të jetë :size karaktere.',
        'array'   => 'Atributi :attribute duhet të përmbaj :size items.',
    ],
    'string'               => 'Atributi :attribute duhet të jetë string.',
    'timezone'             => 'Atributi :attribute duhet të jetë zonë valide.',
    'unique'               => 'Atributi :attribute është në shfrytëzim.',
    'url'                  => 'Formati i atributit :attribute nuk është valid.',
    'no_spaces'            => 'Atributi :attribute nuk duhet të përmbajë hapësira.',
    'no_specials_lower_u'          => 'Atributi :attribute nuk duhet të përmbajë karaktere speciale ose shkronja të mëdha. Lejohen vetëm nënvizat.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];