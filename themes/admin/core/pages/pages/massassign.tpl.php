<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\Partial;

$page_title = $obj->page_title;
?>
<form action="" method="POST" enctype="multipart/form-data">
    Select page to mass assign partials to:
    <select name="page_id">
        <?php
        /** @var Page $page */
        foreach(Page::get()->sortBy('title') as $page){
            echo '<option value="'. $page->id .'">'. $page->title . '</option>';
        } ?>
    </select>

    The following partials will be assigned to this page if they aren't already:
    <div class="entry-content">
        <ul>
            <?php
            /** @var Partial $partial */
            foreach(Partial::getDefaultPartials() as $partial){
                echo '<li>' . $partial->name . '</li>';
            } ?>
        </ul>
    </div>

    <input type="submit" value="Assign" name="submit" />
</form>
