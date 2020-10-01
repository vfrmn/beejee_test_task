<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController extends \Core\Controller
{
    const DEFAULT_ORDER_BY = 'id';
    const DEFAULT_DIRECTION = 'DESC';
    const FIRST_PAGE = 1;

    public function index()
    {
        $task_model = new Task();
        $order_by = $this->get('order_by', self::DEFAULT_ORDER_BY);
        $direction = $this->get('direction', self::DEFAULT_DIRECTION);
        $page = $this->get('page', self::FIRST_PAGE);

        $data = $task_model->getTasks($page, ['order_by' => $order_by, 'direction' => $direction]);


        if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

            $user_name = htmlspecialchars($this->post('user_name'));
            $user_email = htmlspecialchars($this->post('user_email'));
            $task_text = htmlspecialchars($this->post('task_text'));

            if (strlen($task_text)) {
                if (strlen($user_name)) {
                    if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                        $task_model = Task::create_by_row([
                            'user_name' => $user_name,
                            'user_email' => $user_email,
                            'task_text' => $task_text
                        ]);
                        $task_model->save();
                        $this->redirect('message=' . urlencode('Успешно добавлено.'), true);
                    } else {

                        $message = 'Неверная почта. ';
                    }
                } else {

                    $message = 'Имя не может быть пустым. ';
                }
            } else {
                $message = 'Текст задачи не может быть пустым. ';
            }
            $data['user_name'] = $user_name;
            $data['user_email'] = $user_email;
            $data['task_text'] = $task_text;


        }
        $data['message'] = $this->get('message', $message ?? null);

        $this->view('home', $data);

    }


}