<?php
use Model\Footersitemenu;
use Model\Metadata;
use Model\Siteinfo;
use Model\Sitemenu;
use Model\Sponsor;

try {
    require("inc/cms.php");
    $metadata = new MetaData();

    $template = new Template("pages/home");

    $template->sitemenus = Sitemenu::get();
    $template->footersitemenus = Footersitemenu::get();
    $template->page_meta = Metadata::getByUrlOrUse(Siteinfo::getValueByKey("site title"), Siteinfo::getValueByKey("site title"), Siteinfo::getValueByKey("site title"));
    $response = new \Response\PageTemplate([$template]);
    $response->render();
} catch (Exception $e) {
    Error::exception($e);
}
