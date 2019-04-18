<?php
function table_tasks($list_tasks, $category_projects)
{
    $number = 0;
    foreach ($list_tasks as $value) {
        if ($value['category'] == $category_projects) {
            $number++;
        }
    }
    return $number;
};




