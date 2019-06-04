<?php

/**
 * Подсчет количества задач у каждого из проектов
 *
 * @param array $list_tasks Список задач в виде массива
 * @param string $category_projects Название проекта
 *
 * @return int Число задач для переданного проекта
 */
function table_tasks($list_tasks, $category_projects)
{
    $number = 0;
    foreach ($list_tasks as $value) {
        if ($value['project_id'] == $category_projects) {
            $number++;
        }
    }
    return $number;
};

/**
 * Подсчет количества часов между текущей датой и датой выполнения задачи
 *
 * @param string $day Дата в виде строки
 *
 * @return int Количество часов между датами
 */
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU');

function rest_hours($day) {
    $secs_in_hour = 3600;
    $fix_date = strtotime($day);
    $curdate = time();
    $count_diff = $fix_date - $curdate;
    $count_hour = floor($count_diff / $secs_in_hour);

    return $count_hour;
};

/**
 * Получает результаты как двумерный массив принимая SQL запрос и подключение к базе
 * для уменьшения строк кода
 * @param $con mysqli Ресурс соединения
 * @param $sql string SQL запрос
 *
 * @return array Массив
 */
function get_mysql_selection_result ($con, $sql) {
    $result = mysqli_query($con, $sql);
    if (!$result) {
        $error = mysqli_error($con);
        print ("Ошибка MySQL: " . $error);
    } else {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

/**
 * Добавляет новую запись на основе готового SQL запроса и переданных данных,
 * функция-помощник
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return string Новая запись
 */
function db_insert_data($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        $result = mysqli_insert_id($link);
    }
    return $result;
}