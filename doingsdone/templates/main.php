<?php
$category = array();
foreach ($projectRows as $row) {
    # code...
    $category[] = Array(
            "id" => $row['id'],
        "category" => $row['name'],
    );
}
$tableTask = array();
foreach ($tasksRows as $row) {
    $tableTask[] = Array(
            "id" => $row['id'],
        "task" => $row['name'],
        "date" => $row['date'],
        "category" => $row['category'],
        "isDone" => $row['isDone']
    ); 
    # code...
}
/*[
    [
        "Задача" => "Собеседование в IT компании",
        "Дата выполнения" => "01.12.2020",
        "Категория" => $category[2],
        "Выполнен" => false
    ],
    [
        "Задача" => "Выполнить тестовое задание",
        "Дата выполнения" => "25.12.2020",
        "Категория" => $category[2],
        "Выполнен" => false
    ],
    [
        "Задача" => "Сделать задание первого раздела",
        "Дата выполнения" => "21.12.2020",
        "Категория" => $category[1],
        "Выполнен" => true
    ],
    [
        "Задача" => "Встреча с другом",
        "Дата выполнения" => "22.12.2020",
        "Категория" => $category[0],
        "Выполнен" => false
    ],
    [
        "Задача" => "Купить корм коту",
        "Дата выполнения" => null,
        "Категория" => $category[3],
        "Выполнен" => false
    ],
    [
        "Задача" => "Заказать пиццу",
        "Дата выполнения" => null,
        "Категория" => $category[3],
        "Выполнен" => false
    ]
];*/
function tasksCount (array $task, $category) {
    $count = 0;
    foreach ($task as $key => $value) {
        if ($value["category"]==$category) {
            $count++;
        }
    }
    return $count;
}
function filterText($str) {
    $text = htmlspecialchars($str);
    return $text;
}
$nowTime = strtotime('now');
?>
<div class="content">
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                        <?php foreach ($category as $value):?>
                            <li class="main-navigation__list-item <?php if ($value['id']==$filterTable):?>main-navigation__list-item--active<?php endif;?>">
                            <a class="main-navigation__list-item-link" href="index.php?project=<?=$value['id']?>"><?=$value['category']; ?></a>
                            <span class="main-navigation__list-item-count">
                                <?=tasksCount($tableTask, $value['id']); ?>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if ($show_complete_tasks == 1):?> checked <?php endif;?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                        <?php foreach ($tableTask as $value):?>
                            <?php if (($value['category']==$filterTable) || $filterTable==null):?>
                            <?php 
                                if ($value['date'] != null) {
                                   //$firstDate = timestamp($nowTime) - timestamp($value['Дата выполнения']);
                                }
                            ?>
                            <tr <?php if ($value['isDone']==1 && $show_complete_tasks==0):?> hidden <?php endif;?> class="<?php if ($value['isDone']==0) {$taskInput="tasks__item task";} else {$taskInput="tasks__item task task--completed";}?> <?=$taskInput?> <?php if ($firstDate / 86400 <= 1):?> task--important <?php endif; ?>">
                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if ($value['isDone'] == 1):?> checked <?php endif;?>>
                                        <span class="checkbox__text"><?=filterText($value["task"]);?></span>
                                    </label>
                                </td>

                                <td class="task__file">
                                    <a class="download-link" href="#">Home.psd</a>
                                </td>

                                <td class="task__date">
                                    <?php if ($value["date"] != null):?>
                                        <?=filterText($value["date"]);?>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                </table>
            </main>
        </div>