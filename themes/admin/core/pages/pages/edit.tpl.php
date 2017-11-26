<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\PagePartialGroup;use Model\Pages\Partial;use Model\User;

$user = Auth::getUser();

$partial = new Partial();

$page_title = $obj->page_title;
$form_action = $obj->action_url;
/** @var Page $page */
$page = $obj->page;

InputErrors::printErrors();
?>
    <a class="btn float" href="/admin/pages">< Back to Pages</a>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
    <a href="/admin/pages/advanced/<?php echo $page->id; ?>" class="btn btm-margin floatr"><i class="aycicon-gear"></i> Advanced Settings</a>

    <ul class="form-col">
    <li class="col">
        <h2 class="admin-header">Page Settings</h2>
    </li>
    <input type="hidden" name="admin_key" value="<?php echo $page->admin_key; ?>" />

<?php
// Hide the ability to change the URL if the URL is locked unless the user is a super admin
// This is to keep clients from rerouting controller-based pages
if(!$page->locked_url || Auth::isSuperAdmin()) {
    printAdminRow('title', $page->title, $page->getError('title'), "text" , null , "" ,"" , 0, "col1-1 col");
    printAdminRow("friendlyurl", $page->getFriendlyUrl() ?: "/", $page->getError('friendlyurl'), "text", "URL - http://" . $_SERVER["HTTP_HOST"] . " (Note: URL must match controller name if not a page-builder site)", "" , "Leave blank to generate URL", 0, "col1-1 col");

} else {
    printAdminRow('title', $page->title, $page->getError('title'), "text" , null , "" ,"" , 0, "col1-1 col");
    ?>
    <input type="hidden" name="friendlyurl" value="<?php echo $page->getFriendlyUrl(); ?>" />
    <?php
}
?>
    <li class="col btm-margin">
        <label>Group Permissions</label>
        <select name="groups[]" multiple="multiple" class="chosen">
            <?php foreach(User::TYPES() as $label => $value){
                if($value){
                    if(($value && $page->groupHasPermission($value) && $value <= Auth::getUserLevel()) || $value == User::TYPE_AYC_ADMIN){
                        echo '<option value="'. $value .'" selected="selected" disabled="disabled">'. $label .'</option>';
                    } else if($value && $page->groupHasPermission($value)){
                        echo '<option value="'. $value .'" selected="selected">'. $label .'</option>';
                    } else {
                        echo '<option value="'. $value .'">'. $label .'</option>';
                    }
                }
            } ?>
        </select>
    </li>
<?php
printAdminRow("searchable", $page->searchable, $page->getError("searchable"), "checkbox", "Page Searchable?");
printAdminRow("in_sitemap", $page->in_sitemap, $page->getError("in_sitemap"), "checkbox", "Include Page In Sitemap?");
if (Auth::isSuperAdmin()) {
    printAdminRow("locked_url", $page->locked_url, $page->getError("locked_url"), "checkbox", "Lock URL?");
}
printAdminSubmitCancelRow("Update");
?>


