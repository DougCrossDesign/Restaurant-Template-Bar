<?php
namespace AdminController;

use \Controller\BaseController;
use \Response\PageTemplate;
use Response\Redirect;
use \Template;
use \Validation;
use \Input;

class Login extends BaseController {

    /** @var bool */
    protected $requiresLogin = false;

    /**
     * controller action index
     */
    public function index() {
        if ($this->isLoggedIn) {
            $this->response = new Redirect('/admin/');
        } else {
            $this->show(new Template("pages/login"));
        }
    }

    /**
     * controller action login
     */
    public function login() {
        if (!$this->isLoggedIn) {
            $validator = new Validation($_POST);

            $validator->field('username')
                ->required('Please enter a user name')
                ->plaintext('Please do not use special characters')
                ->max('The user name cannot be more than 40 characters', 40);

            $validator->field('password')
                ->required('Please enter a password')
                ->plaintext('Please do not use special characters')
                ->max('The password cannot be more than 40 characters', 40);

            $success = false;
            $errors = array();
            if ($validator->validates()) {
                if ($this->auth->logInUser(Input::post('username'), Input::post('password'))) {
                    $success = true;
                } else {
                    $errors['message'] = "Invalid username or password.";
                }
            } else {
                foreach ($validator->errors() as $key => $value) {
                    $errors[$key] = $value;
                }
            }

            if (!$success) {
                $template = $this->buildTemplate();
                $template->errors = $errors;
                $this->response = new PageTemplate(['page' => $template], "login");
                $this->response->render();
                die();
            }
        }

        if ($this->response === null) {
            $this->redirect("/admin");
        }
    }

    /**
     * controller action login
     */
    public function logout() {
        if ($this->isLoggedIn) {
            $this->auth->logOutUser();
        }

        $this->response = new Redirect('/admin/login');
        $this->response->render();
        die();

    }

    /**
     * Build the template for our log in form.
     *
     * @return Template
     */
    protected function buildTemplate() {
        $template = new Template('pages/login');
        $template->loggedIn = $this->isLoggedIn;

        // If the auth system has a user message, attach it to the template.
        if ($message = $this->auth->message()) {
            $errors = [];
            $errors['message'] = $message;
            $template->errors = $errors;
        }

        return $template;
    }
}