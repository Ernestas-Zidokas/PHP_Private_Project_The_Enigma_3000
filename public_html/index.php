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
    $data_array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k ', 'l',
        'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

    $encryption = new \App\Encryption($data_array, $safe_input['data']);
    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_encryption = new \App\Model\ModelEncyption($db, $safe_input['code']);
    return true;
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);
    if ($form_success) {
        
    }
}
?>
<html>
    <head>
        <title>Enigma 3000</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
<?php require '../core/views/form.php'; ?>
    </body>
</html>