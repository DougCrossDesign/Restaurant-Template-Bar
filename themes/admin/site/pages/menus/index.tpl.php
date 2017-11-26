<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Employee;
use Model\Forms\Form;
use Model\Menu;
use Model\Popup;

/** @var Menu[] $menus */
$menus = $obj->menus;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Menu</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Title"); ?></th>
        <th>Order</th>
        <th>Sections</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($menus) > 0) { ?>
        <?php
        /** @var Menu $menu */
        foreach ($menus as $menu) { ?>
            <tr>
                <td><?php echo $menu->title; ?></td>
                <td>
                    <form action="/admin/menus/order/<?php echo $menu->id; ?>">
                        <select style="padding: 0 0px; width: 50px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                            <?php for($i = 1; $i <= count($menus); $i++){
                                echo '<option '. ($menu->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                            } ?>
                        </select>
                    </form>
                </td>
                <td><a href="/admin/menusections/view/<?php echo $menu->id; ?>">Sections</a></td>
                <td>
                    <a href="/admin/menus/edit/<?php echo $menu->id; ?>" class="button">Edit</a>
                    <a href="/admin/menus/delete/<?php echo $menu->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No menus present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


