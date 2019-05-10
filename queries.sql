USE daily_plan;
INSERT INTO users (user_name, email, password, registration_date)
VALUES ('Виктория', 'viktoria.vaseva@gmail.com', '123456', '2019-04-10 00:00:00'),
       ('Артём', 'artem@gmail.com', '', '2019-04-10 00:00:00'),
       ('Владислав', 'vladislav@gmail.com', '12345678', '2019-04-10 00:00:00');
INSERT INTO project (category, users_id)
VALUES ('Работа', 1),
       ('Входящие', 1),
       ('Учёба', 1),
       ('Домашние дела', 1),
       ('Авто', 1);

INSERT INTO task (title, users_id, dt_add, status, url_file, deadline, project_id)
VALUES ('Собеседование в IT компании', 1, '2019-04-21 00:00:00', '0', 'https://disk.yandex.ru/client/disk',
        '2019-06-30 00:00:00', 1),
       ('Выполнить тестовое задание', 1, '2019-04-21 00:00:00', '0', 'https://disk.yandex.ru/client/disk',
        '2018-12-25 00:00:00', 1),
       ('Сделать задание первого раздела', 1, '2019-04-21 00:00:00', '1', 'https://disk.yandex.ru/client/disk',
        '2018-12-25 00:00:00', 3),
       ('Встреча с другом', 1, '2019-04-21 00:00:00', '0', 'https://disk.yandex.ru/client/disk', '2018-12-22 00:00:00',
        2),
       ('Купить корм для кота', 1, '2019-04-21 00:00:00', '0', 'https://disk.yandex.ru/client/disk', NULL, 4),
       ('Заказать пиццу', 1, '2019-04-21 00:00:00', '0', 'https://disk.yandex.ru/client/disk', NULL, 4);

/*получить список из всех проектов для одного пользователя*/
SELECT category FROM project WHERE users_id = 1;
/* Объедините проекты с задачами, чтобы посчитать количество задач в каждом проекте*/
SELECT title, category FROM project p JOIN task t ON p.id = t.project_id;
/*получить список из всех задач для одного проекта*/
SELECT title FROM task WHERE project_id = 1;
/*пометить задачу как выполненную*/
UPDATE task SET status='1' WHERE title = 'Купить корм для кота';
/*обновить название задачи по её идентификатору*/
UPDATE task SET title='Заказать огромный торт' WHERE id = 6;