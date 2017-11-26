<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Beer;
use Model\BeerGroup;
use Model\Blog\BlogCategory;
use Model\Blog\BlogPost;

/** @var TemplateContainer $obj */

/** @var BlogPost $post */
$post = $obj->blogpost;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>
<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $post->input("title")->classes("col1-2")->output();
        $post->input("friendlyurl")->classes("col1-2")->friendlyurlPrefix("blog")->output();
        $post->input("date")->type("date")->value($post->date ? date('Y-m-d', $post->date) : '')->output();
        $post->input("author")->output();
        $post->input("content")->type("textarea")->output();
        ?>
        <li class="lbl-hint col btm-margin">
            <label>Categories</label>
            <select class="chosen" name="categories[]" multiple="multiple">
                <?php
                /** @var BlogCategory $blogCategory */
                foreach(BlogCategory::get() as $blogCategory){
                    echo '<option value="' . $blogCategory->id . '" ';
                    if($post->isInCategory($blogCategory->id)) echo ' selected="selected" ';
                    echo '>' . $blogCategory->name . '</option>';
                } ?>
            </select>
        </li>
        <?php
        $post->input("tags")->value($post->getTags())->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>