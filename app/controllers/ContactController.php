<?php
use PrimeTwo\Framework\Debug;
use PrimeTwo\Http\Input;
use PrimeTwo\Resources\Controller;

/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 9/30/15
 * Time: 4:38 PM
 */
class ContactController extends Controller
{

    public function index() {

        $string =  'index@ContactController says: contacts overview could be placed here';
        View::render('contact.index', compact('string'));

    }

    public function edit($contactId = null) {
        //TODO: add $contactId or $contactName to the view.
        View::render('contact.form');

        echo '<br/><hr/>';
        Debug::d($contactId);
    }

    public function update($contactId = null) {
        $idCorrect = true;
        $all = Input::all();

        if(empty($contactId))
            $idCorrect = false;

        return View::render('contact.update', compact('idCorrect','contactId','all'));
    }

}