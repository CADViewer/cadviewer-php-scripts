<?PHP
$sender = 'developer@tailormade.com';
$recipient = 'developer@tailormade.com';

$subject = "php mail test";
$message = "php test message";
$headers = 'From:' . $sender;

echo "Hello" . $sender;

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>