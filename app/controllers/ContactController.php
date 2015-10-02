<?php
use PrimeTwo\Framework\Debug;
use PrimeTwo\Http\Input;
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

    public function edit($contactId = null) {
        //TODO: add $contactId or $contactName to the view.
        View::render('contactForm');

        echo '<br/><hr/>';
        Debug::d($contactId);
        return 'Hi from edit@ContactController';
    }

    public function update($contactId = null) {
        if(empty($contactId)) {
            if(empty(Input::get('id'))) {
                return false;
            }
            $contactId = Input::get('id');
        }

        // testing the Input class
        echo "<hr/>";
        echo "Input::all() <br/>";
        Debug::d(Input::all());
        echo "Input::get('someRandomInput') <br/>";
        Debug::d(Input::get('someRandomInput'));
        echo "Input::get('notexisting') <br/>";
        Debug::d(Input::get('notexisting'));
        echo "<hr/>";

        return 'update requested for:'.$contactId;
    }

}