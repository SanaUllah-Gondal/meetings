<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>✅ PHP is working</h2>";
echo "PHP version: " . phpversion() . "<br>";

// Test SQLite
try {
    $db = new PDO('sqlite:' . __DIR__ . '/db.sqlite');
    echo "✅ SQLite connection OK<br>";
    $db->exec("CREATE TABLE IF NOT EXISTS test (id INTEGER)");
    echo "✅ SQLite write OK<br>";
} catch (Exception $e) {
    echo "❌ SQLite error: " . htmlspecialchars($e->getMessage()) . "<br>";
}

// Test Composer autoload
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    echo "✅ vendor/autoload.php exists<br>";
    require __DIR__ . '/vendor/autoload.php';
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        echo "✅ PHPMailer loaded<br>";
    } else {
        echo "❌ PHPMailer not found in autoload<br>";
    }
} else {
    echo "❌ vendor/autoload.php missing — run `composer install`<br>";
}