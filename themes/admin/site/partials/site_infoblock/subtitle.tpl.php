<?php
/*
 * An example of a partial edit template file.
 * Create one called "default.tpl.php" or explicitly named something else if you wanted to use the same build SQL for multiple partials,
 * and instead of naming it name them the template file you want to use and set that in the back-end partials management page
 * (e.g. "withimage.tpl.php" and "textonly.tpl.php" if you wanted a "Accordion with Image" and a "Accordion Text Only" or something)
 *
 * Generally, you can let the system use the /themes/admin/core/partials/general/edit.tpl.php file since it iterates over each
 * attribute in the partial's config file
 */

/** @var \Model\Partial\PartialModel $partial */
$partial = $obj->partial;

$partial->input("title")->output();
$partial->input("subtitle")->output();
$partial->input("text")->limit(300)->output();
$partial->input("link")->output();
$partial->input("label")->output();
$partial->input("newwindow")->output();