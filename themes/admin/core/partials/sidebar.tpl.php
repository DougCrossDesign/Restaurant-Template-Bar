<?php /** @var TemplateContainer $obj */ ?>

<?php if (count($obj->modules) > 0) { ?>
<ul>
    <?php foreach ($obj->modules as $name => $url) { ?>
    <li><a href="/admin/<?php echo $url; ?>"><?php echo $name; ?></a></li>
    <?php } ?>
</ul>
<?php } ?>

<br />

<a href="/admin/login/logout">Logout</a>