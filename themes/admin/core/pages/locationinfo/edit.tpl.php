<?php
/** @var TemplateContainer $obj */
use Model\Siteinfo;
use Model\User;
/** @var \Model\Location\Location $location */
$location = $obj->location;
/** @var \Model\Location\LocationInfo[] $infos */
$infos = $obj->infos;
/** @var string $add_link */
$add_link = $obj->add_link;

InputErrors::printErrors();
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

<form action="/admin/locationinfo/edit/<?php echo $location->id; ?>" method="post" enctype="multipart/form-data">
    <table cellspacing="0" cellpadding="0" class="datagrid btm-margin">
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
        if (count($infos) > 0) { ?>
            <?php
            /** @var \Model\Location\LocationInfo $info */
            foreach ($infos as $info) {
                ?>
                <tr data-id="<?php echo $info->id ?: "-1"; ?>">
                    <?php if (Auth::isSuperAdmin()) { ?>
                        <td> <span class="text"><?php echo $info->admin_key; ?></span><span class="input"></span></td>
                    <?php } ?>
                    <td class="editable" data-val="key"><span class="text"><?php echo $info->key; ?></span><span class="input"></span></td>
                    <td class="editable" data-val="value"><span class="text"><?php echo $info->value; ?></span><span class="input"></span></td>
                    <?php if (Auth::isSuperAdmin()) { ?>
                        <td class="permissionsblock" data-val="permission">
                            <span class="permissions-text text"><?php echo Siteinfo::$CLIENT_PERMISSION_LEVELS[(int) $info->permission]; ?></span>
                            <span class="permissions-select" style="display: none;">
                            <select name="permissionselect">
                                <?php foreach(Siteinfo::$CLIENT_PERMISSION_LEVELS as $value => $description) { ?>
                                    <option value="<?php echo $value; ?>" <?php if ($value == $info->permission) { echo " selected=selected"; } ?>><?php echo $description; ?></option>
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
                        if (Auth::isSuperAdmin() || $info->permission == Siteinfo::TYPE_CLIENT_EDIT) { ?>
                            <a href="javascript:void(0)" class="button edit">Quick Edit</a>
                        <?php } ?>
                            <?php
                            // Only AYC admins can delete siteinfo values
                            if (Auth::isSuperAdmin()) { ?>
                                <a href="/admin/locationinfo/delete/<?php echo $info->id; ?>" class="button delete">Delete</a>
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
    <input type="submit" id="saveall" value="Save All Changes" />
</form>

