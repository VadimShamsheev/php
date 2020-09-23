<?php
$nowTime = strtotime('now');
?>
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
                    <?php if ($tableTask != false):?>
                        <?php foreach ($tableTask as $value):?>
                            <?php if (($value['category']==$filterTable) || $filterTable==null):?>
                            <?php 
                                if ($value['date'] != null) {
                                   //$firstDate = timestamp($nowTime) - timestamp($value['Дата выполнения']);
                                }
                            ?>
                            <tr <?php if ($value['isDone']==1 && $show_complete_tasks==0):?> hidden <?php endif;?> class="<?php if ($value['isDone']==0) {$taskInput="tasks__item task";} else {$taskInput="tasks__item task task--completed";} print ($taskInput);?> <?php if ($firstDate / 86400 <= 1):?> task--important <?php endif; ?>">
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
                    <?php else:?>
                    <?="404"?>
                    <?php endif;?>
                </table>
            </main>