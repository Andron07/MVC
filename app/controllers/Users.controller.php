<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize the POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter the email';
            } else {
                //check email exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'Email is registered.';
                }
            }

            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter the name';
            }


            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Please must be atleast 6 characters';
            }


            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Passwords do not match';
                }
            }

            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                //Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register the user
                if ($this->userModel->register($data)) {
                    flash('register_success', 'User registered.');
                    redirect('users/login');
                } else {
                    die('Something went wrong.');
                }
            } else {

                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];
            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // check for posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize the POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter the email';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Please must be atleast 6 characters';
            }
            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {
                $data['email_error'] = 'Email not found.';
            }

            if (empty($data['email_error']) && empty($data['password_error'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_error'] = 'Invalid credentials';
                    $this->view('users/login', $data);
                }
            } else {

                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];
            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('posts');
    }

    public function logout()
    {
        unset($SESSION['user_id']);
        unset($SESSION['user_name']);
        unset($SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }

}
