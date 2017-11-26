<?php
/** @var TemplateContainer $obj */
use Model\Menus\Menu;
use Model\Menus\MenuSection;

/** @var MenuSection $sections */
$sections = $obj->sections;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<h1 class="btm-margin"><?php echo $obj->menuname; ?></h1>
<p><a href="/admin/menus" class="btn btm-margin">< Back to Menus</a></p>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">+ Add New Section</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Order</th>
        <th><?php echo printAdminHeader("Title"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($sections) > 0) { ?>
        <?php
        /** @var MenuSection $section */
        foreach ($sections as $section) { ?>
            <tr>
                <td>
                    <form action="/admin/menusections/order/<?php echo $section->id; ?>">
                        <select style="padding: 0 0px; width: 50px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                            <?php for($i = 1; $i <= count($sections); $i++){
                                echo '<option '. ($section->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                            } ?>
                        </select>
                    </form>
                </td>
                <td><?php echo $section->title; ?></td>
                <td>
                    <a href="/admin/menusections/edit/<?php echo $section->id; ?>" class="button">Edit</a>
                    <a href="/admin/menusections/delete/<?php echo $section->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No sections present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


