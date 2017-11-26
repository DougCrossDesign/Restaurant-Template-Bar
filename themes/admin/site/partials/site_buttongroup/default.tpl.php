<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 11/29/2016
 * Time: 5:09 PM
 */

/** @var \Model\PartialModel $partial */
$partial = $obj->partial;

/** @var \Model\Schema $schema */
$schema = $partial->schema();

// If it's the newer type that uses the schema class to hold attributes, use this
if (isset($schema)) {

    $partial->input("title")->output();
    $partial->input("position")->options(getPartialAlightments())->output();
    $partial->input("style")->options(getPartialStyles())->output();

    if ($schema->rawHasMeta()) {
        $partial->inputMeta()->output();
    }

}


function getPartialAlightments() {
    $styles = [
        "center",
        "left",
        "right"
    ];

    return array_combine($styles, $styles);
}

function getPartialStyles() {
    $styles = [
        "btn",
        "btn small",
        "btn2",
        "btn2 small"
    ];

    return array_combine($styles, $styles);
}

