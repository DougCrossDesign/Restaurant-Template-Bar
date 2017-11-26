<?php
/** @var TemplateContainer $obj */
use Model\Event;
use Model\Metadata;
use Model\News\Newsarticle;
use Model\Redirect;
use Model\Siteinfo;

/** @var Newsarticle[] $articles */
$articles = $obj->newsarticles;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<p>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Article</a>
</p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Title"); ?></th>
        <th><?php echo printAdminHeader("Date"); ?></th>
        <th>Tags</th>
        <th>URL</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($articles) > 0) { ?>
        <?php
        /** @var Model\News\Newsarticle $article */
        foreach ($articles as $article) { ?>
            <tr>
                <td><?php echo $article->title; ?></td>
                <td><?php echo $article->formatDate('date', false); ?></td>
                <td>
                    <?php
                    $tags = [];
                    /** @var \Model\News\Newstag $tag */
                    foreach ($article->tags as $tag) {
                        $tags[] = "<a href='/resources?tag=".urlencode($tag->name)."' target='_blank'>" . $tag->name . "</a>";
                    }
                    if (count($tags)) {
                        echo implode($tags, " ");
                    } ?>
                </td>
                <td><a href="<?php echo $article->getFriendlyUrl(); ?>" target="_blank"><?php echo $article->getFriendlyUrl(); ?></a></td>
                <td>
                    <a href="/admin/news/edit/<?php echo $article->id; ?>" class="button">Edit</a>
                    <a href="/admin/news/delete/<?php echo $article->id; ?>" class="button">Delete</a>
                    <?php if ($article->supportsMultilingual()) { ?>
                        <a href="/admin/news/translations/<?php echo $article->id; ?>" class="button">Manage Translations (<?php echo $article->translations()->count(); ?>)</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No articles present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


