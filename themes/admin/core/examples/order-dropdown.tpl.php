<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Gallery;
use Model\Menu;

/** @var Gallery $galleries */
$galleries = $obj->gallerys;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<?php if(Auth::isSuperAdmin()){ ?><p><a href="<?php echo $add_link; ?>" class="btn btm-margin">+ Add New Gallery</a></p><?php } ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Order</th>
        <th><?php echo printAdminHeader("Name"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($galleries) > 0) { ?>
        <?php
        /** @var Menu $banner */
        foreach ($galleries as $gallery) { ?>
            <tr>
                <td>
                    <form action="/admin/galleries/order/<?php echo $gallery->id; ?>">
                        <select style="padding: 0 0px; width: 50px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                            <?php for($i = 1; $i <= count($galleries); $i++){
                                echo '<option '. ($gallery->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                            } ?>
                        </select>
                    </form>
                </td>
                <td><a href="/admin/galleryalbums/view/<?php echo $gallery->id; ?>"><?php echo $gallery->name; ?></a></td>
                <td>
                    <a href="/admin/galleries/edit/<?php echo $gallery->id; ?>" class="button">Edit</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No galleries present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


