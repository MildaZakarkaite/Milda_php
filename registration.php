<?php
require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';

$form = [
    'attr' => [
        'action' => '',
    ],
    'fields' => [
        'full_name' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Full Name',
                ]
            ],
            'validators' => [
                'validate_not_empty',
            ],
        ],
        'email' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Email',
                ]
            ],
            'validators' => [
                'validate_not_empty',
                'validate_email',
                'validate_email_unique'
            ],
        ],
        'password' => [
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Password',
                ]
            ],
            'validators' => [
                'validate_not_empty',
            ],
        ],
        'password_repeat' => [
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Password',
                ]
            ],
            'validators' => [
                
            ],
        ],
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ],
    'buttons' => [
        'registration' => [
            'type' => 'submit',
            'value' => 'Registruotis',
            'class' => ''
        ]
    ],
    'callbacks' => [
        'fail' => 'form_fail',
        'success' => 'form_success'
    ]
];

function form_success($filtered_input, $form) {
    $users_array = file_to_array('data/users.txt');
    $users_array[] = $filtered_input;
    array_to_file($users_array, 'data/users.txt');
}

function form_fail($filtered_input, &$form) {
    $form['message'] = 'Formoje yra klaid?!';
}

$filtered_input = get_filtered_input($form);

if (!empty($filtered_input)) {
    validate_form($filtered_input, $form);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registracija</title>
        <style>
            body{
                background: url('https://s.marketwatch.com/public/resources/images/MW-GN951_bubble_ZH_20180807185634.jpg');
                background-size: cover;
                color: #333;
                font: 100% Lato, Arial, Sans Serif;
                height: 100vh;
                overflow-x: hidden;
            }

            div{
                display: flex;
                justify-content: center;
                margin-top: 30px;
            }

            input{
                text-align: center;
                margin: 5px;
border-color: block;
            }

            .create{
                background-color: lightsteelblue;
            }
            #background-wrap {
                bottom: 0;
                left: 0;
                position: fixed;
                right: 0;
                top: 0;
                z-index: -1;
            }

            /* KEYFRAMES */

            @-webkit-keyframes animateBubble {
                0% {
                    margin-top: 1000px;
                }
                100% {
                    margin-top: -100%;
                }
            }

            @-moz-keyframes animateBubble {
                0% {
                    margin-top: 1000px;
                }
                100% {
                    margin-top: -100%;
                }
            }

            @keyframes animateBubble {
                0% {
                    margin-top: 1000px;
                }
                100% {
                    margin-top: -100%;
                }
            }

            @-webkit-keyframes sideWays { 
                0% { 
                    margin-left:0px;
                }
                100% { 
                    margin-left:50px;
                }
            }

            @-moz-keyframes sideWays { 
                0% { 
                    margin-left:0px;
                }
                100% { 
                    margin-left:50px;
                }
            }

            @keyframes sideWays { 
                0% { 
                    margin-left:0px;
                }
                100% { 
                    margin-left:50px;
                }
            }

            /* ANIMATIONS */

            .x1 {
                -webkit-animation: animateBubble 25s linear infinite, sideWays 2s ease-in-out infinite alternate;
                -moz-animation: animateBubble 25s linear infinite, sideWays 2s ease-in-out infinite alternate;
                animation: animateBubble 25s linear infinite, sideWays 2s ease-in-out infinite alternate;

                left: -5%;
                top: 5%;

                -webkit-transform: scale(0.6);
                -moz-transform: scale(0.6);
                transform: scale(0.6);
            }

            .x2 {
                -webkit-animation: animateBubble 20s linear infinite, sideWays 4s ease-in-out infinite alternate;
                -moz-animation: animateBubble 20s linear infinite, sideWays 4s ease-in-out infinite alternate;
                animation: animateBubble 20s linear infinite, sideWays 4s ease-in-out infinite alternate;

                left: 5%;
                top: 80%;

                -webkit-transform: scale(0.4);
                -moz-transform: scale(0.4);
                transform: scale(0.4);
            }

            .x3 {
                -webkit-animation: animateBubble 28s linear infinite, sideWays 2s ease-in-out infinite alternate;
                -moz-animation: animateBubble 28s linear infinite, sideWays 2s ease-in-out infinite alternate;
                animation: animateBubble 28s linear infinite, sideWays 2s ease-in-out infinite alternate;

                left: 10%;
                top: 40%;

                -webkit-transform: scale(0.7);
                -moz-transform: scale(0.7);
                transform: scale(0.7);
            }

            .x4 {
                -webkit-animation: animateBubble 22s linear infinite, sideWays 3s ease-in-out infinite alternate;
                -moz-animation: animateBubble 22s linear infinite, sideWays 3s ease-in-out infinite alternate;
                animation: animateBubble 22s linear infinite, sideWays 3s ease-in-out infinite alternate;

                left: 20%;
                top: 0;

                -webkit-transform: scale(0.3);
                -moz-transform: scale(0.3);
                transform: scale(0.3);
            }

            .x5 {
                -webkit-animation: animateBubble 29s linear infinite, sideWays 4s ease-in-out infinite alternate;
                -moz-animation: animateBubble 29s linear infinite, sideWays 4s ease-in-out infinite alternate;
                animation: animateBubble 29s linear infinite, sideWays 4s ease-in-out infinite alternate;

                left: 30%;
                top: 50%;

                -webkit-transform: scale(0.5);
                -moz-transform: scale(0.5);
                transform: scale(0.5);
            }

            .x6 {
                -webkit-animation: animateBubble 21s linear infinite, sideWays 2s ease-in-out infinite alternate;
                -moz-animation: animateBubble 21s linear infinite, sideWays 2s ease-in-out infinite alternate;
                animation: animateBubble 21s linear infinite, sideWays 2s ease-in-out infinite alternate;

                left: 50%;
                top: 0;

                -webkit-transform: scale(0.8);
                -moz-transform: scale(0.8);
                transform: scale(0.8);
            }

            .x7 {
                -webkit-animation: animateBubble 20s linear infinite, sideWays 2s ease-in-out infinite alternate;
                -moz-animation: animateBubble 20s linear infinite, sideWays 2s ease-in-out infinite alternate;
                animation: animateBubble 20s linear infinite, sideWays 2s ease-in-out infinite alternate;

                left: 65%;
                top: 70%;

                -webkit-transform: scale(0.4);
                -moz-transform: scale(0.4);
                transform: scale(0.4);
            }

            .x8 {
                -webkit-animation: animateBubble 22s linear infinite, sideWays 3s ease-in-out infinite alternate;
                -moz-animation: animateBubble 22s linear infinite, sideWays 3s ease-in-out infinite alternate;
                animation: animateBubble 22s linear infinite, sideWays 3s ease-in-out infinite alternate;

                left: 80%;
                top: 10%;

                -webkit-transform: scale(0.3);
                -moz-transform: scale(0.3);
                transform: scale(0.3);
            }

            .x9 {
                -webkit-animation: animateBubble 29s linear infinite, sideWays 4s ease-in-out infinite alternate;
                -moz-animation: animateBubble 29s linear infinite, sideWays 4s ease-in-out infinite alternate;
                animation: animateBubble 29s linear infinite, sideWays 4s ease-in-out infinite alternate;

                left: 90%;
                top: 50%;

                -webkit-transform: scale(0.6);
                -moz-transform: scale(0.6);
                transform: scale(0.6);
            }

            .x10 {
                -webkit-animation: animateBubble 26s linear infinite, sideWays 2s ease-in-out infinite alternate;
                -moz-animation: animateBubble 26s linear infinite, sideWays 2s ease-in-out infinite alternate;
                animation: animateBubble 26s linear infinite, sideWays 2s ease-in-out infinite alternate;

                left: 80%;
                top: 80%;

                -webkit-transform: scale(0.3);
                -moz-transform: scale(0.3);
                transform: scale(0.3);
            }

            /* OBJECTS */

            .bubble {
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                border-radius: 50%;

                -webkit-box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2), inset 0px 10px 30px 5px rgba(255, 255, 255, 1);
                -moz-box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2), inset 0px 10px 30px 5px rgba(255, 255, 255, 1);
                box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2), inset 0px 10px 30px 5px rgba(255, 255, 255, 1);

                height: 200px;
                position: absolute;
                width: 200px;
            }

            .bubble:after {
                background: -moz-radial-gradient(center, ellipse cover,  rgba(255,255,255,0.5) 0%, rgba(255,255,255,0) 70%); /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(255,255,255,0.5)), color-stop(70%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0) 70%); /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0) 70%); /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0) 70%); /* IE10+ */
                background: radial-gradient(ellipse at center,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0) 70%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#80ffffff', endColorstr='#00ffffff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                border-radius: 50%;

                -webkit-box-shadow: inset 0 20px 30px rgba(255, 255, 255, 0.3);
                -moz-box-shadow: inset 0 20px 30px rgba(255, 255, 255, 0.3);
                box-shadow: inset 0 20px 30px rgba(255, 255, 255, 0.3);

                content: "";
                height: 180px;
                left: 10px;
                position: absolute;
                width: 180px;
            }
        </style>
    </head>
    <body>
        <div>
            <div>
                <?php require 'templates/form.tpl.php'; ?>       
            </div> 
        </div>
        <div id="background-wrap">
            <div class="bubble x1"></div>
            <div class="bubble x2"></div>
            <div class="bubble x3"></div>
            <div class="bubble x4"></div>
            <div class="bubble x5"></div>
            <div class="bubble x6"></div>
            <div class="bubble x7"></div>
            <div class="bubble x8"></div>
            <div class="bubble x9"></div>
            <div class="bubble x10"></div>
        </div>
    </body>
</html>