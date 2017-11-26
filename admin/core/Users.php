<?php

namespace AdminController;

use Controller\AdminController;
use \Controller\BaseController;
use \Input;
use \Model\User;
use \Response;
use \Response\PageTemplate;
use \Response\Redirect;
use \Template;

class Users extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "users";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "users";

    /** @var string The name of the Model  */
    protected $modelName = "User";

    protected $nameIndex = "fullname";

    protected $sortBy = 'fullname';
    protected $sortDirection = 'asc';

    protected $modelNameSingular = "User";
    protected $modelNamePlural = "Users";
}