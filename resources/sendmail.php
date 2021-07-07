<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

// От кого письмо
$mail->setFrom('from@' . $_SERVER['HTTP_HOST'], 'Gart');
// Кому отправить
$mail->addAddress('example@example.com');
// Тема письма
$mail->Subject = 'Проверка связи!';
// Тело письма
$body = '<h1>Тестовое письмо!</h1>';

if (trim(!empty($_POST['username']))) {
  $body.='<p><strong>Имя:</strong> '.$_POST['username'].'</p>';
}
if (trim(!empty($_POST['userphone']))) {
  $body.='<p><strong>Телефон:</strong> '.$_POST['userphone'].'</p>';
}
// if (trim(!empty($_POST['useremail']))) {
//   $body.='<p><strong>E-mail:</strong> '.$_POST['useremail'].'</p>';
// }
// if (trim(!empty($_POST['usermessage']))) {
//   $body.='<p><strong>Сообщение:</strong> '.$_POST['usermessage'].'</p>';
// }

// $mail->msgHTML($body);
$mail->Body = $body;

// Отправка данных
if (!$mail->send()) {
  $message = 'Ошибка!';
} else {
  $message = 'Данные отправлены!';
}

// Формируем JSON для ответа пользователю
$response = ['message' => $message];

// Обратно в JS возвращаем заголовок с ответом
header('Content-type: application/json');
echo json_encode($response);

?>