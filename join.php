<?php

require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';

session_start();

var_dump($_POST);
$form = [
    'fields' => [
        'player_name' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Player name',
                ]
            ],
            'validators' => [
                'validate_not_empty',
                'validate_player'
            ]
        ],
        'team_select' => [
            'type' => 'select',
            'value' => '',
            'options' => get_options(),
            'validators' => [
                'validate_not_empty'
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'type' => 'submit',
            'value' => 'Join'
        ],
    ],
    'callbacks' => [
        'success' => 'form_success'
    ]
];


function get_options() {
    $teams = file_to_array('data/teams.txt');
    if (!empty($teams)) {
        foreach ($teams as $team) {
            $team_names[$team['team_name']] = $team['team_name'];
        }

        return $team_names;
    }
}

function form_success($filtered_input, &$form) {
    $teams = file_to_array('data/teams.txt');

    foreach ($teams as &$team) {
        if ($team['team_name'] === $filtered_input['team_select']) {
            $team['players'][] = [
                'nickname' => $filtered_input['player_name'],
                'score' => 0
            ];
        }
    }

    array_to_file($teams, 'data/teams.txt');
    $_SESSION['cookie_nickname'] = $filtered_input['player_name'];
    $_SESSION['cookie_team'] = $filtered_input['team_select'];
//    setcookie('cookie_nickname', $filtered_input['player_name'], time() + 3600, '/');
//    setcookie('cookie_team', $filtered_input['team_select'], time() + 3600, '/');
}

function validate_player($field_input, &$field) {
    $teams = file_to_array('data/teams.txt');

    foreach ($teams as $team) {
        foreach ($team['players'] as $player) {
            if (strtoupper($player['nickname']) == strtoupper($field_input)) {
                $field['error'] = 'Toks zaidÄ—jas jau egzistuoja';
                return false;
            }
        }  
    }
    return true;
}

function form_fail($filtered_input, &$form) {
    $form['message'] = 'Yra klaidų!';
}

$filtered_input = get_filtered_input($form);
if (!empty($filtered_input)) {
    $success = validate_form($filtered_input, $form);
}

if(isset($_SESSION['cookie_nickname'])){
     $text = 'Labas, žaidėjau ' . $_SESSION['cookie_nickname'] . ', jau esi komandoje ' . $_SESSION['cookie_team'] . '!';
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form Templates</title>
    </head>
    <body>
         <?php require 'navigation.php'; ?>   
        <?php require 'templates/form.tpl.php'; ?>
    </body>
</html>