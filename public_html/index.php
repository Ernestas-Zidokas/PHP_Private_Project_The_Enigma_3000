<?php
require_once '../bootloader.php';

$form = [
    'fields' => [
        'code' => [
            'label' => 'Encryption Code',
            'type' => 'text',
            'placeholder' => 'Enter your code',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'data' => [
            'label' => 'Message',
            'type' => 'text',
            'placeholder' => 'Enter your text',
            'validate' => [
                'validate_not_empty'
            ]
        ]
    ],
    'validate' => [],
    'buttons' => [
        'submit' => [
            'text' => 'Encrypt!'
        ]
    ],
    'callbacks' => [
        'success' => [
            'form_success'
        ],
        'fail' => []
    ]
];

function form_success($safe_input, $form) {

    return true;
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);
    if ($form_success) {
        $alphabet_array = [
            'a' => 'a', 'b' => 'b', 'c' => 'c', 'd' => 'd', 'e' => 'e', 'f' =>
            'f', 'g' => 'g', 'h' => 'h', 'i' => 'i', 'j' => 'j', 'k' => 'k', 'l' => 'l', 'm' =>
            'm', 'n' => 'n', 'o' => 'o', 'p' => 'p', 'q' => 'q', 'r' => 'r', 's' => 's', 't' =>
            't', 'u' => 'u', 'v' => 'v', 'w' => 'w', 'x' => 'x', 'y' => 'y', 'z' => 'z',
            'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' =>
            'F', 'G' => 'G', 'H' => 'H', 'I' => 'I', 'J' => 'J', 'K' => 'K', 'L' => 'L', 'M' =>
            'M', 'N' => 'N', 'O' => 'O', 'P' => 'P', 'Q' => 'Q', 'R' => 'R', 'S' => 'S', 'T' =>
            'T', 'U' => 'U', 'V' => 'V', 'W' => 'W', 'X' => 'X', 'Y' => 'Y', 'Z' => 'Z', ' ' => ' '];

        $encryption = new \App\Encryption($alphabet_array, $safe_input['data']);
        $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
        $model_encryption = new \App\Model\ModelEncryption($db, TABLE_NAME);
        $model_encryption->insert($safe_input['code'], $encryption);

        $success_msg = 'Message successfully encrypted!';
    }
}
?>
<html>
    <head>
        <title>Enigma 3000</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <nav><a href="decryption.php">Decryption</a></nav>
        <?php require '../core/views/form.php'; ?>
        <?php if (isset($success_msg)): ?>
            <h4><?php print $success_msg; ?></h4>
        <?php endif; ?>
        <?php if (isset($form_success)): ?>
            <h2>Your code for decryption: <?php print $safe_input['code']; ?></h2>
            <h3>Your encrypted message: <?php print $encryption->getMessage(); ?></h3>
        <?php endif; ?>
    </body>
</html>