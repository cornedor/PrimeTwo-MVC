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
        //TODO: add $contactId or $contactName to the view. | passing parameters to views.
        View::render('contact.form');

        echo '<br/><hr/>';
        Debug::d($contactId);
        return 'Hi from edit@ContactController';
    }

    public function update($contactId = null) {
        // if empty? geeft Can't use function return value in write context TODO fix dit
        // TODO: dit even met zijn 2en testen
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