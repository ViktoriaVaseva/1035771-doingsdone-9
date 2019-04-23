INSERT INTO user SET user_name='Виктория', email='viktoria.vaseva@gmail.com', password='123456', registration_date ='10.04.2019';
INSERT INTO user SET user_name='Артём', email='artem@gmail.com', password='', registration_date ='10.04.2019';
INSERT INTO user SET user_name='Владислав', email='vladislav@gmail.com', password='12345678', registration_date ='10.04.2019';

INSERT INTO project SET category='Работа', user_id=1;
INSERT INTO project SET category='Входящие', user_id=1;
INSERT INTO project SET category='Учёба', user_id=1;
INSERT INTO project SET category='Домашние дела', user_id=1;
INSERT INTO project SET category='Авто', user_id=1;

INSERT INTO task SET title='Собеседование в IT компании', user_id=1, dt_add='14.04.2019', status='0', url_file='https://disk.yandex.ru/client/disk', deadline='23.04.2019', project_id=1;
INSERT INTO task SET title='Выполнить тестовое задание', user_id=1, dt_add='14.04.2019', status='0', url_file='https://disk.yandex.ru/client/disk', deadline='25.12.2018', project_id=1;
INSERT INTO task SET title='Сделать задание первого раздела', user_id=1, dt_add='14.04.2019', status='1', url_file='https://disk.yandex.ru/client/disk', deadline='21.12.2018', project_id=3;
INSERT INTO task SET title='Встреча с другом', user_id=1, dt_add='14.04.2019', status='0', url_file='https://disk.yandex.ru/client/disk', deadline='22.12.2018', project_id=2;
INSERT INTO task SET title='Купить корм для кота', user_id=1, dt_add='14.04.2019', status='0', url_file='https://disk.yandex.ru/client/disk', deadline='Нет', project_id=4;
INSERT INTO task SET title='Заказать пиццу', user_id=1, dt_add='14.04.2019', status='0', url_file='https://disk.yandex.ru/client/disk', deadline='Нет', project_id=4;

/*получить список из всех проектов для одного пользователя*/
SELECT category FROM project WHERE user_id=1;
/* Объедините проекты с задачами, чтобы посчитать количество задач в каждом проекте*/
SELECT title, category FROM project p JOIN task t ON p.id = t.project_id;
/*получить список из всех задач для одного проекта*/
SELECT title FROM task WHERE project_id=1;
/*пометить задачу как выполненную*/
UPDATE task SET status='1' WHERE title='Купить корм для кота';
/*обновить название задачи по её идентификатору*/
UPDATE task SET title='Заказать огромный торт' WHERE id=6;