<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 1/6/2016
 * Time: 4:57 PM
 */
use Model\FriendlyUrl;
use Model\Sitemenu;

include("inc/cms.php");

$links = [];
$str_baseurl = 'http://' . $_SERVER["HTTP_HOST"];

/** @var Sitemenu $sitemenu */
foreach (Sitemenu::get() as $sitemenu) {
    $url = $sitemenu->getUrl();
    if ($url[0] == '/') {
        $url = $str_baseurl . $url;
        if (!in_array($url, $links)) $links[] = $url;
    }

}

/** @var FriendlyUrl $friendlyUrl */
foreach (FriendlyUrl::getAllActive() as $friendlyUrl) {
    $url = $friendlyUrl->friendlyurl;
    if ($url[0] == '/') {
        $url = $str_baseurl . $url;
        if (!in_array($url, $links)) $links[] = $url;
    }

}
header("Content-type: text/xml");
?>

<?php echo '<' . '?xml version="1.0" encoding="UTF-8"?' . '>'; ?>

<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <?php
    foreach ($links as $str_link) {
        ?>
        <url>
            <loc><? echo htmlentities($str_link); ?></loc>
        </url>
    <?php
    }
    ?>
</urlset>