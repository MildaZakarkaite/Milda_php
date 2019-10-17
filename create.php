<?php
require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';

$form = [
    'attr' => [
        'action' => '',
    ],
    'fields' => [
        'team_name' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Team Name',
                ]
            ],
            'validators' => [
                'validate_not_empty',
                'validate_team'
            ],
            'players' => []
        ],
    ],
    'buttons' => [
        'submit' => [
            'type' => 'submit',
            'value' => 'Creat',
            'class' => 'create'
        ]
    ],
    'callbacks' => [
        'fail' => 'form_fail',
        'success' => 'form_success'
    ]
];

function form_success($filtered_input, $form) {
//    var_dump('form_success pasileido'); // vykdoma, jeigu forma uzpildyta teisingai
    $users_array = file_to_array('data/teams.txt');
    $filtered_input['players'] = [];
    $users_array[] = $filtered_input;
    array_to_file($users_array, 'data/teams.txt');

//    header('Location: join.php');
}

function form_fail($filtered_input, &$form) {
    $form['message'] = 'Yra klaidų!';
}

//Pirmas zingsnis,- isvalome inputus

$filtered_input = get_filtered_input($form);

if (!empty($filtered_input)) {
//    var_dump('buvo submitinta forma.$filtered_input yra pilnas');
    validate_form($filtered_input, $form);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form Templates</title>
        <link rel="stylesheet" href="includes/style.css">
        <style>
            body{
                /*                background: url('https://static.scientificamerican.com/sciam/cache/file/423179ED-050D-40B9-884BE78BE2374BEA_source.jpg?w=590&h=800&17ABB76C-B8EB-4FCB-9182D0440CF24C1A');
                                background-size: cover;*/
            }
            div{
                display: flex;
                justify-content: center;
                background: olive;
                margin-top: 50px;
                /*                opacity: 0.5;*/
                margin-bottom: black;
            }
            input{
                text-align: center;
            }
            .create{
                background-color: darkslategray;
            }
            /*            .input-text{
                            display: fixed;
                            margin-top: 50px;
                            margin-right: 50px;
                            z-index: 1;
                        }*/
        </style>
    </head>
    <body>
        <div>
            <div class="input-text">
                <?php require 'templates/form.tpl.php'; ?>       
            </div> 
        </div>
    </body>
</html>