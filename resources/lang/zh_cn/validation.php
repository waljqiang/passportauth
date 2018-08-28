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

    'accepted'             => ':attribute 必须存在.',
    'active_url'           => ':attribute 不是有效的URL地址.',
    'after'                => ':attribute 必须在 :date 之后.',
    'after_or_equal'       => ':attribute 必须大于或等于 :date.',
    'alpha'                => ':attribute 只能包含字母.',
    'alpha_dash'           => ':attribute 只能包含字母、数字和-.',
    'alpha_num'            => ':attribute 只能包含字母和数字.',
    'array'                => ':attribute 必须是数组.',
    'before'               => ':attribute 必须在 :date 之前.',
    'before_or_equal'      => ':attribute 必须小于或等于 :date.',
    'between'              => [
        'numeric' => ':attribute 必须在 :min 和 :max 之间.',
        'file'    => ':attribute 必须在 :min 和 :max KB之间.',
        'string'  => ':attribute 必须在 :min and :max 字符之间.',
        'array'   => ':attribute 必须有 between :min 到 :max 项.',
    ],
    'boolean'              => ':attribute 只能是true或false.',
    'confirmed'            => '两次 :attribute 输入不一致.',
    'date'                 => ':attribute 不是有效的日期格式.',
    'date_format'          => ':attribute 不符合 :format 格式.',
    'different'            => ':attribute 和 :other 必须不同.',
    'digits'               => ':attribute 必须为 :digits 长的数字.',
    'digits_between'       => ':attribute 必须为长度介于 :min 和 :max 之间的数字.',
    'dimensions'           => ':attribute 图片尺寸无效.',
    'distinct'             => ':attribute 有重复值.',
    'email'                => ':attribute 地址无效.',
    'exists'               => ':attribute 无效.',
    'file'                 => ':attribute 必须是个文件.',
    'filled'               => ':attribute 必须存在一个值.',
    'gt'                   => [
        'numeric' => ':attribute 必须大于 :value.',
        'file'    => ':attribute 必须大于 :value KB.',
        'string'  => ':attribute 必须大于 :value 个字符.',
        'array'   => ':attribute 必须大于 :value 项.',
    ],
    'gte'                  => [
        'numeric' => ':attribute 必须大于等于 :value.',
        'file'    => ':attribute 必须大于等于 :value KB.',
        'string'  => ':attribute 必须大于等于 :value 个字符.',
        'array'   => ':attribute 必须大于等于 :value 项.',
    ],
    'image'                => ':attribute 必须是图片.',
    'in'                   => 'T:attribute 无效.',
    'in_array'             => ':attribute 不存在 :other 中.',
    'integer'              => ':attribute 必须是一个整数.',
    'ip'                   => ':attribute 必须是一个有效的IP地址.',
    'ipv4'                 => ':attribute 必须是一个有效的IPv4地址.',
    'ipv6'                 => ':attribute 必须是一个有效的IPv6地址.',
    'json'                 => ':attribute 必须是一个有效的JSON字符串.',
    'lt'                   => [
        'numeric' => ':attribute 必须小于 :value.',
        'file'    => ':attribute 必须小于 :value KB.',
        'string'  => ':attribute 必须小于 :value 个字符.',
        'array'   => ':attribute 必须小于 :value 项.',
    ],
    'lte'                  => [
        'numeric' => ':attribute 必须小于等于 :value.',
        'file'    => 'The :attribute 必须小于等于 :value KB.',
        'string'  => 'The :attribute 小于等于 :value 个字符.',
        'array'   => 'The :attribute 小于等于 :value 项.',
    ],
    'max'                  => [
        'numeric' => ':attribute 不能大于 :max.',
        'file'    => ':attribute 不能大于 :max KB.',
        'string'  => 'The :attribute 不能大于 :max 个字符.',
        'array'   => 'The :attribute 不能大于 :max 项.',
    ],
    'mimes'                => ':attribute 必须是一个 :values 类型的文件.',
    'mimetypes'            => ':attribute 必须是一个 :values 类型的文件.',
    'min'                  => [
        'numeric' => ':attribute 至少为 :min.',
        'file'    => ':attribute 至少为 :min KB.',
        'string'  => ':attribute 长度至少包含 :min 字符.',
        'array'   => ':attribute 至少包含 :min 项.',
    ],
    'not_in'               => ':attribute 无效.',
    'not_regex'            => ':attribute 格式无效.',
    'numeric'              => ':attribute 必须是数字.',
    'present'              => ':attribute 必须存在.',
    'regex'                => ':attribute 格式无效.',
    'required'             => ':attribute 必须.',
    'required_if'          => '当 :other 等于 :value 时,:attribute 必须存在且不能为空.',
    'required_unless'      => ':attribute 必须存在且不能为空,除非 :other 等于 :values.',
    'required_with'        => '当 :values 中任意字段存在时,:attribute 必须存在且不能为空.',
    'required_with_all'    => '当 :values 所有字段存在时,:attribute 必须存在且不能为空.',
    'required_without'     => '当 :values 中任意字段不存在时,:attribute 必须存在且不能为空.',
    'required_without_all' => '当 :values 全部不存在时,:attribute 必须存在且不能为空.',
    'same'                 => ':attribute 和 :other 必须匹配.',
    'size'                 => [
        'numeric' => ':attribute 必须匹配 :size.',
        'file'    => ':attribute 必须匹配 :size KB.',
        'string'  => 'The :attribute 必须匹配 :size 个字符.',
        'array'   => 'The :attribute 必须匹配 :size 项.',
    ],
    'string'               => ':attribute 必须是字符串.',
    'timezone'             => ':attribute 必须是有效的时区.',
    'unique'               => ':attribute 已经存在.',
    'uploaded'             => ':attribute 上传失败.',
    'url'                  => ':attribute 格式错误.',

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

    'attributes' => [
        'password' => '密码'
    ],

];
