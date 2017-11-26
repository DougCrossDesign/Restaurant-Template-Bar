<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 3/18/2016
 * Time: 4:57 PM
 */

include('../../cms.php');

if(Input::post("confirm") == "yes"){
    $db = config()->getConnection();
    $db->table("cms_core_module_redirects")->truncate(); ?>
    All redirects have been removed. You may now close this window.
    <button onclick="javascript:window.close()">close</button>
    <?php
} else if(Input::post("cancel") == "cancel"){
    ?>
    <script type="text/javascript">
        window.close();
    </script>
    <?
} else {
    ?>
    <form method="post">
        Are you sure you want to empty the redirects? This will immediatly remove all redirects and cannot be undone!
        <input type="submit" name="confirm" value="yes" />
        <input type="submit" name="cancel" value="cancel" />
    </form>
    <?
}


