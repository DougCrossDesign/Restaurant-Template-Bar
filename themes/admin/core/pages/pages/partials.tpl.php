<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\Partial;use Model\User;

$page_title = $obj->page_title;
$form_action = $obj->action_url;
/** @var Page $page */
$page = $obj->page;
?>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
    <ul class="form-col">
        <li class="col">
            <h2 class="admin-header">Assigned Partials:</h2>
            <select multiple="multiple" class="chosen" name="partialids[]">
                <?php
                $currentPartials = $page->availablePartials()->get();
                $currentPartialIds = [];
                foreach($currentPartials as $partial){
                    $currentPartialIds[] = $partial->id;
                }
                /** @var Partial $partial */
                foreach(Partial::orderBy("name", "asc")->get() as $partial){
                    echo '<option '. ((in_array($partial->id, $currentPartialIds))? ' selected="selected" ' : '') .' value="'. $partial->id .'">'. $partial->name .'</option>';
                }
                ?>
            </select>
        </li>
        <?php printAdminSubmitCancelRow(); ?>
    </ul>
