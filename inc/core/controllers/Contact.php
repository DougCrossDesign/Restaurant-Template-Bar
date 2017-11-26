<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/16/2015
 * Time: 4:54 PM
 */

namespace Controller;

use Model\Adbanner;
use Model\EmailAddress;
use Model\EmailList;
use Model\Footersitemenu;
use Model\Metadata;
use Model\Pages\Page;
use Model\Pages\Partial;
use Model\Siteinfo;
use Model\Sitemenu;
use Model\Sponsor;
use \Template;

class Contact extends BaseController
{
    public function index(){
        $template = new Template("pages/contact");

        if (\Input::post("form_submit") == "submit" && !\Util::honeypotUsed()) {
            // now send email
            $emailer = \Emailer::getByListName("Contact Us");
                $emailer->add("Name", "form_name", true);
                $emailer->add("Email Address", "form_email", true);
                $emailer->add("Phone Number", "form_phone", true);
                $emailer->add("Message", "form_message", true);

            // save email
            $email = new EmailAddress();
                $email->full_name = \Input::post("form_name");
                $email->email_address = \Input::post("form_email");
                $email->list_id = EmailList::getByListName("Contact Us")->id;
                $email->content = $emailer->getMessage();
            $email->save();

            // set template errors or thank you msg
            if($emailer->hasErrors()){
                $template->emailErrors = $emailer->printErrors();
            } else {
                $emailer->send();
                $this->redirect("/thank-you");
            }
        }

        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();
        $template->address_street = Siteinfo::getByKey("Address Street");
        $template->address_city = Siteinfo::getByKey("Address City");
        $template->address_state = Siteinfo::getByKey("Address State Abbreviation");
        $template->address_zip = Siteinfo::getByKey("Address Zip");
        $template->phone_number = Siteinfo::getByKey("Phone Number");
        $template->contact_email = Siteinfo::getByKey("Contact Email");

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        /** @var Page $page */
        $page = Page::getById(7);
        $template->partials = $page->getTemplates();
        $template->pagetitle = $page->title;

        $this->show($template);
    }
}