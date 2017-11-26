<?php
use Model\Events\Event;

/** @var TemplateContainer $obj */

/** @var Event $event */
$eventtag = $obj->eventtag;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
if($eventtag->id){
?>
<?php } ?>
<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm event <?php echo $eventtag->id ? '' : 'new'; ?>">
    <ul>
        <?php
        $eventtag->input("name")->output();

        printAdminSubmitCancelRow();
        ?>
    </ul>

</form>