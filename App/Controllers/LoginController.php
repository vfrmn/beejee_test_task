<?php


namespace App\Controllers;


use Core\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('signin');
    }

    public function login()
    {


        $username = $this->post('username');
        $password = $this->post('password');
        if ($username === 'admin' && $password === '123') {
            $_SESSION['is_login'] = true;
            $this->redirect('message=' . urlencode('Добро пожаловать!'), true);
        } else {
            $result['message'] = 'Неверный логин или пароль!';
            $result['username'] = $username;
            $this->view('signin', $result);
        }

    }

    public function logout()
    {

        session_destroy();
        $this->redirect('/', true);
    }

}