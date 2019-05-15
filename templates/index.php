<h2 class="content__main-heading">Список задач</h2>
<form class="search-form" action="index.php" method="post" autocomplete="off">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="?filter=all" class="tasks-switch__item <?php echo $_GET['filter'] === "all" ? 'tasks-switch__item--active' : '' ;?>">Все задачи</a>
        <a href="?filter=today" class="tasks-switch__item <?php echo $_GET['filter'] === "today" ? 'tasks-switch__item--active' : '' ;?>">Повестка дня</a>
        <a href="?filter=tomorrow" class="tasks-switch__item <?php echo $_GET['filter'] === 'tomorrow' ? 'tasks-switch__item--active' : '' ;?>">Завтра</a>
        <a href="?filter=failed" class="tasks-switch__item <?php echo $_GET['filter'] === 'failed' ? 'tasks-switch__item--active' : '' ;?>">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php echo $show_complete_tasks == 0 ? '' :'checked' ; ?>>
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <?php foreach ($tasks as $val): ?>
        <?php if ($val['status']==false): ?>
        <tr class="tasks__item task <?=($val['deadline'] != "" && rest_hours($val['deadline'])<24) ? "task--important":"";?>">
            <td class="task__select">
                <label class="checkbox task__checkbox">
                    <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="<?= $val['id']; ?>" >
                    <span class="checkbox__text"><?=htmlspecialchars($val['title']);?></span>
                </label>
            </td>

            <td class="task__file">
                <?php if (isset($val['url_file']) && $val['url_file']!=='/uploads/'): ?>
                    <a class="download-link" href="<?=$val['url_file'];?>" download ><?=str_replace("/uploads/","",$val['url_file']);?></a>
                <?php endif; ?>

            </td>

            <td class="task__date"><?=$val['deadline'];?></td>
        </tr>
        <?php endif; ?>
        <?php if ($val['status']==true && $show_complete_tasks == 1): ?>
            <tr class="tasks__item task task--completed">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden" type="checkbox" checked >

                        <span class="checkbox__text"><?=$val['title'];?></span>
                    </label>
                </td>
                <td class="task__file"></td>
                <td class="task__date"><?=$val['deadline'];?></td>
<!--                <td class="task__controls"></td>-->
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
</table>