<?php

//Is validatoriu mums gryzti tiktai true arba falls

function validate_not_empty($field_input, &$field) {
    if ($field_input === '') {
        $field['error'] = 'Laukas negali b?ti tu�?ias!';
    } else {
        return true;
    }
}

function validate_is_number($field_input, &$field) {
    if (!is_numeric($field_input)) {
        $field['error'] = 'Turi būti įrašytas skai�?ius!';
    } else {
        return true;
    }
}

function validate_is_positive($field_input, &$field) {
    if ($field_input <= 0) {
        $field['error'] = 'Privalo būti teigiamas skai�?ius!';
    } else {
        return true;
    }
}

function validate_max_120($field_input, &$field) {
    if ($field_input > 120) {
        $field['error'] = 'Skai�?ius turi būti mažesnis, negu 120!';
    } else {
        return true;
    }
}

function validate_is_string($field_input, &$field) {
    if (!is_string($field_input)) {
        $field['error'] = 'Įrašykite raides!';
    } else {
        return true;
    }
}

function validate_is_email($field_input, &$field) {
    if (!filter_var($field_input, FILTER_VALIDATE_EMAIL)) {
        $field['error'] = 'Neteisingas emailo formatas!';
    } else {
        return true;
    }
}

//_____________________________________________________
function validate_email($field_input, &$field) {
    if (!filter_var($field_input, FILTER_VALIDATE_EMAIL)) {
        $field['error'] = 'Neteisingas emailo formatas!';
    } else {
        return true;
    }
}

//function validate_email_unique($field_input, &$field) {
//    $users = file_to_array('data/users.txt');
//    var_dump($users);
//
//    if (!empty($users)) {
//        foreach ($users as $value) {
//            if (strtoupper($value['email']) == strtoupper($field_input)) {
//                $field['error'] = 'Toks email adresas jau yra';
//                return false;
//            }
//        }
//    }
//    return true;
//}

function validate_fields_match($filtered_input, &$form, $params) {
var_dump($filtered_input);
var_dump($params);
    $reference_value = $filtered_input[$params[0]];

    foreach ($params as $field_id) {

        if ($reference_value !== $filtered_input[$field_id]) {
            $form['fields'][$field_id]['error'] = 'Laukeliai nesutampa';
            return false;
        }
    }
    return true;
}

//____________________________________________________________
function validate_password($field_input, &$field) {
    if (strlen($field_input) < 8) {
        $field['error'] = 'Per trumpas password';
    } else {
        return true;
    }
}

function validate_team($field_input, &$field) {
//    var_dump('Buvo iskviestas validate_team validatorius');
    $teams = file_to_array('data/teams.txt');
    var_dump($teams);

    if (!empty($teams)) {
        foreach ($teams as $value) {
            if (strtoupper($value['team_name']) == strtoupper($field_input)) {
                $field['error'] = 'Toks komandos pavadinimas jau yra';
                return false;
            }
        }
    }
    return true;
}
