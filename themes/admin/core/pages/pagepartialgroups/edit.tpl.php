<?php
use Model\Metadata;
use Model\Pages\Page;
use Model\Pages\PagePartialGroup;
use Model\Pages\Partial;
use Model\Redirect;

/** @var TemplateContainer $obj */

/** @var PagePartialGroup $group*/
$group = $obj->pagepartialgroup;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <?php
        $group->input("name")->output();
        $group->input("type")->options(PagePartialGroup::getDropdownValues())->output();
        $group->input("pageid", "Page")->options(["All Pages" => 0] + Page::getDropdownValues())->output();
        $group->input("class")->output();
        ?>

        <li class="col">
            <label>Default Partials:</label>
                <select multiple="multiple" class="chosen" name="defaultids[]">
                    <optgroup label="Partials">
                        <?php
                        /** @var Partial $partial */
                        foreach(Partial::get() as $partial){
                            echo '<option '. ($group->defaultPartials->contains($partial->id) ? ' selected="selected" ' : '') .' value="'.$partial->id.'">'. $partial->name .'</option>';
                        }
                        ?>
                    </optgroup>
                </select>
        </li>


        <li class="col">
            <label>Autocreate Partials:</label>
            <select multiple="multiple" class="chosen" name="autoids[]">
                <optgroup label="Partials">
                    <?php
                    /** @var Partial $partial */
                    foreach(Partial::get() as $partial){
                        echo '<option '. ($group->autocreatePartials->contains($partial->id) ? ' selected="selected" ' : '') .' value="'.$partial->id.'">'. $partial->name .'</option>';
                    }
                    ?>
                </optgroup>
            </select>
        </li>

        <?php
        printAdminSubmitCancelRow();
        ?>
    </ul>

</form>