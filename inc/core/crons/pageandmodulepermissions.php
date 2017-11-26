<?php
use Model\FriendlyUrl;
use Model\Pages\Page;
use Model\Pages\PageGroupPermission;
use Model\User;
use Model\UserModulePermission;

include('../../cms.php');

$ROUTE_MODELS = [
"employment" => "\Model\Jobposition",
"events" => "\Model\Event",
"news" => "\Model\News\Newsarticle",
"page" => "\Model\Pages\Page",
];

$db = config()->getConnection();


// check module permissions
$modulePermissions = UserModulePermission::get();
echo '<h3>1. Checking that User-to-Module permissions all exist</h3>';
echo 'Found ' . $modulePermissions->count() . ' permissions... <br>';
echo '<table><th>User ID</th><th>Module</th><th>Status</th>';
/** @var UserModulePermission $modulePermission */
foreach($modulePermissions as $modulePermission){
    echo '<tr><td>'. $modulePermission->userid .'</td><td>' . $modulePermission->module . '</td><td>';
    $delete = false;
    echo 'user...';
    if(!User::exists($modulePermission->userid)){
        echo 'MISSING';
        $delete = true;
    } else {
        echo 'ok';
    }
    echo '...module...';
    if(!Module::exists($modulePermission->module)){
        echo 'MISSING';
        $delete = true;
    } else {
        echo 'ok';
    }
    if($delete){
        $modulePermission->delete();
        echo '...DELETED';
    }
    echo '</td></tr>';
}
echo '</table>';


// check page permissions
$result = $db->table("cms_core_module_users_pages")->get(["id","userid","pageid"]);
echo '<h3>1. Checking that User-to-Page permissions all exist</h3>';
echo 'Found ' . count($result) . ' permissions... <br>';
echo '<table><th>User ID</th><th>Page</th><th>Status</th>';
foreach($result as $row){
    echo '<tr><td>'. $row->userid .'</td><td>' . $row->pageid . '</td><td>';
    $delete = false;
    echo 'user...';
    if(!User::exists($row->userid)){
        echo 'MISSING';
        $delete = true;
    } else {
        echo 'ok';
    }
    echo '...page...';
    if(!Page::exists($row->pageid)){
        echo 'MISSING';
        $delete = true;
    } else {
        echo 'ok';
    }
    if($delete){
        $db->table("cms_core_module_users_pages")->delete($row->id);
        echo '...DELETED';
    }
    echo '</td></tr>';
}
echo '</table>';

// check group to page permissions
$pageGroupPermissions = PageGroupPermission::get();
echo '<h3>3. Checking that Group-to-Page permissions all exist</h3>';
echo 'Found ' . $pageGroupPermissions->count() . ' permissions... <br>';
echo '<table><th>Group ID</th><th>Page ID</th><th>Status</th>';
/** @var PageGroupPermission $pageGroupPermission */
foreach($pageGroupPermissions as $pageGroupPermission){
    echo '<tr><td>'. User::getUserLevelName($pageGroupPermission->groupid) .' ('. $pageGroupPermission->groupid .')</td><td>' . $pageGroupPermission->pageid . '</td><td>';
    $delete = false;
    echo 'group...';
    if(!in_array($pageGroupPermission->groupid, User::TYPES())){
        echo 'MISSING';
        $delete = true;
    } else {
        echo 'ok';
    }
    echo '...page...';
    if(!Page::exists($pageGroupPermission->pageid)){
        echo 'MISSING';
        $delete = true;
    } else {
        echo 'ok';
    }
    if($delete){
        $pageGroupPermission->delete();
        echo '...DELETED';
    }
    echo '</td></tr>';
}
echo '</table>';