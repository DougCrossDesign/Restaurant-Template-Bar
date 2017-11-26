<?php /** @var TemplateContainer $obj */ ?>

<?php if (isset($obj->page_title)) { ?>
    <h1><?php echo $obj->page_title; ?></h1>
<?php } ?>

<div>
    <?php if (isset($obj->page_content)) { ?>
        <?php echo $obj->page_content; ?>
    <?php } ?>
</div>