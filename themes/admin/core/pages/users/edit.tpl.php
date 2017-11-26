<?php /** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\User;

/** @var User $user */
$user = $obj->user;

InputErrors::printErrors();
?>
<form action="<?php echo $obj->action_url; ?>" method="POST">
    <ul>
    <?php
        if(!Auth::userIsInLevel(User::TYPE_CLIENT_USER)){
            ?>
            <li class="btm-margin">
                <label for="userlevel">User Level:</label><select id="userlevel" name="userlevel">
                    <?php foreach(User::TYPES() as $label => $level){
                        if(Auth::getUserLevel() <= $level){
                        ?>
                        <option <?php if($obj->user->userlevel == $level) echo ' selected="selected" '; ?> value="<?php echo $level; ?>"><?php echo $label; ?></option>

                    <?php }
                    } ?>
                </select>
            </li>
            <?php
        }
        $user->input("username")->output();
        $user->input("fullname")->output();
        $user->input("email")->output();
        $user->input("password")->value("")->type(IB_PASSWORD)->isRequired($obj->adding)->output();
        $user->input("confirm_password")->label("Confirm Password")->isRequired($obj->adding)->limit(255)->value("")->type(IB_PASSWORD)->output();

        if($user->userIsInLevel(User::TYPE_CLIENT_USER)) {
            ?>
            <li>
                <label for="pageids">Allowed Modules:</label>
                <select class="chosen" name="moduleids[]" multiple="multiple">
                    <?php
                    $thisUserModules = $user->getModuleNames();
                    $modules = Module::getAllUserAccessibleModules($user->id);
                    foreach ($modules as $moduleGroup => $childModules) {
                        echo '<optgroup label="' . $moduleGroup . '">';
                        foreach($childModules as $name => $link){
                            echo '<option value="' . $link . '" ';
                            if(in_array($link, $thisUserModules)) echo ' selected="selected" ';
                            echo '>' . $name . '</option>';
                        }
                        echo '</optgroup>';
                    } ?>
                </select>
            </li>
            <?php
        }
        if($user->userIsInLevel(User::TYPE_CLIENT_USER)) {
            ?>
            <li>
                <label for="pageids">Allowed Pages:</label>
                <select class="chosen" name="pageids[]" multiple="multiple">
                    <?php
                    $activePages = $user->activePages()->get();
                    foreach (Page::get() as $page) {
                        echo '<option value="' . $page->id . '" ';
                        if ($activePages->contains("id", $page->id)) {
                            echo ' selected="selected" ';
                        }
                        echo '>' . $page->title . '</option>';
                    } ?>
                </select>
            </li>
            <?php
        }
        printAdminSubmitCancelRow();
    ?>
    </ul>
</form>

<?php insertInclude("userlog", $obj->log); ?>