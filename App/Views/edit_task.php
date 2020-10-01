<div class="container pt-5">

    <form action="" method="post">
        <input type="hidden" id="page" name="id" value="<?= $task->getId() ?>">
        <div class="text-center flex-column">
            <h3 class="text-center text-danger mt-2"><?= $message ?? '' ?></h3>
            <h3>Измените текст</h3>
            <textarea name="task_text" id="task_text" cols="70" rows="30"><?= $task->getTaskText() ?></textarea>
            <div class="mt-3">
                <button class=" ml-3 btn btn-md btn-outline-secondary text-dark h2 border-success bg-success">Сохранить
                    <i class="fa fa-lg fa-save cursor-pointer"></i></button>
            </div>
        </div>
    </form>

</div>
