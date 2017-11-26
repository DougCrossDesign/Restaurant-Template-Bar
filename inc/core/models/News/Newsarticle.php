<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model\News;

use BaseModel;
use Input;

/**
 * Class Redirect
 *
 * @package Model
 * @property string title
 * @property int date
 * @property string description
 * @property string summary
 * @property string image
 * @property string imagealt
 *
 */
class Newsarticle extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_newsarticles";

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
        'date' => [0, "Please enter a date for this event"],
        'description' => ['', 'Please enter a description.'],
        'summary' => ['', 'Please enter a summary of the description.'],
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
        'date',
        'description',
        'summary',
        'image',
        'imagealt'
    ];

    public function setValues($attributes){
        parent::setValues($attributes);

        if($this->id) $this->handleMeta();
    }

    protected function handleMeta(){
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
                }
                if(strlen($link)) {
                    $image = $this->videos()->create([
                        "link"     => \Util::getParsedYoutubeId($link),
                        "event_id" => $this->id
                    ]);
                    $image->save();
                }

                $i++;
            }
        }
    }

    public function setCustomValues(){
    }

    protected $imageFields = ['image'];

    public function castForDatabase(){
        if(!isset($this->rawInput) || $this->rawInput == false) {
            $this->date = is_numeric($this->date) ? $this->date : strtotime($this->date);
        }
    }

    public function postCreate(){
        $this->date = date("m/d/Y", $this->date);
        $this->handleMeta();
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
    public $friendlyURLController = "announcements";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "news";


    public function videos(){
        return $this->hasMany("\Model\News\Newsvideo", "news_id", "id");
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