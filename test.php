<?php
/*<option value="<?=$value;?>">Входящие</option>
                  <option value="<?=$value;?>">Работа</option>


$task_name = $_POST["name"] ?? "";
$task_date = $_POST["date"] ?? "";
$task_project = $_POST["project"] ?? "";

 <?php if ($val['url_file']=='/uploads/'): ?>
    <a class="download-link" href="">Пусто</a>
<?php endif; ?>



<?php if (!isset($_SESSION['user'])): ?>
                <div class="main-header__side">
                    <a class="main-header__side-item button button--transparent" href="auth.php">Войти</a>
                </div>
 <?php else: ?>
Добавить адачу
Выйти
<?php endif; ?>

$layout_content = include_template ('layout.php', ['user_name'=> $user, 'content'=>$page_content,
    'title'=>'Дела в порядке', 'tasks'=> [], 'projects' => []]);



$user = $_SESSION;
    $sql_from_session = "SELECT id FROM users WHERE email = '$user[email]'";
    $res_session = mysqli_query($con, $sql_from_session);
    $users_id = mysqli_fetch_all($res_session)[0]['id'];

$user_name = $_SESSION["users_name"];
$users_id = $_SESSION["users_id"];

$email_session = mysqli_real_escape_string($con, $_POST['email']);
    $sql_session = "SELECT id FROM users WHERE email = '$email_session'";
    $res_session = mysqli_query($con, $sql_session);

    $users_id = mysqli_fetch_array($res_session, MYSQLI_ASSOC);