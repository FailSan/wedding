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

    'accepted' => 'The :Attribute must be accepted.',
    'accepted_if' => 'The :Attribute must be accepted when :other is :value.',
    'active_url' => 'The :Attribute is not a valid URL.',
    'after' => 'The :Attribute must be a date after :date.',
    'after_or_equal' => 'The :Attribute must be a date after or equal to :date.',
    'alpha' => 'The :Attribute must only contain letters.',
    'alpha_dash' => 'The :Attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :Attribute must only contain letters and numbers.',
    'array' => 'The :Attribute must be an array.',
    'ascii' => 'The :Attribute must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :Attribute must be a date before :date.',
    'before_or_equal' => 'The :Attribute must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :Attribute must have between :min and :max items.',
        'file' => 'The :Attribute must be between :min and :max kilobytes.',
        'numeric' => 'The :Attribute must be between :min and :max.',
        'string' => 'The :Attribute must be between :min and :max characters.',
    ],
    'boolean' => 'The :Attribute field must be true or false.',
    'confirmed' => 'The :Attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :Attribute is not a valid date.',
    'date_equals' => 'The :Attribute must be a date equal to :date.',
    'date_format' => 'The :Attribute does not match the format :format.',
    'decimal' => 'The :Attribute must have :decimal decimal places.',
    'declined' => 'The :Attribute must be declined.',
    'declined_if' => 'The :Attribute must be declined when :other is :value.',
    'different' => 'The :Attribute and :other must be different.',
    'digits' => 'The :Attribute must be :digits digits.',
    'digits_between' => 'The :Attribute must be between :min and :max digits.',
    'dimensions' => 'The :Attribute has invalid image dimensions.',
    'distinct' => 'The :Attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :Attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :Attribute may not start with one of the following: :values.',
    'email' => 'The :Attribute must be a valid email address.',
    'ends_with' => 'The :Attribute must end with one of the following: :values.',
    'enum' => 'The selected :Attribute is invalid.',
    'exists' => 'The selected :Attribute is invalid.',
    'file' => 'The :Attribute must be a file.',
    'filled' => 'The :Attribute field must have a value.',
    'gt' => [
        'array' => 'The :Attribute must have more than :value items.',
        'file' => 'The :Attribute must be greater than :value kilobytes.',
        'numeric' => 'The :Attribute must be greater than :value.',
        'string' => 'The :Attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :Attribute must have :value items or more.',
        'file' => 'The :Attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :Attribute must be greater than or equal to :value.',
        'string' => 'The :Attribute must be greater than or equal to :value characters.',
    ],
    'image' => 'The :Attribute must be an image.',
    'in' => 'The selected :Attribute is invalid.',
    'in_array' => 'The :Attribute field does not exist in :other.',
    'integer' => 'The :Attribute must be an integer.',
    'ip' => 'The :Attribute must be a valid IP address.',
    'ipv4' => 'The :Attribute must be a valid IPv4 address.',
    'ipv6' => 'The :Attribute must be a valid IPv6 address.',
    'json' => 'The :Attribute must be a valid JSON string.',
    'lowercase' => 'The :Attribute must be lowercase.',
    'lt' => [
        'array' => 'The :Attribute must have less than :value items.',
        'file' => 'The :Attribute must be less than :value kilobytes.',
        'numeric' => 'The :Attribute must be less than :value.',
        'string' => 'The :Attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :Attribute must not have more than :value items.',
        'file' => 'The :Attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :Attribute must be less than or equal to :value.',
        'string' => 'The :Attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :Attribute must be a valid MAC address.',
    'max' => [
        'array' => 'The :Attribute must not have more than :max items.',
        'file' => 'The :Attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :Attribute must not be greater than :max.',
        'string' => 'The :Attribute must not be greater than :max characters.',
    ],
    'max_digits' => 'The :Attribute must not have more than :max digits.',
    'mimes' => 'The :Attribute must be a file of type: :values.',
    'mimetypes' => 'The :Attribute must be a file of type: :values.',
    'min' => [
        'array' => 'The :Attribute must have at least :min items.',
        'file' => 'The :Attribute must be at least :min kilobytes.',
        'numeric' => 'The :Attribute must be at least :min.',
        'string' => 'The :Attribute must be at least :min characters.',
    ],
    'min_digits' => 'The :Attribute must have at least :min digits.',
    'multiple_of' => 'The :Attribute must be a multiple of :value.',
    'not_in' => 'The selected :Attribute is invalid.',
    'not_regex' => 'The :Attribute format is invalid.',
    'numeric' => 'The :Attribute must be a number.',
    'password' => [
        'letters' => 'The :Attribute must contain at least one letter.',
        'mixed' => 'The :Attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :Attribute must contain at least one number.',
        'symbols' => 'The :Attribute must contain at least one symbol.',
        'uncompromised' => 'The given :Attribute has appeared in a data leak. Please choose a different :Attribute.',
    ],
    'present' => 'The :Attribute field must be present.',
    'prohibited' => 'The :Attribute field is prohibited.',
    'prohibited_if' => 'The :Attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :Attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :Attribute field prohibits :other from being present.',
    'regex' => 'The :Attribute format is invalid.',
    'required' => 'The :Attribute field is required.',
    'required_array_keys' => 'The :Attribute field must contain entries for: :values.',
    'required_if' => 'The :Attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :Attribute field is required when :other is accepted.',
    'required_unless' => 'The :Attribute field is required unless :other is in :values.',
    'required_with' => 'The :Attribute field is required when :values is present.',
    'required_with_all' => 'The :Attribute field is required when :values are present.',
    'required_without' => 'The :Attribute field is required when :values is not present.',
    'required_without_all' => 'The :Attribute field is required when none of :values are present.',
    'same' => 'The :Attribute and :other must match.',
    'size' => [
        'array' => 'The :Attribute must contain :size items.',
        'file' => 'The :Attribute must be :size kilobytes.',
        'numeric' => 'The :Attribute must be :size.',
        'string' => 'The :Attribute must be :size characters.',
    ],
    'starts_with' => 'The :Attribute must start with one of the following: :values.',
    'string' => 'The :Attribute must be a string.',
    'timezone' => 'The :Attribute must be a valid timezone.',
    'unique' => 'The :Attribute has already been taken.',
    'uploaded' => 'The :Attribute failed to upload.',
    'uppercase' => 'The :Attribute must be uppercase.',
    'url' => 'The :Attribute must be a valid URL.',
    'ulid' => 'The :Attribute must be a valid ULID.',
    'uuid' => 'The :Attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "Attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given Attribute rule.
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
    | The following language lines are used to swap our Attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
