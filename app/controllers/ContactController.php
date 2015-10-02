<?php
use PrimeTwo\Framework\Debug;
use PrimeTwo\Resources\View;

/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 9/30/15
 * Time: 4:38 PM
 */
class ContactController
{

    public function index() {
        return 'index@ContactController says: contacts overview could be placed here';
    }

    public function edit($contactName = null, $contactId = null) {
        //TODO: add $contactId or $contactName to the view.
        View::render('contactForm');

        echo '<br/><hr/>';
        Debug::d($contactName);
        Debug::d($contactId);
        return 'Hi from edit@ContactController';
    }

    public function update($contactId = null) {
        if(empty($contactId)) {
            if(empty($_POST['id'])) {
                return false;
            }
            $contactId = $_POST['id'];
        }
        Debug::d($_POST);
        return 'update requested for:'.$contactId;
    }

}