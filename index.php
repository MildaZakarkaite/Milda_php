<?php
require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';
$form = [
	'attr' => [
		'action' => 'index.php',
		'class' => 'bg-black'
	],
	'title' => 'Login',
	'fields' => [
		'nickname' => [
			'type' => 'text',
			'label' => 'Nickname:',
			'extra' => [
				'attr' => [
					'placeholder' => 'Enter Name',
					'class' => 'input-text',
					'id' => 'first-name'
				]
			],
			'validators' => [
				'validate_not_empty'
			]
		],
		'password' => [
			'type' => 'text',
			'label' => 'Password:',
			'extra' => [
				'attr' => [
					'placeholder' => 'Password'
				]
			],
			'validators' => [
				'validate_not_empty',
				'validate_password'
			]
		]
	],
	'buttons' => [
		'submit' => [
			'type' => 'submit',
			'value' => 'Siųsti'
		]
	],
	'message' => 'Užpildyk formą!',
	'callbacks' => [
		'fail' => 'form_fail',
		'success' => 'form_success'
	]
];
function form_success($filtered_input, &$form) {
	$form['message'] = 'success!';
    $db_data = file_to_array('data/db.txt');
	
    if (!empty($db_data)) {
        $new_data = $db_data;
    }
	
    $new_data[] = $filtered_input;
    array_to_file($new_data, 'data/db.txt');
	
	setcookie('user', $filtered_input['nickname'], time() + 3600, '/');
	$_COOKIE['user'] = $filtered_input['nickname'];
}
function form_fail($filtered_input, &$form) {
	$form['message'] = 'Yra klaidų!';
	
	$json_string = json_encode($filtered_input);
	setcookie('form-fields', $json_string, time() + 3600, '/');
}
$filtered_input = get_filtered_input($form);
if (!empty($filtered_input)) {
	validate_form($filtered_input, $form);
}
/** 
 * Jei user'is turi cookie su nepavykusios
 * formos duomenimis, tie duomenys 
 * bus įrašyti į formos masyvą ir atsivaizduos
 * užkrovus page'ą.
 */
if (!empty($_COOKIE['form-fields'])) {
	$decoded_array = json_decode($_COOKIE['form-fields'], true);
	foreach ($form['fields'] as $field_id => &$field) {
		$field['value'] = $decoded_array[$field_id];
	}
	
	unset($field);
}
/**
 * Jei yra 'duomenų bazės' failas,
 * į $db bus įrašytas visas jo
 * turinys.
 */
if (file_exists('data/db.txt')) {
	$db = file_to_array('data/db.txt');
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Form Templates</title>
	<link rel="stylesheet" href="includes/style.css">
</head>
<body>
	<!--Jei user'is buvo prisijungęs - bus rodomas table-->
	<?php if (isset($_COOKIE['user'])): ?>
	<table>
		<?php foreach ($db ?? [] as $user): ?>
			<tr>
				<td><?php print $user['nickname']; ?></td>
				<td><?php print $user['password']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<!--Jei user'is svetainėje pirmą kartą - bus rodoma forma-->
	<?php else: ?>
		<?php require 'templates/form.tpl.php'; ?>
	<?php endif; ?>
</body>
</html>