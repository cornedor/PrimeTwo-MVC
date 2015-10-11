<?php
/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 10/8/15
 * Time: 1:53 PM
 */

use PrimeTwo\Framework\Boot;
use PrimeTwo\Framework\FormValidation;
use PrimeTwo\Http\Input;
use PrimeTwo\Http\Session;
use PrimeTwo\Resources\Controller;
use PrimeTwo\Framework\Debug;

class HomeController extends Controller
{
	private $appConfig;

    /**
     * Start the HomeController, get the application configuration and set the View layout/template
     */
    public function __construct() {
        $appConfig = Boot::$configuration->get('app');
        $this->appConfig = $appConfig;
        View::layout('layouts.main', compact('appConfig'));
    }

    /**
     * Render the homepage view.
     */
    public function index() {
    	View::render('home.index', ['title' => 'Homepage']);
    }

    /**
     * Render the contact view. Also check $_SESSION['alert'] to see if there is any alert info to show the user.
     * @param string|bool|false $status
     * @param mixed|bool|false $message
     */
    public function contact($status = false, $message = false) {
        if(Session::get('alert')) {
            $alert = Session::get('alert');
            Session::removeKey('alert');
        } else {
            $alert = ['status' => $status, 'message' => $message];
        }

        View::render('contact.form', ['title' => 'Contact','alert' => $alert]);
    }

    /**
     * Get the PrimeTwo team users and show the About Us view.
     */
    public function about() {
        // TODO: ->where('role', <team_role>)
        $team = User::all();
        $title = "About us";
        $appConfig = $this->appConfig;
        View::render('about.index', compact('title', 'team', 'appConfig'));
    }

    /**
     * Try to send an email using form submitted user input from the contact page.
     * This method always uses the php header() function to redirect.
     * Leaves info about the attempt in the $_SESSION['alert'] variable.
     */
    public function sendContactMail() {
        $inputs = Input::all();
        $appConfig = $this->appConfig;

        // validate inputs
        // TODO: extra secure maken door userinputdata niet als key te zetten (misschien is het anders mogelijk om geheugen te overflowen)
        $test = [
            $inputs['name'] => ['required', 'name'],
            $inputs['email'] => ['required', 'email'],
            $inputs['phone'] => ['required', 'tel'],
            $inputs['message'] => ['required']
        ];
        $valid = FormValidation::validate($test);

        // if valid == send mail
        if($valid === true) {
            $message = View::render('contact.mail', ['inputs' => $inputs], true);
            $mail = mail($appConfig['email'], 'New contact form from your application: '.$appConfig['name'], $message);
        } else {
            // not valid, redirect with warning in the session
            Session::set('alert', ['status' => "warning", 'message' => $valid]);
            header('Location: '.$appConfig['url'].'/contact'); die();
        }

        // redirect to contact
        if(isset($mail) && $mail === true) {
            // debug the message
            // echo $message; die();
            Session::set('alert', ['status' => "sucess", 'message' => "A message was successfully sent. Expect us to reply within 48 hours. Don't forget to check your spam box."]);
        } else {
            Session::set('alert', ['status' => "warning", 'message' => "Your message could not be send, please try again in a couple of minutes. If problems persist please let us know by mailing to info@primetwo.nl"]);
        }

        header('Location: '.$appConfig['url'].'/contact'); die();
    }

    /**
     * Get the Documentation rules and render the view.
     */
    public function documentation() {
        $docs = Docs::all();
        $title = "Documentation";
        View::render('docs.index', compact('docs', 'title'));
    }


}