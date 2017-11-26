<?php


/** @var TemplateContainer $obj */
use Model\Location\Location;
use Model\News\Newsarticle;
use Model\News\Newstag;

/** @var Newsarticle $newsarticle */
$newsarticle = $obj->newsarticle;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>
<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm news <?php echo $newsarticle->id ? '' : 'new'; ?>">
    <ul>
        <?php
        $newsarticle->input("title")->limit(150)->output();
        $newsarticle->input("friendlyurl")->output();

        if( \Module\NewsModule::requiresModule("location") ) {
            $newsarticle->input("location_id", "Location")->options(Location::getDropdownOptions())->output();
        } elseif ( \Module\NewsModule::usesModule("location") ) {
            $newsarticle->input("location_id", "Location")->options(Location::getDropdownOptionsWithGeneralLocation())->output();
        }

        $newsarticle->input("date")->type("date")->output();
        $newsarticle->input("description")->type("textarea")->output();
        $newsarticle->input("summary")->type("textarea_raw")->limit(250)->output();
        $newsarticle->input("image")->type("image")->output();
        $newsarticle->input("imagealt", "Image Description")->output();
        $newsarticle->input("video", "Youtube Video")->output();

        if( \Module\NewsModule::usesModule("images") ) {
            $newsarticle->inputChildren("images")->order("displayorder")->orderingManageable("news")->output();
        }

        if( \Module\NewsModule::usesModule("links") ) {
            $newsarticle->inputChildren("links")->order("displayorder")->orderingManageable("news")->output();
        }

        if( \Module\NewsModule::usesModule("videos") ) {
            $newsarticle->inputChildren("videos")->order("displayorder")->orderingManageable("news")->output();
        }

        if( \Module\NewsModule::usesModule("pdfs") ) {
            $newsarticle->inputChildren("pdfs")->order("displayorder")->orderingManageable("news")->output();
        }

        printAdminSubmitCancelRow();
        ?>
    </ul>

</form>