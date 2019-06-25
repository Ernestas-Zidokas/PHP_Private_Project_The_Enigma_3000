<?php
require_once '../bootloader.php';

$form = [
    'fields' => [
        'code' => [
            'label' => 'Decryption Code',
            'type' => 'text',
            'placeholder' => 'Enter your code',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'data' => [
            'label' => 'Message',
            'type' => 'text',
            'placeholder' => 'Enter your encrypted text',
            'validate' => [
                'validate_not_empty'
            ]
        ]
    ],
    'validate' => [],
    'buttons' => [
        'submit' => [
            'text' => 'Decrypt!'
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
        $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
        $model_decryption = new App\Model\ModelDecryption($db, TABLE_NAME);
        $encrypted_data = $model_decryption->loadArray($safe_input['code']);
        $decryption = new App\Decryption($encrypted_data, $safe_input['data']);

        $success_msg = 'Message successfully decrypted!';
    }
}
?>
<html>
    <head>
        <title>Enigma 3000</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <nav><a href="index.php">Encryption</a></nav>
        <?php require '../core/views/form.php'; ?>
        <?php if (isset($success_msg)): ?>
            <h4><?php print $success_msg; ?></h4>
        <?php endif; ?>
        <?php if (isset($form_success)): ?>
            <h3>Your decrypted message: <?php print $decryption->getMessage(); ?></h3>
        <?php endif; ?>
    </body>
</html>