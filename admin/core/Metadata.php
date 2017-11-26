<?php

namespace AdminController;

use \Controller\AdminController;

class Metadata extends AdminController {

    protected $controllerName = "metadata";
    protected $templateDir = "metadata";
    protected $modelName = "Metadata";



    protected $modelNameSingular = "Metadata";
    protected $modelNamePlural = "Metadata";

    protected $sortBy = 'url';
    protected $sortDirection = 'asc';
}