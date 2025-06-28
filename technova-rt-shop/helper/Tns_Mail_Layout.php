<?php
class Tns_Mail_Layout
{

public static function tns_contact_us_layout(string $full_name, string $email, string $phone_number, string $title, string $message): string
{
return "
<!DOCTYPE html>
<html lang='fa'>
<head>
	<meta charset='UTF-8'>
	<title>پیام جدید از فرم تماس با ما</title>
	<style>
        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            direction: rtl;
            text-align: right;
        }
        h2 {
            color: #333333;
        }
        .info {
            margin-bottom: 20px;
        }
        .info strong {
            color: #555;
        }
        .message {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 6px;
            white-space: pre-wrap;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
	</style>
</head>
<body>

<div class='email-container'>
	<h2>پیام جدید از فرم تماس با ما</h2>

	<div class='info'>
		<p><strong>نام:</strong> {$full_name}</p>
		<p><strong>ایمیل:</strong> {$email}</p>
		<p><strong>شماره تماس:</strong> {$phone_number}</p>
		<p><strong>موضوع:</strong> {$title}</p>
	</div>

	<div class='message'>
		" . nl2br(htmlspecialchars($message)) . "
	</div>

	<div class='footer'>
		این ایمیل به صورت خودکار از طریق فرم تماس با ما ارسال شده است.
	</div>
</div>

</body>
</html>
";
}
}
