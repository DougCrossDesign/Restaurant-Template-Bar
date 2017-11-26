<?php
use Model\Metadata;
use Model\Pages\Page;
use Model\Redirect;

/** @var TemplateContainer $obj */

/** @var Metadata $metadata */
$metadata = $obj->metadata;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $metadata->input("url")->output();
        ?>
        <li class="lbl-hint col  btm-margin">
            <label>Select a page to auto-import the URL</label>
            <select id="importUrl" onchange="pasteUrl()">
                <option value="">--- Select a page to auto-import ---</option>
                <?php
                /** @var Page $page */
                foreach(\Model\FriendlyUrl::orderBy("friendlyurl")->groupBy('friendlyurl')->get() as $friendlyurl){
                    echo '<option value="'. $friendlyurl->friendlyurl .'">'. $friendlyurl->friendlyurl.'</option>';
                } ?>
            </select>
        </li>
        <?php
        $metadata->input("title")->output();
        $metadata->input("keywords")->output();
        $metadata->input("description")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>

<script type="text/javascript">
    function pasteUrl(){
        var val = $("#importUrl").val();
        if(val.length > 0){
            $("#url").val(val);
        }
    }
</script>