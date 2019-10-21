<?php

require 'validators.php';

/**
 * Form'os fieldÅ³ filtravimo f-ija
 * !! Ji nefiltruoja mygtukÅ³, tik field'us
 * @param array $form
 * @return array IÅ¡viltruotas input'Å³ masyvas
 */
function get_filtered_input($form) {
//    var_dump('Buvo iskviesta get_filtered_input funkcija');
    $filter_parameters = [];
    foreach ($form['fields'] as $field_id => $field) {
        $filter_parameters[$field_id] = $field['filter'] ?? FILTER_SANITIZE_SPECIAL_CHARS;
    }
    return filter_input_array(INPUT_POST, $filter_parameters);
}

/**
 * Submit'inus form'Ä…, gausime
 * kuris mygtukas (jo indeksas) buvo paspaustas
 * @return string (mygtuko indeksas)
 */
function get_form_action() {
    return filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * F-ija validuojanti formÄ…
 * @param type $filtered_input
 * @param type $form
 * @return boolean
 */
function validate_form($filtered_input, &$form) {
//    var_dump('Buvo iskviesta validate_form funkcija');
    $success = true;

    // Kiekvieno field'o validacija
    if (isset($form['fields'])) {
        // Jeigu naudosime foreach value per referenca
        // negalima naudoti shorthandinio isset'o
        foreach ($form['fields']as $field_id => &$field) {
            $field_input = $filtered_input[$field_id];
            $field['value'] = $field_input;

            foreach ($field['validators'] ?? [] as $validator) {
                $is_valid = $validator($field_input, $field);
                if (!$is_valid) {
                    $success = false;
                    break;
                }
            }
        }
    }


    if ($success) {
        foreach ($form['validators'] ?? [] as $validator_id => $validator) {
            if (is_array($validator)) {
           $is_valid = $validator_id($filtered_input, $form, $validator);
            } else {
                $is_valid = $validator($filtered_input, $form);
            }
           if (!$is_valid){
               $success = false;
               break;
           }
        }
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

