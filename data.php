<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$users_id=1;
$projects=[ 'Входящие', 'Учёба', 'Работа', 'Домашние дела', 'Авто'];
$tasks = [
    [
        'task'=>'Собеседование в IT компании',
        'date'=>'23.06.2019',
        'category'=>'Работа',
        'is_done'=>false
    ],
    [
        'task'=>'Выполнить тестовое задание',
        'date'=>'25.12.2018',
        'category'=>'Работа',
        'is_done'=>false
    ],
    [
        'task'=>'Сделать задание первого раздела',
        'date'=>'21.12.2018',
        'category'=>'Учёба',
        'is_done'=>true
    ],
    [
        'task'=>'Встреча с другом',
        'date'=>'22.12.2018',
        'category'=>'Входящие',
        'is_done'=>false
    ],
    [
        'task'=>'Купить корм для кота',
        'date'=>'Нет',
        'category'=>'Домашние дела',
        'is_done'=>false
    ],
    [
        'task'=>'Заказать пиццу',
        'date'=>'Нет',
        'category'=>'Домашние дела',
        'is_done'=>false
    ]
];