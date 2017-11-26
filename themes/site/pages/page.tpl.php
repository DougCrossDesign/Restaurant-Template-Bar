<?php
/**
 * Generic template file for a page
 *
 * @var TemplateContainer $obj                   The data holder object
 *      @var string $obj->page_title             The title of the page
 *      @var string $obj->page_content           The content of the page
 */
use Model\Pages\Partial;

/** @var string $page_title */
$page_title = $obj->page_title;

?>

<div>
    <?php if (isset($obj->partial_templates) && is_array($obj->partial_templates)) { ?>
        <?php
        /** @var Template $template */
        foreach($obj->partial_templates as $template){
            echo $template->render();
        }
        ?>
    <?php } ?>
</div>
<!-- end site/pages/generic -->