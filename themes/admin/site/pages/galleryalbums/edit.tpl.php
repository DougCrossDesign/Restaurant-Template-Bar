<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Galleryalbum;
use Model\Galleryimage;
use Model\Menu;
use Model\Menusection;

/** @var TemplateContainer $obj */

/** @var Galleryalbum $galleryalbum */
$galleryalbum = $obj->galleryalbum;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>
<h1 class="btm-margin"><?php echo $obj->menuname; ?></h1>

<p>
    <a href="/admin/galleryalbums/view/<?php echo $galleryalbum->gallery_id; ?>" class="btn btm-margin">< Back to Albums</a>
    <?php if($galleryalbum->id){ ?>
        <a class="btn floatr" href="/admin/galleryalbums/editordering/<?php echo $galleryalbum->id; ?>">Manage Ordering</a>
    <?php } ?>
</p>
<?php if($galleryalbum->id){ ?>
<h3>Mass Upload</h3>
<div class="admin-section">
    <form action="/admin/galleryalbums/massupload/<?php echo $galleryalbum->id; ?>" method="post" class="dropzone" id="dropzone"></form>
</div>
<?php } ?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <input type="hidden" name="gallery_id" value="<?php echo $obj->galleryid; ?>">
    <ul>
        <?php

        $galleryalbum->input("name")->output();

        $galleryalbum->input("text")->output();
        ?>
    </ul>
    <?php if($galleryalbum->id){ ?>
    <ul>
        <li>
            <div class="admin-section">
                <h2 class="admin-header">Album Images</h2>
                <ul class="buttons" id="meta">
                    <?php
                    /** @var Galleryimage[] $images */
                    $images = $galleryalbum->images()->orderBy("displayorder", "asc")->getResults();

                    if($images->count()){
                        $i = 1;
                        foreach($images as $image){
                            if($itemError = $image->getError('image' . ($i-1))) echo $itemError;
                            ?>
                            <li class="admin-section-t2">
                                <ul>
                                    <input type="hidden" name="image_displayorder[]" value="<?php echo $image->displayorder; ?>" >
                                    <?php printAdminRow("image_title[]", $image->title, "", "text", "Title"); ?>
                                    <?php printAdminImageInput("image_image[]", "/assets/images/galleries/cms/", $image, "Image", "rollover", "image"); ?>
                                    <input type="hidden" name="image_imagefile[]" value="<?php echo $image->image; ?>" />
                                    <select name="image_delete[]">
                                        <option value="0" selected="selected">Active</option>
                                        <option value="1">Delete</option>
                                    </select>
                                </ul>
                            </li>
                            <?php
                            $i++;
                        }
                    } else { ?>
                        <li class="admin-section-t2">
                            <ul>
                                <input type="hidden" name="image_displayorder[]" value="1" >
                                <?php printAdminRow("image_title[]", "", "", "text", "Title"); ?>
                                <?php printAdminImageInput("image_image[]", "/images/galleries/cms/", $obj, "Image", "rollover", "image"); ?>
                                <input type="hidden" name="image_imagefile[]" value="" />
                                <li>
                                    <select name="image_delete[]">
                                        <option value="0" selected="selected">Active</option>
                                        <option value="1">Delete</option>
                                    </select>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
                <a href="javascript:void(0)" onclick="clone()">+ Add</a>
            </div>
        </li>
        <?php } else { ?>
        <li>
            Please create your album before adding items.
        </li>
        <?php } ?>
        <div class="col">
            <input type="submit" name="save" value="Submit" class="btn" />
            <input type="submit" name="cancel" value="Cancel" class="btn2" />
        </div>
    </ul>
</form>