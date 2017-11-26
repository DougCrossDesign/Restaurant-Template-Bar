<?php
/** @var TemplateContainer $obj */
use Model\Siteinfo;
use Model\User;

/** @var Siteinfo[] $redirects */
$siteinfos = $obj->siteinfos;
/** @var string $add_link */
$add_link = $obj->add_link;

?>
<style type="text/css">
    span.tabs-nav {
        background: gray;
        color: white;
        padding: 10px 20px;
        display: inline-block;
        cursor: pointer;
    }
    span.tabs-nav.active {
        background: #3F3F3E;
        color: #8dc63f;
    }
    tr.pending {
        color:darkgreen;
        background: #DFFFDF;
    }
</style>
<?php
// only admins can add new site info items
if (Auth::getUserLevel() == User::TYPE_AYC_ADMIN) { ?>
    <p><a href="/admin/siteinfogroups" class="btn floatr">Manage Info Groups</a></p>
    <p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Site Info</a></p>
<?php } ?>

<?php InputErrors::printErrors(); ?>

<form action="/admin/siteinfo/saveall" method="post" enctype="multipart/form-data" data-lock-url="/admin/siteinfo/lock/">
    <?php
    $i = 0;
    foreach($obj->groupedInfo as $title => $group){ ?>
        <span data-tabid="<?php echo $obj->allGroups[$i][0]; ?>" class="tabs-nav <?php if(!$i) echo 'active'; ?>"  data-tab="<?php echo $title; ?>"><?php echo $title; ?> (<?php echo count($group); ?>)</span>
        <?php
        $i++;
    }

    /**
     * @var  $title     string      Name of the group
     * @var  $group     Siteinfo[]  The siteinfo items
     */
    $visibleTab = false;
    foreach($obj->groupedInfo as $title => $group){ ?>
        <table <?php if(!$visibleTab){
            $visibleTab = true;
        } else {
            echo ' style="display: none;" ';
        } ?> data-tab="<?php echo $title; ?>" cellspacing="0" cellpadding="0" class="datagrid btm-margin">
            <thead>
            <tr>
                <?php if (Auth::isSuperAdmin()) { ?><th><?php printAdminHeader("Admin Key", "admin_key"); ?></th><?php } ?>
                <th><?php printAdminHeader("Name", "key"); ?></th>
                <th><?php printAdminHeader("Value"); ?></th>
                <?php if (Auth::isSuperAdmin()) { ?><th><?php printAdminHeader("Client Permission", "permission"); ?></th><?php } ?>
                <th>Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count($group) > 0) { ?>
                <?php
                /** @var Siteinfo $siteinfo */
                foreach ($group as $siteinfo) {
                    // Don't show if the logged in user is not AYC and the site info is set to be hidden to the client
                    //if (Auth::getUserLevel() > User::TYPE_AYC_USER && $siteinfo->permission == Siteinfo::TYPE_CLIENT_HIDDEN) { continue; }

                    ?>
                    <tr data-id="<?php echo $siteinfo->id; ?>">
                        <?php if (Auth::isSuperAdmin()) { ?>
                            <td class="editable" data-val="admin_key"> <span class="text"><?php echo $siteinfo->admin_key; ?></span><span class="input"></span></td>
                        <?php } ?>
                        <td <?php if (Auth::isSuperAdmin()) { ?>class="editable"<?php } ?> data-val="key"><span class="text"><?php echo $siteinfo->key; ?></span><span class="input"></span></td>
                        <td class="editable" data-val="value"><span class="text"><?php echo $siteinfo->value; ?></span><span class="input"></span></td>
                        <?php if (Auth::isSuperAdmin()) { ?>
                            <td class="permissionsblock" data-val="permission">
                                <span class="permissions-text text"><?php echo Siteinfo::$CLIENT_PERMISSION_LEVELS[(int) $siteinfo->permission]; ?></span>
                                <span class="permissions-select" style="display: none;">
                                <select name="permissionselect">
                                    <?php foreach(Siteinfo::$CLIENT_PERMISSION_LEVELS as $value => $description) { ?>
                                        <option value="<?php echo $value; ?>" <?php if ($value == $siteinfo->permission) { echo " selected=selected"; } ?>><?php echo $description; ?></option>
                                    <?php } ?>
                                </select>
                            </span>
                                <span class="input"></span>
                            </td>
                        <?php } ?>
                        <td>
                        <span class="options-editing" style="display: none;">
                            <a href="javascript:void(0)" class="button save">Save</a>
                            <a href="javascript:void(0)" class="button cancel">Cancel</a>
                        </span>
                            <span class="options-not-editing">
                            <?php
                            // AYC admins can always edit; clients can edit if the siteinfo permission value is correct
                            if (Auth::isSuperAdmin() || $siteinfo->permission == Siteinfo::TYPE_CLIENT_EDIT) { ?>
                                <a href="javascript:void(0)" class="button edit">Quick Edit</a>
                            <?php } ?>
                            <?php
                            // Only AYC admins can delete siteinfo values
                            if (Auth::isSuperAdmin()) { ?>
                                <a href="/admin/siteinfo/delete/<?php echo $siteinfo->id; ?>" class="button delete">Delete</a>
                            <?php } ?>
                        </span>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">
                        No information present. <?php if (Auth::getUserLevel() == User::TYPE_AYC_ADMIN) { ?><a href="<?php echo $add_link; ?>">Click here to add one.</a><?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>

    <input type="submit" id="saveall" value="Save All Changes" />
</form>

