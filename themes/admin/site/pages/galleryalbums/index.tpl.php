<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Galleryalbum;
use Model\Menu;
use Model\Menusection;

/** @var Galleryalbum[] $albums */
$albums = $obj->albums;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<h1 class="btm-margin"><?php echo $obj->galleryname; ?></h1>
<p><a href="/admin/galleries" class="btn btm-margin">< Back to Galleries</a></p>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">+ Add New Album</a></p>

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
    if (count($albums) > 0) { ?>
        <?php
        /** @var Galleryalbum $album */
        foreach ($albums as $album) { ?>
            <tr>
                <td>
                    <form action="/admin/galleryalbums/order/<?php echo $album->id; ?>">
                        <select style="padding: 0 0px; width: 50px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                            <?php for($i = 1; $i <= count($albums); $i++){
                                echo '<option '. ($album->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                            } ?>
                        </select>
                    </form>
                </td>
                <td><?php echo $album->name; ?></td>
                <td>
                    <?php if($album->images()->count()){ ?><a href="/admin/galleryalbums/editordering/<?php echo $album->id; ?>" class="button">Edit Ordering</a><?php } ?>
                    <a href="/admin/galleryalbums/edit/<?php echo $album->id; ?>" class="button">Edit</a>
                    <a href="/admin/galleryalbums/delete/<?php echo $album->id; ?>" class="button">Delete</a>

                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No albums present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