<?php if ($obj->adding == false) { ?>

    <?php if (isset($obj->section_templates)) { ?>
        <?php foreach ($obj->section_templates as $section) { ?>
            <?php echo $section; ?>
        <?php } ?>
    <?php } ?>

    <hr class="btm-margin" />
    <ul class="form-col">
        <?php if(Auth::userIsInLevel([User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER])){ ?>
            <a href="/admin/pages/partials/<?php echo $page->id; ?>" class="btn btm-margin floatr">Manage Assigned Partials</a>
        <?php } ?>


        <!-- Add New Partials -->
        <li class="col">
            <h2 class="admin-header">Add New Partial</h2>

            <?php
             if ($partial->hasPermissionAdd($user, $page) ) { ?>
                <li class="lbl-hint col">
                    <label class="label" for="section_title">Admin Key</label>
                    <?php if (isset($obj->section_title_error)) { ?>
                        <div class="form_error"><?php echo $obj->section_title_error; ?></div>
                    <?php } ?>
                    <input type="text" id="section_title" name="section_admin_key" placeholder="Admin key" value="<?php echo escape($obj->section_title); ?>" />
                </li>

                <li class="lbl-hint col">
                    <label class="label" for="section_title">Section Title</label>
                    <?php if (isset($obj->section_title_error)) { ?>
                        <div class="form_error"><?php echo $obj->section_title_error; ?></div>
                    <?php } ?>
                    <input type="text" id="section_title" name="section_title" placeholder="Section title" value="<?php echo escape($obj->section_title); ?>" />
                </li>

                <li class="lbl-hint col">
                <?php $partials = $page->getAvailablePartials(); ?>
                    <label class="label" for="partial_type">Section Type</label>
                    <select name="partialid" id="partial_type">
                        <?php
                        $partials = $page->getAvailablePartials();

                        /** @var Partial $partial */
                        foreach ($partials as $partial) {
                            foreach($partial->defaultGroups as $defaultGroup){ ?>
                                <option value="<?php echo $partial->id; ?>"><?php echo $defaultGroup->name; ?>: <?php echo $partial->name; ?></option>
                                <?php
                            }
                        } ?>
                    </select>
                </li>

                <div class="form_row col btm-margin-lg">
                    <input type="submit" class="btn" name="addpartial" value="Add Section" />
                </div>

            <?php } else { ?>
                <p>You are not able to add partials to this page.</p>
            <?php } ?>
        </li>
        <!-- / Add New Partials -->
    </ul>
    </form>
    <?php
    // Show our global partial groups first
    /** @var PagePartialGroup $pagePartialGroup */
    foreach(PagePartialGroup::where("pageid", 0)->get() as $pagePartialGroup){ ?>
        <hr class="btm-margin" />
        <h3><?php echo $pagePartialGroup->name; ?></h3>
        <table cellspacing="0" cellpadding="0" class="datagrid">
            <thead>
            <tr>
                <?php if (Auth::isSuperAdmin()) {?>
                    <th>
                        ID
                    </th>
                    <th>
                        Admin Key
                    </th>
                    <th>
                        Partial Type
                    </th>
                <?php } ?>
                <th>
                    Partial Name
                </th>
                <th>
                    Display Order
                </th>
                <?php if (Auth::isSuperAdmin()) {?>
                    <th>
                        Manage Client Permissions
                    </th>
                <?php } ?>
                <th>
                    Controls
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            $partials = $page->partials()->where("groupid", $pagePartialGroup->id)->orderBy("order", "asc")->get();
            if (count($partials)) { ?>
                <?php foreach($partials as $partial) {
                    /** @var \Model\Partial\PartialModel $partialModel */
                    $partialModel = $partial->model();
                    $partialData = $partialModel->getPartialData();
                    $pivotData = $partialModel->getPivotData();

                    /** @var \Model\Partial\PartialModel[] $partialTranslations */
                    $partialTranslations = $page->getPartialTranslations($partialModel);
                    ?>
                    <tr>
                        <?php if (Auth::isSuperAdmin()) {?>
                            <td>
                                <?php echo $pivotData->id; ?>
                            </td>
                            <td>
                                <?php echo $pivotData->admin_key; ?>
                            </td>
                            <td>
                                <?php echo $partialData->name; ?>
                            </td>
                        <?php } ?>
                        <td>
                            <?php echo $pivotData->title; ?>
                        </td>
                        <td>
                            <?php if(Auth::isSuperAdmin() || in_array($pivotData->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_ORDER_ONLY])){ ?>
                                <form class="order-dropdown " action="/admin/partials/order/<?php echo $pivotData->pageid; ?>/<?php echo $pivotData->id; ?>">
                                    <select class="order-dropdown-select" onchange="javascript:this.form.submit();" name="order">
                                        <?php for($i = 1; $i <= $page->partials()->where("groupid", $partial->pivot->groupid)->get()->count(); $i++){
                                            echo '<option ';
                                            if($partial->pivot->order == $i) {echo ' selected="selected" ';}
                                            echo ' value="'. $i .'">'. $i .'</option>';
                                        } ?>
                                    </select>
                                </form>
                            <?php } else { echo $pivotData->order;  }?>
                        </td>
                        <?php if (Auth::isSuperAdmin()) {?>
                            <td>
                                <form class="order-dropdown " action="/admin/partials/permission/<?php echo $pivotData->pageid; ?>/<?php echo $pivotData->id; ?>">
                                    <select class="order-dropdown-select" onchange="javascript:this.form.submit();" name="permission">
                                        <?php
                                        foreach (Partial::getClientOverridePermissions() as $permissionId => $permissionDescription){
                                            echo '<option ';
                                            if($pivotData->permission == $permissionId) {echo ' selected="selected" ';}
                                            echo ' value="'. $permissionId .'">'. $permissionDescription .'</option>';
                                        } ?>
                                    </select>
                                </form>
                            </td>
                        <?php } ?>
                        <td>
                            <?php
                            // Show a special link for some partial types
                            if ($pivotData->partialid == 1) {
                                $link = $partialModel->link;
                                ?>
                                <a class="button" href="<?php echo $partialModel->link; ?>" <?php if ($partialModel->newwindow) { echo " target='_blank'"; } ?>>
                                    <?php echo $partialModel->label ?: "Manage In The Admin"; ?>
                                </a>
                            <?php } ?>

                            <?php if(Auth::isSuperAdmin() || in_array($pivotData->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_EDIT_ONLY])) { ?>
                                <a class="button" href="/admin/partials/edit/<?php echo $pivotData->pageid; ?>?pivotid=<?php echo $pivotData->id; ?>">Edit</a>
                            <?php } ?>
                            <?php if(Auth::isSuperAdmin() || in_array($pivotData->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_ORDER_ONLY])){ ?>
                                <a class="button" href="/admin/partials/delete/<?php echo $pivotData->pageid; ?>?pivotid=<?php echo $pivotData->id; ?>">Delete</a>
                            <?php } ?>
                            <?php if($page->supportsMultilingual() && (Auth::isSuperAdmin() || in_array($pivotData->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_EDIT_ONLY]))) { ?>
                                <a class="button" href="/admin/partials/translations/<?php echo $pivotData->pageid; ?>/<?php echo $pivotData->id; ?>">Manage Translations (<?php echo count($partialTranslations); ?>)</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7">No <?php echo $pagePartialGroup->name; ?> partials exist on this page.</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    <?php }
} ?>
    </ul>

<?php insertInclude("log", $obj->log); ?>