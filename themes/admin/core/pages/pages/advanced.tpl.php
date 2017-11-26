<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\Partial;
use Module\GlobalPageInjectorModule;

$page_title = $obj->page_title;
$form_action = $obj->action_url;

/** @var Page $page */
$page = $obj->page;
?>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
    <ul>
        <?php
        // header input
        $headerInput = $page->input("header");
        if(Auth::userIsInLevel(GlobalPageInjectorModule::HeaderPermissions())){
            $headerInput->type("textarea_raw")->output();
        } else {
            $headerInput->type("hidden")->output();
        }

        // footer input
        $footerInput = $page->input("footer");
        if(Auth::userIsInLevel(GlobalPageInjectorModule::FooterPermissions())){
            $footerInput->type("textarea_raw")->output();
        } else {
            $footerInput->type("hidden")->output();
        }

        // body class input
        $bodyClassInput = $page->input("bodyclass");
        if(Auth::userIsInLevel(GlobalPageInjectorModule::BodyClassPermissions())){
            $bodyClassInput->type("textarea_raw")->output();
        } else {
            $bodyClassInput->type("hidden")->output();
        }

        // tracking scripts input
        $trackingScriptsInput = $page->input("trackingscripts");
        if(Auth::userIsInLevel(GlobalPageInjectorModule::TrackingScriptsPermissions())){
            $trackingScriptsInput->type("textarea_raw")->output();
        } else {
            $trackingScriptsInput->type("hidden")->output();
        }
        printAdminSubmitCancelRow(); ?>
    </ul>
</form>