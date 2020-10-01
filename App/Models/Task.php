<?php

namespace App\Models;

use Core\Model;
use Core\MyPDO;


class Task extends Model
{
    private $id;
    private $name;
    private $email;
    private $task_text;
    private $is_complete;
    private $is_edited;

    /**
     * @return mixed
     */
    public function isEdited()
    {
        return $this->is_edited;
    }

    /**
     * @param mixed $is_edited
     */
    public function setEdited($is_edited): void
    {
        $this->is_edited = $is_edited;
    }


    /**
     * @return mixed
     */
    public function getTaskText()
    {
        return $this->task_text;
    }

    /**
     * @param mixed $task_test
     */
    public function setTaskText($task_text): void
    {
        $this->task_text = $task_text;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function isComplete()
    {
        return $this->is_complete;
    }

    /**
     * @param mixed $is_complete
     */
    public function setComplete($is_complete): void
    {
        $this->is_complete = $is_complete;
    }


    public function __construct()
    {

    }

    public function getTasks($page, $order_data)
    {
        $order_by = $order_data['order_by'];
        $direction = $order_data['direction'];
        $start = (int)(($page - 1) * TASKS_PER_PAGE);
        $tasks_per_page = TASKS_PER_PAGE;

        $result = [];
        $total_amount = +MyPDO::first('SELECT COUNT(*) as count FROM tasks')['count'];
        $pages = ceil($total_amount / $tasks_per_page);


        $prev_link = ($page > 1) ? "<li class=\"\"><a class=\"page-link\" href=\"" . url("?direction=$direction&order_by=$order_by&page=1") . "\">«</a></li><a class=\"page-link\" href=\"" . url("?direction=$direction&order_by=$order_by&page=" . ($page - 1)) . "\">⟨</a>" : "<li class=\"disabled\"><a class=\"page-link\" >«</a></li><a  class=\"page-link disabled\" ) ?>⟨</a>";
        $next_link = ($page < $pages) ? "<a class=\"page-link\" href=\"" . url("?direction=$direction&order_by=$order_by&page=" . ($page + 1)) . "\">⟩</a><li class=\"\"><a class=\"page-link\" href=\"" . url("?direction=$direction&order_by=$order_by&page=" . $pages) . "\">»</a></li>" : "<a  class=\"page-link disabled\" ) ?>⟩</a><li class=\"disabled\"><a class=\"page-link\" >»</a></li>";

        $result['prev_link'] = $prev_link;
        $result['next_link'] = $next_link;
        if (in_array($direction, ['ASC', 'DESC'])
            && in_array($order_by, ['id', 'user_name', 'user_email', 'is_completed'])) {
            $tasks = MyPDO::select("SELECT * FROM tasks ORDER BY $order_by $direction LIMIT $start, $tasks_per_page");
        } else {
            die('Неверный тип сортировки.');
        }
        foreach ($tasks as $task) {
            $result['tasks'][] = self::create_by_row($task);
        }

        return $result;
    }

    static function create_by_row($task): Task
    {
        $object = new self();
        $object->setId($task['id'] ?? null);
        $object->setName($task['user_name']);
        $object->setEmail($task['user_email']);
        $object->setTaskText($task['task_text']);
        $object->setComplete($task['is_completed'] ?? null);
        $object->setEdited($task['is_edited'] ?? null);
        return $object;
    }

    static public function find($id)
    {
        return Task::create_by_row(MyPDO::select("SELECT * FROM tasks WHERE id = :id", ['id' => $id])[0]);
    }


    public function save()
    {
        if ($this->getId() != null) {
            MyPDO::runWithoutFetch('UPDATE tasks 
    SET user_name = :user_name, user_email = :user_email, task_text = :task_text, is_completed = :is_completed, is_edited = :is_edited 
    WHERE id = :id',
                ['user_name' => $this->getName(),
                    'user_email' => $this->getEmail(),
                    'task_text' => $this->getTaskText(),
                    'is_completed' => $this->isComplete(),
                    'is_edited' => $this->isEdited(),
                    'id' => $this->getId()]);

        } else {
            MyPDO::insert('INSERT INTO tasks(user_name, user_email, task_text) 
                        VALUES(:user_name, :user_email, :task_text)', [
                'user_name' => $this->name,
                'user_email' => $this->email,
                'task_text' => $this->task_text,
            ]);
        }
    }


}