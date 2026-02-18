<?php
// auth.php - Полная система авторизации
header('Content-Type: text/plain');
header('Access-Control-Allow-Origin: *');

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'auth';
$pass = isset($_GET['pass']) ? $_GET['pass'] : '';

// Пароль для админки (смени на свой)
$adminPass = "admin123";

switch ($mode) {
    case 'auth':
        handleAuth();
        break;
    case 'generate':
        if ($pass !== $adminPass) die("Access denied");
        handleGenerate();
        break;
    case 'list':
        if ($pass !== $adminPass) die("Access denied");
        handleList();
        break;
    default:
        die("Invalid mode");
}

function handleAuth() {
    $key = isset($_GET['key']) ? trim($_GET['key']) : '';
    if (empty($key)) die("0");
    
    // Простой список ключей
    $validKeys = [
        "TEST-KEY-123",
        "PREMIUM-2025",
        "FREE-TRIAL"
    ];
    
    echo in_array($key, $validKeys) ? "1" : "0";
}

function handleGenerate() {
    // Генерация случайного ключа
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $key = '';
    for ($i = 0; $i < 16; $i++) {
        $key .= $chars[rand(0, strlen($chars)-1)];
    }
    
    // Здесь можно сохранить в базу, но пока просто выдаем
    echo "KEY: $key\n";
    echo "Этот ключ нужно добавить в список validKeys вручную";
}

function handleList() {
    echo "Список активных ключей:\n";
    echo "- TEST-KEY-123\n";
    echo "- PREMIUM-2025\n";
    echo "- FREE-TRIAL\n";
}
?>
