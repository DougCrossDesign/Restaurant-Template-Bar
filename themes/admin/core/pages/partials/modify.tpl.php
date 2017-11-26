<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\PagePartialGroup;
use Model\Pages\Partial;

// TODO remove either this or the edit.tpl
$page_title = $obj->page_title;
$action_url = $obj->action_url;

/** @var Partial $partial */
$partial = $obj->partial;
$partial->treatAsBasePartial = true;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $partial->input("name")->output();
        $partial->input("description")->output();
        $partial->input("directory")->options(Partial::getInstalledPartials())->output();
        $partial->input("template")->label("Template (Leave Blank For Default)")->output();
        ?>
        <li class="lbl-hint col btm-margin">
            <label>Default Partial on Groups:</label>
            <select class="chosen" name="defaultGroups[]" multiple="multiple">
                <?php foreach(PagePartialGroup::get() as $group){ ?>
                    <option value="<?php echo $group->id; ?>" <?php if($partial->isDefaultPartialOnGroup($group->id)) echo ' selected="selected" '; ?>><?php echo $group->name; ?></option>
                <?php } ?>
            </select>
        </li>
        <li class="lbl-hint col btm-margin">
            <label>Auto-Create on Groups:</label>
            <select class="chosen" name="autocreateGroups[]" multiple="multiple">
                <?php foreach(PagePartialGroup::get() as $group){ ?>
                    <option value="<?php echo $group->id; ?>" <?php if($partial->isAutoCreateOnGroup($group->id)) echo ' selected="selected" '; ?>><?php echo $group->name; ?></option>
                <?php } ?>
            </select>
        </li>

        <?php
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>

<?php insertInclude("log", $obj->log); ?>
