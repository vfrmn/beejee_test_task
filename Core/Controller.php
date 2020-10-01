<?php


namespace core;


class Controller
{
    protected $data = [];
    protected $is_logged_in = false;

    public function __construct()
    {

        $this->is_logged_in = $this->data['is_logged_in'] = $this->session('is_login') ?? false;
        $this->data['order_by'] = $this->get('order_by');
        $this->data['direction'] = $this->get('direction');
        $this->data['page'] = $this->get('page');


    }


    public function post($key, $default = null)
    {
        return !empty($_POST[$key]) ? $_POST[$key] : $default;
    }

    public function get($key, $default = null)
    {
        return !empty($_GET[$key]) ? $_GET[$key] : $default;
    }

    public function session($key)
    {
        return  $_SESSION[$key] ?? null;
    }


    protected function redirect($url, $save_get_parameters = false)
    {
        $parameters = '';
        if ($save_get_parameters) {
            $parameters .= 'direction=' . $this->get('direction');
            $parameters .= '&order_by=' . $this->get('order_by');
            $parameters .= '&page=' . $this->get('page') . '&';
        }

        header('Location: ' . ROUTE_PATH . '?' . $parameters . $url);
    }

    public function view($name, $args = [])
    {
        if (!file_exists(VIEW_PATH . $name . '.php'))
            die('View not found!');
        $vars = array_merge($this->data, $args);
        extract($vars);
        require_once VIEW_PATH . 'header.php';
        require VIEW_PATH . $name . '.php';
        require_once VIEW_PATH . 'footer.php';


    }


}