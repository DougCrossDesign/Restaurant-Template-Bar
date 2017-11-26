<?php

namespace AdminController;

use \Controller\AdminController;

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
 * 4. And finally the Module if this is an admin module
 *
 * @package AdminController
 */
class Manufacturers extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "manufacturers";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "ecom/manufacturers";

    /** @var string The name of the Model  */
    protected $modelName = "Ecom\Manufacturer";

    //protected $nameIndex = "name";

    protected $sortBy = 'title';
    protected $sortDirection = 'asc';

    //protected $modelNameSingular = "Example Model";
    //protected $modelNamePlural = "Example Models";

}