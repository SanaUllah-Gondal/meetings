<?php
// ⚠️ CLI-ONLY — do NOT access via browser
if (php_sapi_name() !== 'cli') {
    exit('Access denied.');
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Find pending reminders where remind_at <= now
$stmt = $db->prepare("
    SELECT r.id, r.user_id, r.meeting_id, u.email, u.name, m.title, m.join_link
    FROM reminders r
    JOIN users u ON r.user_id = u.id
    JOIN meetings m ON r.meeting_id = m.id
    WHERE r.status = 'pending' AND r.remind_at <= datetime('now')
");
$stmt->execute();
$reminders = $stmt->fetchAll();

foreach ($reminders as $r) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->Port = MAIL_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($r['email'], $r['name']);
        $mail->isHTML(true);
        $mail->Subject = "⏰ Reminder: Meeting starts soon!";
        $mail->Body = "
        <h3>Hi {$r['name']},</h3>
        <p>Your meeting <strong>{$r['title']}</strong> starts in 15 minutes.</p>
        <p><a href='{$r['join_link']}' style='display:inline-block;padding:10px 20px;background:#0d6efd;color:white;text-decoration:none;border-radius:5px;'>Join Now</a></p>
        <p>See you there!</p>
        <hr>
        <small>— Doistichat Team</small>
        ";
        $mail->send();

        // Mark as sent
        $db->prepare("UPDATE reminders SET status = 'sent' WHERE id = ?")->execute([$r['id']]);
        echo "✅ Sent to {$r['email']}\n";
    } catch (Exception $e) {
        echo "❌ Failed to send to {$r['email']}: " . $mail->ErrorInfo . "\n";
    }
}