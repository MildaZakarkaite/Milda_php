<?php

$randomiser = rand(0, 2);

if ($randomiser === 0) {
    $coffee = 'tea';
} elseif ($randomiser === 1) {
    $coffee = 'black-coffee';
} else {
    $coffee = 'latte';
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gersiu kava/late/tea</title>
        <link rel="stylesheet" href="includes/normalize.css">
        <link rel="stylesheet" href="includes/style.css">
        <style>
            div {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .black-coffee {
                height: 100vh;
                color: white;
                background-color: black;
            }
            .tea {
                height: 100vh;
                color: brown;
                background-color: greenyellow;
            }
            .latte {
                height: 100vh;
                color: white;
                background-color: burlywood;
            }
            p {
                font-size: 40px;
            }
        </style>
    </head>
    <body>  
        <div class="<?php print $coffee; ?>">
            <p>
                Gersiu <?php print $coffee; ?>
            </p>
        </div>
    </body>
</html>
