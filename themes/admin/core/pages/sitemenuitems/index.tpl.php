<?php
/** @var TemplateContainer $obj */
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;
use Model\Sitemenu;

/** @var Sitemenu\SitemenuItem[] $redirects */
$sitemenus = $obj->sitemenuitems;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Site Menu Item</a>
    <a href="/admin/sitemenus" class="btn btm-margin floatr">Manage Sitemenus</a>
</p>
<style type="text/css">
    .strong {font-weight: bold;
        font-size: 14px;}
</style>
<table cellspacing="0" cellpadding="0" class="datagrid" style="font-size: 11px;">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name", "key"); ?></th>
        <th><?php printAdminHeader("Value"); ?></th>
        <th>Controls</th>
        <th>Order</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($sitemenus) > 0) { ?>
        <?php

        // first get root sitemeus
        $sitemenusByParentId = [];
        /** @var Sitemenu $s */
        foreach($sitemenus as $s){
            if(!array_key_exists($s->parent_id, $sitemenusByParentId)) $sitemenusByParentId[$s->parent_id] = [];
            $sitemenusByParentId[$s->parent_id][] = $s;
        }


        /**
         * @param $sitemenusByParentId
         * @param $key
         * @param int $level
         */
        function printChildren(&$sitemenusByParentId, $key, $level = 0) {
            if(!array_key_exists($key, $sitemenusByParentId)) return;
            $thisLevelSitemenus = $sitemenusByParentId[$key];
            //dump($thisLevelSitemenus);
            /** @var Sitemenu\SitemenuItem $s */
            foreach($thisLevelSitemenus as $s){ ?>
                <tr>
                    <td><?php for($i = 0; $i < $level; $i++){
                            echo '&nbsp;&nbsp;&nbsp;';
                        }?>

                        <?php
                        if($s->locked) echo ' <i class="fa fa-lock"></i> ';
                        echo $s->title; ?></td>
                    <td><a target="_blank" href="<?php echo $s->getUrl(); ?>"><?php echo Util::chopUrl($s->getUrl(), 50); ?></a></td>
                    <td>
                        <?php if(Auth::isSuperAdmin() || !$s->locked){ ?>
                            <a href="/admin/sitemenuitems/edit/<?php echo $s->id; ?>" class="button">Edit</a>
                            <a href="/admin/sitemenuitems/delete/<?php echo $s->id; ?>" class="button">Delete</a>
                        <?php } ?>
                        <?php if(Auth::isSuperAdmin()){ ?>
                            <a href="/admin/sitemenuitems/lock/<?php echo $s->id; ?>" class="button">
                                <?php
                                echo ($s->locked) ?
                                    "<i class='fa fa-unlock'></i> Unlock" :
                                    "<i class='fa fa-lock'></i> Lock";
                                ?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <form action="/admin/sitemenuitems/order/<?php echo $s->id; ?>">
                            <select style="padding: 0 10px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                                <?php for($i = 1; $i <= count($thisLevelSitemenus); $i++){
                                    echo '<option '. ($s->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                                } ?>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php
                printChildren($sitemenusByParentId, $s->id, $level+1);
            }
        }


        printChildren($sitemenusByParentId, 0);
    } else { ?>
        <tr>
            <td colspan="5">
                No menu items present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


