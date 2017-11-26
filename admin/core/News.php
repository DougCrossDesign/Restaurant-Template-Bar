<?php

namespace AdminController;

use \Controller\AdminController;
use Model\Event;
use \Paginator;
use \Template;

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
class News extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "news";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "news";

    /** @var string The name of the Model  */
    protected $modelName = "News\Newsarticle";

    /** @var string The value to use as the identifying "name" when deleting, etc. This will be set as the $obj->name property when deleting */
    protected $nameIndex = "title";

    protected $modelNameSingular = "Article";
    protected $modelNamePlural = "Articles";

    protected $sortBy = 'date';
    protected $sortDirection = 'asc';

}