<?php
require_once('function.php');
require_once('connection.php');

require_once('vendor/autoload.php');

$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 465))
    ->setUsername('33a7d513b59f62')
    ->setPassword('f88d9d625e6ab6')
;
$mailer = new Swift_Mailer($transport);

$logger = new Swift_Plugins_Loggers_ArrayLogger();
$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

$sql_task = "SELECT title, status, users_id, DATE_FORMAT(deadline, '%d.%m.%Y') deadline FROM task WHERE deadline = CURDATE() AND status=0";
$tasks = get_mysql_selection_result($con, $sql_task, []);

$sql_user = "SELECT id, email, user_name FROM users";
$users = get_mysql_selection_result($con, $sql_user, []);

foreach ($users as $user) {

    $recipients[$user['email']] = $user['user_name'];
}

foreach ($tasks as $task) {
    if ($task['users_id'] == $user['id']) {

        $list_task[] = $task["title"];
        $output = implode(", ", $list_task);
        $letter = 'Уважаемый(ая), '.$user['user_name'].'.'.' У вас запланировано: '.$output.' на '.date('d-m-Y');
    }
    if ($list_task == null) {
        $letter = 'Уважаемый(ая), '.$user['user_name'].'.'.' У вас ' .' на '. date('d-m-Y'). '  нет запланированных задач, наслаждайтесь отдыхом.';
    }
}

$message = (new Swift_Message('Уведомление от сервиса «Дела в порядке»'))
    ->setFrom(['keks@phpdemo.ru' => 'Кекс'])
    ->setTo($recipients)
    ->setBody($letter, 'text/html')
;
$mailer->send($message);
