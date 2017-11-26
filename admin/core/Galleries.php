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
class Galleries extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "galleries";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "galleries";

    /** @var string The name of the Model  */
    protected $modelName = "Gallery";

    protected $nameIndex = "name";

    protected $sortBy = 'displayorder';
    protected $sortDirection = 'asc';

    protected $modelNameSingular = "Gallery";
    protected $modelNamePlural = "Galleries";

}