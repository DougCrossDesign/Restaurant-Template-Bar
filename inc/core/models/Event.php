<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model;
use Illuminate\Database\Capsule\Manager as DB;

use BaseModel;
use Input;

/**
 * Class Redirect
 *
 * @package Model
 * @property string title
 * @property bool active
 * @property int unique_id
 * @property int  date
 * @property int time
 * @property int event_type_id
 * @property string description
 * @property string summary
 * @property string ticket_link
 * @property bool luxury_suite
 * @property bool group_event
 * @property bool featured
 * @property string amazon_map
 * @property int seating_chart
 * @property string image_listing
 * @property string image_details
 * @property string image_interested
 * @property string imagealt
 *
 */
class Event extends BaseModel
{

    const IMPORT_URL = 'https://us1.eventbooking.com/EventListXml.ashx?wl=BC.1F688985';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_events";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'title' => ['', "Please enter the event title"],
        'event_type_id' => [0, 'Please choose an event type'],
        'date' => [0, "Please enter a date for this event"],
        'time' => 0,
        'description' => ['', 'Please enter a description.'],
        'summary' => ['', 'Please enter a summary of the description.'],
        'ticket_link' => '',
        'luxury_suite' => 0,
        'group_event' => 0,
        'featured' => 0,
        'amazon_map' => '',
        'seating_chart' => 0,
        'image' => ['', 'Please choose an image.'],
        'imagealt' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'event_type_id',
        'date',
        'time',
        'description',
        'summary',
        'ticket_link',
        'luxury_suite',
        'group_event',
        'featured',
        'amazon_map',
        'seating_chart',
        'image',
        'imagealt'
    ];

    public function setValues($attributes){
        parent::setValues($attributes);

        if($this->id) $this->handleButtons();
    }

    protected function handleButtons(){
        // handle buttons
        if(\Input::post("button_link")){
            /** @var Eventbutton $button */
            foreach($this->buttons()->getResults() as $button){
                $button->delete();
            }

            $i = 0;
            foreach(\Input::post("button_link") as $link){
                if(Input::post("button_delete")[$i]){
                    $i++;
                    continue;
                }
                $label = \Input::post("button_label")[$i];

                if(strlen($label)) {
                    $newWindow = \Input::post("button_new_window")[$i] ?: 0;
                    if (!\Util::isValidUrl($link)) {
                        $this->errors['button' . $i] = "Please enter a valid URL.";
                    }

                    if (strlen($link) || strlen($label)) {
                        $image = $this->buttons()->create([
                            "label"      => $label,
                            "link"       => $link,
                            "event_id"   => $this->id,
                            "new_window" => $newWindow
                        ]);
                        $image->save();
                    }
                }

                $i++;
            }
        }

        // handle videos
        if(\Input::post("video_link")){

            foreach($this->videos()->getResults() as $video){
                $video->delete();
            }

            $i = 0;
            foreach(\Input::post("video_link") as $link){
                if(isset($_POST['video_delete'][$i]) && Input::post("video_delete")[$i]){
                    $i++;
                    continue;
                } else {
                    $image = Input::post("video_image")[$i];
                }
                if(strlen($link) || strlen($image)) {
                    $image = $this->videos()->create([
                        "image"    => $image,
                        "link"     => \Util::getParsedYoutubeId($link),
                        "event_id" => $this->id
                    ]);
                    $image->save();
                }

                $i++;
            }
        }

        // handle showtimes
        if(Input::post("showtime_date")){
            /** @var Eventshowtime $showTime */
            foreach($this->showtimes()->getResults() as $showTime){
                $showTime->delete();
            }

            $i = 0;
            foreach(Input::post("showtime_date") as $date){
                if(Input::post("showtime_delete")[$i] == 1) continue;
                $time = Input::post("showtime_time")[$i];
                $ticket_link = Input::post("showtime_link")[$i];

                if(!\Util::isValidUrl($ticket_link)){
                    $this->errors['showtime' . $i] = "Please enter a valid ticket URL.";
                }

                $showTime = $this->showtimes()->create([
                    "date" => strtotime($date),
                    "ticket_link" => $ticket_link,
                    "time" => strtotime($time),
                    "event_id" => $this->id
                ]);
                $showTime->save();

                $i++;
            }
        }
    }

    public function setCustomValues(){
        $this->luxury_suite = Input::post("luxury_suite") ?: 0;
        $this->group_event = Input::post("group_event") ?: 0;
        $this->featured = Input::post("featured") ?: 0;
        $this->active = Input::post("active") ?: 0;
    }

    protected $imageFields = ['image', 'video_image'];

    public function castForDatabase(){
        if(!isset($this->rawInput) || $this->rawInput == false) {
            $this->date = is_numeric($this->date) ? $this->date : strtotime($this->date);
            $this->time = is_numeric($this->time) ? $this->time : strtotime($this->time);
        }
    }

    public function postCreate(){
        $this->date = date("m/d/Y", $this->date);
        $this->handleButtons();
    }

    public function getDayOfWeek(){
        return date("D", $this->date);
    }
    public function getMonth(){
        return date("M", $this->date);
    }
    public function getDay(){
        return date("d", $this->date);
    }
    public function getTime(){
        return date("g:i A", $this->time);
    }
    public function getFullDate(){
        return date("l M jS, ", $this->date) . $this->getTime();
    }

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = true;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "events";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "events";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buttons(){
        return $this->hasMany("\Model\Eventbutton", "event_id", "id");
    }

    public function videos(){
        return $this->hasMany("\Model\Eventvideo", "event_id", "id");
    }

    public function showtimes(){
        return $this->hasMany("\Model\Eventshowtime", "event_id", "id");
    }
    public function getShowTimes(){
        if($this->hasShowtimes()){
            return $this->showtimes()->orderBy("date", 'asc')->orderBy("time", "asc")->get();
        } else {
            return [];
        }
    }
    public function hasShowtimes(){
        return $this->showtimes()->getResults()->count() > 0;
    }
    public function getShowtimesDateSpan(){
        if($this->hasShowtimes()){
            $showTimes = $this->getShowTimes();
            $firstShowTime = $this->showtimes()->orderBy("date", 'asc')->orderBy("time", "asc")->first();
            $lastShowTime = $this->showtimes()->orderBy("date", 'desc')->orderBy("time", "desc")->first();

            return 'Showtimes: ' . date("D M d", $firstShowTime->date) . ' - ' . date("D M d", $lastShowTime->date);
        }
    }

    public static function getByTypeId($id, $limit = 4){
        return static::where("event_type_id", "=", $id)->where("date", ">", time())->limit($limit)->get();
    }

    public static function getByUniqueId($uniqueId){
        return static::where("unique_id", "=", $uniqueId);
    }


    public function save(array $options = []){
        parent::save($options);
        $this->finishSave($options);
    }

    protected function finishSave(array $options){
        parent::finishSave($options);
    }


    /**
     * Perform any processing necessary after this record's data has been
     * committed to the database. There is no way to abort or cancel the
     * commit at this point.
     */
    public function postSave() {
        if($this->usesFriendlyURLs){
            $friendlyUrlBase = in_array(Input::post("friendlyurl"), ['']) ? $this->{$this->friendlyURLDeriveFrom} : Input::post("friendlyurl");
            $friendUrlFront = "/".$this->friendlyURLController."/";
            $friendlyUrlToUse = str_replace($friendUrlFront,"",$friendlyUrlBase);
            $friendlyUrlToUse = $friendUrlFront . $friendlyUrlToUse;
            $route = implode("/", array($this->friendlyURLController, $this->friendlyURLMethod, $this->{$this->friendlyURLID}));
            FriendlyUrl::addOrIgnore($route, $friendlyUrlToUse, $this->friendlyURLController);
        }
    }


    public static function import(){
        $rawxml = file_get_contents(static::IMPORT_URL);
        $xml = simplexml_load_string($rawxml);
        //die(dump($xml));
        foreach($xml->public_events->event as $event){
            // event meta
            $event_name = (string) $event->event_name;
            $unique_event_id = (int) $event->unique_event_id;

            // dates
            $start_date = static::checkDate((string) $event->date_range->start_date);
            $start_time = (string) $event->date_range->start_time;
            $end_date = (string) $event->date_range->end_date;
            $end_time = (string) $event->date_range->end_time;

            // show time time
            $show_time_start_time = strval(($event->showtimes->subevent->count()) ? $event->showtimes->subevent->attributes()['starttime'] : 0);

            // descriptions
            $description = (string) $event->description;
            $additional_info = (string) $event->additional_info;
            $ticket_info = (string) $event->ticket_info;

            // ticket
            $ticket_link = (string) $event->TI;

            //=========
            // 1. check if we have an event with this unique id
                $query = Event::getByUniqueId($unique_event_id);
                $numEvents = $query->count();
                if($numEvents){
                    // if YES
                    // update times
                    /** @var Event $thisEvent */
                    $thisEvent = $query->first();
                        $eventname = $thisEvent->title;
                        $thisEvent->date = (int) strtotime($start_date);
                        $thisEvent->time = (int) strtotime($show_time_start_time ?: $start_time);
                        $thisEvent->skipValidation = true;
                        $thisEvent->rawInput == true;
                    $thisEvent->save();

                    echo '----- Updated Existing Event: ' . $event_name . ' date: '. strtotime($start_date)  .' time:'. strtotime($show_time_start_time ?: $start_time). '<br />';
                } else {
                    // if NO
                    // add new event with this info and inactive (one for each showtime)
                    /** @var Event $thisEvent */
                    $thisEvent = new Event();
                        $thisEvent->title = $event_name;
                        $thisEvent->unique_id = $unique_event_id;
                        $thisEvent->created_at = time();
                        $thisEvent->updated_at = time();
                        $thisEvent->event_type_id = 1;
                        $thisEvent->description = $description;
                        $thisEvent->summary = static::generateSummary($description);
                        $thisEvent->date = $start_date;
                        $thisEvent->time = strtotime($show_time_start_time ?: $start_time);
                        $thisEvent->active = 0;
                        $thisEvent->ticket_link = $ticket_link;
                        $thisEvent->luxury_suite = 0;
                        $thisEvent->group_event = 0;
                        $thisEvent->featured = 0;
                        $thisEvent->video_image = '';
                        $thisEvent->video_link = '';
                        $thisEvent->amazon_map = '';
                        $thisEvent->seating_chart = 0;
                        $thisEvent->image_details = '';
                        $thisEvent->image_listing = '';
                        $thisEvent->image_interested = '';
                        $thisEvent->skipValidation = true;
                        $thisEvent->rawInput == true;
                    $thisEvent->save();

                    echo '===== ADDED NEW EVENT: ' . $event_name . '<br />';
                }
        }
        echo '<a href="/admin/events">Back</a>';
        die();
    }
    public static function checkDate($str_date){
        $parts = explode("-", $str_date);
        $daynum = end($parts);
        if(strlen($daynum) == 1) $parts[count($parts) - 1] = '0' . $daynum;
        return implode("-", $parts);
    }
    public static function generateSummary($desc){
        $substr = substr($desc, 0, 106);
        $parts = explode(" ", $substr);
        array_pop($parts);
        return implode(" ", $parts);
    }

    public function getIconClass(){
        $eventType = Eventtype::getById($this->event_type_id);
        $return = $eventType ? $eventType->icon : '';
        return $return;
    }

    public static function search($term){
        $results = config()->getConnection()->select(
            "select * from cms_core_module_events where active = 1 and date > :now and ((title like :term1) OR (description like :term2))",
            ["now" => time(), "term1" => "%$term%", "term2" => "%$term%"]
        );
        $output = array();
        foreach($results as $result){
            $output[] = Event::getById($result->id);
        }
        return $output;
    }
}