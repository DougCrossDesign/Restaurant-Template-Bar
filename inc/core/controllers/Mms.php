<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 1/7/2016
 * Time: 6:07 PM
 */

namespace Controller;


use Model\Adbanner;
use Model\AdbannerGroup;

class Mms extends BaseController
{
    public function index(){

    }
    public function visit($id){
        /** @var Adbanner $ad */
        $ad = Adbanner::getById($id);
        $ad->clicks()->create([
            'adbanner_id' => $id,
            'time' => time(),
            'ip' => static::getIpAddress()
        ]);

        $this->redirect($ad->url);
    }

    public function refresh(){
        header("Content-type: text/json");
        //$data = json_decode($_POST);
        $data = json_decode(file_get_contents('php://input'));
        $output = [];
        foreach($data as $slot){
            $id = $slot->id;
            $position = $slot->position;
            $url = $slot->url;
            $urlparts = explode("/", $url);
            $bannerid = (int) end($urlparts);

            /** @var AdbannerGroup $group */
            $group = AdbannerGroup::getById($position);
            $banners = $group->adbanners()->where("cms_core_module_ad_banners.id", "!=", $bannerid)->where("start_date", "<", time())->where("end_date", ">", time());
            if($banners->count()){
                /** @var Adbanner $banner */
                $banner = $banners->get()->random();
                $output[] = [
                    "id" => $id,
                    "url" => $banner->getUrl(),
                    "image" => $banner->image,
                    'newwindow' => $banner->newwindow
                ];
            } else {
                $banners = $group->adbanners()->where("start_date", "<", time())->where("end_date", ">", time());
                if($banners->count()){
                    /** @var Adbanner $banner */
                    $banner = $banners->get()->random();
                    $output[] = [
                        "id" => $id,
                        "url" => $banner->getUrl(),
                        "image" => $banner->image,
                        'newwindow' => $banner->newwindow
                    ];
                }
            }
        }
        die(json_encode($output));
    }
    public static function getIpAddress(){
        return getenv('HTTP_CLIENT_IP')?:
            getenv('HTTP_X_FORWARDED_FOR')?:
                getenv('HTTP_X_FORWARDED')?:
                    getenv('HTTP_FORWARDED_FOR')?:
                        getenv('HTTP_FORWARDED')?:
                            getenv('REMOTE_ADDR');
    }
}