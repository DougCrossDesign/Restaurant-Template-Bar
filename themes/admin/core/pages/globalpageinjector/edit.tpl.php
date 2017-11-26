<?php
use Model\EmailAddress;
use Model\EmailList;
use Model\GlobalPageInjection;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var GlobalPageInjection $injection */
$injection = $obj->globalpageinjection;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <li>
            <h2 class="btm-margin"><?php echo $injection->name; ?></h2>
        </li>
        <?php
            $injection->input("value")->output();
            printAdminSubmitCancelRow();
        ?>
    </ul>

</form>