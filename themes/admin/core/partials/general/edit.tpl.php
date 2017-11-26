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

    $attributes = $schema->getAttributes();
    if (count($attributes)) {
        foreach ($attributes as $columnName => $properties) {
            $partial->input($columnName)->output();
        }
    }

    if ($schema->rawHasMeta()) {
        $partial->inputMeta()->output();
    }

}