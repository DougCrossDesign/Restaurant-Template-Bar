<?php /** @var TemplateContainer $obj */ ?>

<?php insertInclude("head",$obj); ?>


<div class="login-box">

<?php if (isset($obj->message)) { ?>
<div><?php echo $obj->message; ?></div>
<?php } ?>

<?php if (isset($obj->errors['message'])) { ?>
    <div><?php echo $obj->errors['message']; ?></div>
<?php } ?>

<form method="POST" action="/admin/login/login" novalidate="novalidate">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off" />
        <?php if (isset($obj->errors['username'])) { ?>
        <div><?php echo $obj->errors['username']; ?></div>
        <?php } ?>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off" />
        <?php if (isset($obj->errors['password'])) { ?>
        <div><?php echo $obj->errors['password']; ?></div>
        <?php } ?>
    </div>
    <div>
        <input type="submit" name="login" value="Login" class="btn" />
    </div>
</form>

</div>

<?php insertInclude("footerclose"); ?>