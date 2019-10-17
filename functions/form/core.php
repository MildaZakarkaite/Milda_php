<?php

require 'validators.php';

/**
 * $sanitize all form inputs
 * 
 */
function get_filtered_input($form) {
//    var_dump('Buvo iskviesta get_filtered_input funkcija');
    $filter_parameters = [];
    foreach ($form['fields'] as $field_id => $field) {
        $filter_parameters[$field_id] = $field['filter'] ?? FILTER_SANITIZE_SPECIAL_CHARS;
    }
    return filter_input_array(INPUT_POST, $filter_parameters);
}

//$filtered_input tai ka useris irase i inputo laukeli arba tuscia
function validate_form($filtered_input, &$form) {
//    var_dump('Buvo iskviesta validate_form funkcija');
    $success = true;
    foreach ($form['fields'] as $field_id => &$field) {
        $field_input = $filtered_input[$field_id];
        $field['value'] = $field_input;
//        if (isset($field['validators'])) {
        foreach ($field['validators'] ?? [] as $validator) {
            $is_valid = $validator($field_input, $field);
            if (!$is_valid) {
                $success = false;
                break;
            }
        }
//        }
    }
    if ($success) {
        if (isset($form['callbacks']['success'])) {
            $form['callbacks']['success']($filtered_input, $form);
        }
    } else {
        if (isset($form['callbacks']['fail'])) {
            $form['callbacks']['fail']($filtered_input, $form);
        }
    }
    return $success;
}
