<?php
$APIKey = "TEST";
$secretKey = "TEST";

if (!$_POST || $_POST['status'] != 'success') {
    die('Shoplemo.com');
}

$_data = json_decode(stripslashes($_POST['data']), true);
$hash = base64_encode(hash_hmac('sha256', $_data['progress_id'] . implode('|', $_data['payment']) . $APIKey, $secretKey, true));

if ($hash != $_data['hash']) {
    die('Shoplemo: Calculated hashes doesn\'t match!');
}

// all data included in $_data; 

// example data is in example_callback.txt