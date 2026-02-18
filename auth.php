<?php
// auth.php - Простая авторизация по ключу
header('Content-Type: text/plain');

// Разрешаем запросы с любых источников (для отладки)
header('Access-Control-Allow-Origin: *');

// ===== НАСТРОЙКИ =====
// Список валидных ключей (можно добавлять сколько угодно)
$validKeys = [
    "TEST-KEY-123",
    "PREMIUM-2024",
    "FREE-TRIAL",
    "YOUR-KEY-HERE"
];

// Дополнительная защита: можно проверять по времени
$enableTimeCheck = false; // true = включить проверку по времени
$validUntil = "2025-01-01"; // Дата, до которой ключи работают
// ====================

// Получаем ключ из запроса
$key = isset($_GET['key']) ? trim($_GET['key']) : '';

// Если ключ пустой
if (empty($key)) {
    die("0");
}

// Проверяем, есть ли ключ в списке
if (in_array($key, $validKeys)) {
    // Если включена проверка времени
    if ($enableTimeCheck) {
        $currentDate = date('Y-m-d');
        if ($currentDate > $validUntil) {
            die("0"); // Срок действия истек
        }
    }
    die("1"); // Успех
} else {
    die("0"); // Неудача
}
?>
