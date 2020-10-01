<div class="main container">
    <div class="row content ">
        <div class="col-8 w-100 h-100 bg-light pb-3">
            <div class="column d-flex flex-column align-items-center mt-2 ">
                <h3>Задачи:</h3>
                <div class="my-2 w-75">
                    <h4 class="text-center">Сортировка</h4>
                    <div class="d-flex justify-content-between">
                        <form class="d-flex w-100">
                            <label>Поле</label>

                            <select class="form-control mr-3" name="order_by" onchange="this.form.submit()">
                                <option
                                <option <?php if ($order_by == 'id') echo 'selected' ?> value="id">ID</option>
                                <option <?php if ($order_by == 'user_name') echo 'selected' ?> value="user_name">Имя
                                </option>
                                <option <?php if ($order_by == 'user_email') echo 'selected' ?> value="user_email">
                                    Почта
                                </option>
                                <option <?php if ($order_by == 'is_completed') echo 'selected' ?> value="is_completed">
                                    Статус
                                </option>
                            </select>
                            <label>Направление</label>
                            <select class="form-control" name="direction" onchange="this.form.submit()">
                                <option <?php if ($direction == 'DESC') echo 'selected' ?> value="DESC">Убывание
                                </option>
                                <option <?php if ($direction == 'ASC') echo 'selected' ?> value="ASC">Возрастание
                                </option>
                            </select>
                            <?php if (isset($page)): ?>
                                <input type="hidden" name="page" value="<?= $page ?>">
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <ul class="pagination">
                    <li class=""><?= $prev_link ?></li>
                    <li class=""><?= $next_link ?></li>
                </ul>
                <?php if (false): ?>
                    <h5>Пока пусто :</h5>
                <?php else: ?>
                    <?php foreach ($tasks as $task)
                        require VIEW_PATH . 'task.php'
                    ?>
                <?php endif; ?>


            </div>
        </div>
        <div class=" d-flex col-4 flex-column justify-content-start mt-5 pt-5 ">
            <div class="w-100 h-50 px-1 py-1">
                <form action="" method="post">
                    <h3 class="text-center "><?= $message ?? '' ?></h3>
                    <div class="flex-column align-items-center justify-content-between">
                        <div>
                            <label class="w-100 text-center">Ваше имя</label>
                            <input class="form-control" type="text" name="user_name" value="<?= $user_name ?? '' ?>"
                                   placeholder="Имя"/>
                        </div>
                        <div>
                            <label class="w-100 text-center mt-2">Ваше почта</label>
                            <input class="form-control" type="text" name="user_email" value="<?= $user_email ?? '' ?>"
                                   placeholder="example@example.com"/>
                        </div>
                        <div>
                            <label class="w-100 text-center mt-2">Текст</label>
                            <textarea name="task_text" id="task_text" class="w-100 "><?= $task_text ?? '' ?></textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-sm btn-outline-secondary text-dark h2 border-success bg-success"
                                    href="#">Add
                                <i class="fa fa-lg fa-marker cursor-pointer"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
