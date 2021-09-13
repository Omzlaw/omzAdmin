<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('model_dropdown')) {
    function modelDropdown(Model $model, $key = 'id', $value = 'name')
    {
        $modelData = $model::orderBy($value)->get();
        $modelArray = array('' => 'Select...');

        foreach ($modelData as $row) {
            $modelArray[$row->{$key}] = $row->{$value};
        }
        return $modelArray;
    }
}

if (!function_exists('get_enum_value')) {
    function get_enum_value($enum, $index)
    {
        if (isset($enum) && isset($index)) {
            $array = $enum();
            $value = $array[$index];
            return ($value != 'Select...') ? $value : 'No selection';
        } else {
            return '---';
        }
    }
}

if (!function_exists('enum_gender')) {
    function enum_gender($add_Select = TRUE)
    {
        $option['-1'] = 'Select...';
        $option['1'] = 'Female';
        $option['2'] = 'Male';
        if (!$add_Select) {
            unset($option['-1']);
        }
        return $option;
    }
}


if (!function_exists('enum_status')) {
    function enum_status($add_Select = TRUE)
    {
        $option['-1'] = 'Select...';
        $option['1'] = 'Inactive';
        $option['2'] = 'Active';
        if (!$add_Select) {
            unset($option['-1']);
        }
        return $option;
    }
}


