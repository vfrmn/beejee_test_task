<?php


namespace App\Controllers;


use App\Models\Task;
use Core\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->is_logged_in) {
            $this->redirect('/', true);
            die();
        }


    }

    public function completeTask()
    {

        $id = $this->get('id');
        $task_model = Task::find($id);
        $task_model->setComplete(1);
        $task_model->save();
        $this->redirect('message=' . urlencode('Успешно выполнено.'), true);
    }

    public function editTask()
    {
        $id = $this->get('id');
        $task_model = Task::find($id);
        $this->data['task'] = $task_model;

        if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

            $id = $this->post('id');
            $task_text = htmlspecialchars($this->post('task_text'));
            if (strlen($task_text)) {
                $message = '';
                $task_model = Task::find($id);
                if ($task_text != $task_model->getTaskText()){
                    $task_model->setEdited(1);
                    $message = 'Успешно отредактировано.';
                }
                $message = 'Вы ничего не изменили.';

                $task_model->setTaskText($task_text);
                $task_model->save();
                $this->redirect('message=' . urlencode($message), true);
            } else {
                $this->data['message'] = 'Текст задачи не может быть пустым. ';
            }

        }

        $this->view('edit_task', $this->data);
    }


}