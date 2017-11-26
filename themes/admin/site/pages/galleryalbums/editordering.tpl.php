<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Galleryalbum;
use Model\Galleryimage;
use Model\Menu;
use Model\Menusection;

/** @var Galleryalbum $album */
$album = $obj->album;
$images = $album->images();
?>
<?php echo $obj->pagination; ?>
<h1 class="btm-margin"><?php echo $album->name; ?></h1>
<p><a href="/admin/galleryalbums/edit/<?php echo $album->id; ?>" class="btn btm-margin">< Back to Album</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Order</th>
        <th></th>
        <th width="100%"><?php echo printAdminHeader("Title"); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($images->count()) { ?>
        <?php
        /** @var Galleryimage $image */
        foreach ($images->orderBy("displayorder", "asc")->get() as $image) { ?>
            <tr>
                <td>
                    <form action="/admin/galleryalbums/orderimage/<?php echo $image->id; ?>">
                        <select style="padding: 0 0px; width: 50px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                            <?php for($i = 1; $i <= $images->count(); $i++){
                                echo '<option '. ($image->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                            } ?>
                        </select>
                    </form>
                </td>
                <td><img src="/assets/images/galleries/cms/<?php echo $image->image;?>" /></td>
                <td><?php echo $image->title; ?></td>

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


