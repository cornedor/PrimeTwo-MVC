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
use PrimeTwo\Resources\Controller;
use PrimeTwo\Framework\Debug;

class HomeController extends Controller
{
	private $appConfig;

    public function __construct() {
        $appConfig = Boot::$configuration->get('app');
        $this->appConfig = $appConfig;
        View::layout('layouts.main', compact('appConfig'));
    }

    public function index() {
    	View::render('home.index', ['title' => 'Homepage']);
    }

    public function contact($status = false, $message = false) {
        if(isset($_SESSION['alert'])) {
            $alert = $_SESSION['alert'];
            unset($_SESSION['alert']);
        } else {
            $alert = ['status' => $status, 'message' => $message];
        }

        View::render('contact.form', ['title' => 'Contact','alert' => $alert]);
    }

    public function about() {
        // TODO: ->where('role', <team_role>)
        $team = User::all();
        $title = "About us";
        $appConfig = $this->appConfig;
        View::render('about.index', compact('title', 'team', 'appConfig'));
    }

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
            $_SESSION['alert']['status'] = "warning";
            $_SESSION['alert']['message'] = $valid;
            header('Location: '.$appConfig['url'].'/contact'); die();
        }

    	// redirect to contact
        if(isset($mail) && $mail === true) {
        	// debug the message
        	// echo $message; die();
            $_SESSION['alert']['status'] = "success";
            $_SESSION['alert']['message'] = "A message was successfully sent. Expect us to reply within 48 hours. Don't forget to check your spam box.";
        } else {
            $_SESSION['alert']['status'] = "warning";
            $_SESSION['alert']['message'] = "Your message could not be send, please try again in a couple of minutes. If problems persist please let us know by mailing to info@primetwo.nl";

        }

        header('Location: '.$appConfig['url'].'/contact'); die();
    }

    public function documentation() {
        $docs = Docs::all();
        $title = "Documentation";
        View::render('docs.index', compact('docs', 'title'));
    }


}