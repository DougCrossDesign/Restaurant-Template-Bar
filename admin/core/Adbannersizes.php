<?php

namespace AdminController;


use \Controller\AdminController;
use \Template;
use \Input;

/**
 * Class Template
 *
 * Copy and modify this controller for default CRUD functionality out of the box.
 *
 * 1. Just extend \AdminController and override:
 * - $controllerName: "events, users"
 * - $templateDir: "Events, Users"
 * - $modelName: "Event, User"
 *
 * 2. Then you'll need to create the template folder and templates
 *
 * 3. And the Model
 *
 * @package AdminController
 */
class Adbannersizes extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "adbannersizes";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "adbannersizes";

    /** @var string The name of the Model  */
    protected $modelName = "AdbannerSize";

    protected $nameIndex = "name";

    protected $modelNameSingular = "Ad Banner Size";
    protected $modelNamePlural = "Ad Banner Sizes";

    protected $sortBy = 'name';
    protected $sortDirection = 'asc';

}