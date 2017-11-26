<?php
/** @var TemplateContainer $obj */
use Model\FriendlyUrl;
use Model\Jobposition;

/** @var \Model\SitemapModel[] $sitemapmodels */
$sitemapmodels = $obj->sitemapmodels;

/** @var \Model\Sitemap\SitemapPage[] $sitemappages */
$sitemappages = $obj->sitemappages;

$installedModels = $obj->installedModels;

/** @var \Model\Pages\Page[] $pages */
$pages = \Model\Pages\Page::getDropdownValues();

/** @var string $add_link */
$add_link = $obj->add_link;
$add_sitemap_page_link = $obj->add_sitemap_page_link;
?>
<li class="col">
    <h2 class="admin-header">Pages</h2>
</li>
    <a href="<?php echo $add_sitemap_page_link; ?>" class="btn btm-margin floatr">Add Page To Sitemap</a>
    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Page Name</th>
            <th>Url</th>
            <th>Display Order</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($sitemappages) > 0) { ?>
            <?php
            /** @var \Model\Sitemap\SitemapPage $sitemappage */
            foreach ($sitemappages as $sitemappage) { ?>
                <tr>
                    <td><?php echo $sitemappage->name; ?></td>
                    <td><?php echo $sitemappage->page->getFriendlyUrl() ? '<a href="'.$sitemappage->page->getFriendlyUrl().'" target="_blank">'.$sitemappage->page->getFriendlyUrl().'</a>' : 'Pages without a set Friendly Url will not appear in the sitemap.<br/> Please <a href="/admin/pages/edit/'.$sitemappage->page->id.'">Set Friendly Url</a>'; ?></td>
                    <td><?php printAdminOrderColumn($sitemappage, count($sitemappages), "sitemap", "displayorder", "orderPages"); // TODO: Fix this controller ?></td>
                    <td>
                        <a href="/admin/sitemap/editPage/<?php echo $sitemappage->id; ?>" class="button">Edit</a>
                        <a href="/admin/sitemap/deletePage/<?php echo $sitemappage->id; ?>" class="button">Delete</a>
                        <a href="/admin/pages/edit/<?php echo $sitemappage->page->id; ?>" class="button">Modify Page</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">
                    No sitemap pages present. <a href="<?php echo $add_sitemap_page_link; ?>">Click here to add one.</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


<hr class="btm-margin">
<li class="col">
    <h2 class="admin-header">Models</h2>
</li>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Model Name</th>
        <th>Nested Under Page</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($sitemapmodels) > 0) { ?>
        <?php
        /** @var \Model\Sitemap\SitemapModel $sitemapmodel */
        foreach ($sitemapmodels as $sitemapmodel) { ?>
            <tr>
                <td><?php echo $sitemapmodel->name; ?></td>
                <td><?php echo $sitemapmodel->page ? $sitemapmodel->page->name : ""; ?></td>
                <td>
                    <a href="/admin/sitemap/edit/<?php echo $sitemapmodel->id; ?>" class="button">Edit</a>
                    <a href="/admin/sitemap/delete/<?php echo $sitemapmodel->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Sitemap models present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>


<?php if (count($installedModels))  { ?>
    <li class="col">
        <h3 class="admin-header">Installed Models</h3>
    </li>

    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Model Name</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /**
         * @var  string $installedModel
         * @var  string $model
         */
        foreach ($installedModels as $installedModel => $model) { ?>
            <tr>
                <td><?php echo $model; ?></td>
                <td>
                    <a href="/admin/sitemap/addNew/<?php echo urlencode($model); ?>" class="button">Update Model Sitemap Settings</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>