<?php
require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';

var_dump($_COOKIE);

$form = [
   'buttons' => [
       'submit' => [
           'type' => 'submit',
           'value' => 'Kick the ball',
       ],
   ],
   'callbacks' => [
       'success' => 'form_success',
   ]
];
$text = 'Go for it, ' . $_COOKIE['cookie_nickname'];



function form_success() {
    $teams = file_to_array('data/teams.txt');
    $teams['players']['score'] += 1;
    return $teams;
    } 
//var_dump($filtered_input);
array_to_file($teams, 'data/teams.txt');    


if(isset($_POST['submit'])){
    form_success($form);
}

?>
<html>
   <head>
       <meta charset="UTF-8">
       <link rel="stylesheet" href="includes/style.css">
   </head>
   <body class="bg">
       <div class="laukas">
           <h1><?php print $text; ?></h1>
           <?php require 'templates/form.tpl.php'; ?>
       </div>
   </body>
</html>