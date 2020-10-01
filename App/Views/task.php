<div class="task-container w-75 border-dark border <?php if ($task->isComplete()) echo 'completed' ?>">
    <?php if ($is_logged_in): ?>
    <div class="m-3">
        <div class="row d-inline-flex align-items-center">
            <h4>Задача <?= $task->getId() ?> </h4>
            <?php if ($task->isComplete()): ?>
                <h5 class="ml-3">Выполнено</h5>
            <?php else: ?>
                <a class=" ml-3 btn btn-sm btn-outline-secondary text-dark h2 border-success bg-success"
                   href="<?= url('?controller=AdminController&action=completeTask&direction=' . $direction . '&order_by=' . $order_by . '&page=' . $page . '&id=' . $task->getId()) ?>">Complete
                    <i class="fa fa-lg fa-check cursor-pointer"></i></a>
            <?php endif; ?>
            <a class=" ml-3 btn btn-sm btn-outline-danger text-dark h2 border-success bg-warning"
               href="<?= url('?controller=AdminController&action=editTask&direction=' . $direction . '&order_by=' . $order_by . '&page=' . $page . '&id=' . $task->getId()) ?>">Edit
                <i class="fa fa-lg fa-edit cursor-pointer"></i></a>
            <?php if ($task->isEdited()): ?>
                <h5 class="ml-3 col-12 col-sm w-50 d-flex">Отредактировано администратором</h5>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="m-3">
            <h4>Задача <?= $task->getId() ?> </h4>

            <?php endif; ?>
            <h5>Имя пользователя - <?= $task->getName() ?></h5>
            <h5>Почта - <?= $task->getEmail() ?></h5>
            <h5>Задача: <?= $task->getTaskText() ?></h5>
            <div class="task-text-container"></div>
        </div>
    </div>