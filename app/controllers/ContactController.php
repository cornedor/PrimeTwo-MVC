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
        View::render('contact.indextest', compact('string'));

    }

    public function edit($contactId = null) {
        // TODO: fix Input::all(), throw error when empty
        Input::all();
        die();
        if(empty($contactId)) {
            if(empty(Input::get('id'))) {
                // TODO: adding a redirect is probably better.
                throw new Exception('$contactId was not found or empty.');
            }
            $contactId = Input::get('id');
        }

        $string = '<br/><hr/>Hi from edit@ContactController';

        View::render('contact.form', compact('contactId', 'string'));

        //Debug::d($contactId);
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