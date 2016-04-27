<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function getCreate()
    {
	    return View::make('user.signup');
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function postIndex()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());
		
        if ($user->id) {
            if (Config::get('confide::signup_email')) {

	            Mailgun::send(
		            Config::get('confide::email_account_confirmation'),
		            compact('user'),
		            function($message) use ($user) {
		                $message
			                ->to($user->email, $user->username)
			                ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
	                });
            }

	        $pid = DB::connection("public")->select(DB::raw("SELECT nextval('person_seq')"));

	        $p = new Person;
	        $p->id = $pid[0]->nextval;
			$p->name_first = $user->username;
			$p->date_birth = Carbon\Carbon::now();
			$p->gender = $user->gender;
	        $p->save();

	        $id = $p->id;
	        $user->person_id = $id;
			
	        $user->save();
			
			
			$rc = DB::connection("public")->select(DB::raw("select id, max(local_likes) as t from content where title like '%diabetes%' group by id order by (t) desc limit 1"));
			$recommendation = new Recommendation;
			$recommendation->datecreation = \Carbon\Carbon::now();
			$recommendation->id_person = $user->person_id;
			$recommendation->id_content = $rc[0]->id;
			$recommendation->visited = false;
			$recommendation->evaluation = false;
			
			$recommendation->save();
			
			
			$rc = DB::connection("public")->select(DB::raw("select id, max(local_likes) as t from content where title like '%Esclerose%' or title like '%ELA%' group by id order by t desc limit 1"));
			$recommendation = new Recommendation;			
			$recommendation->datecreation = \Carbon\Carbon::now();
			$recommendation->id_person = $user->person_id;
			$recommendation->id_content = $rc[0]->id;
			$recommendation->visited = false;
			$recommendation->evaluation = false;
			
			$recommendation->save();
			
			
			$rc = DB::connection("public")->select(DB::raw("select id, max(local_likes) as t from content group by id order by (t) desc limit 1"));
			$recommendation = new Recommendation;		
			$recommendation->datecreation = \Carbon\Carbon::now();
			$recommendation->id_person = $user->person_id;
			$recommendation->id_content = $rc[0]->id;
			$recommendation->visited = false;
			$recommendation->evaluation = false;
			
			$recommendation->save();

            return Redirect::action('UsersController@postLogin')
							->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            $error = $user->errors()->all(':message');

			$a = strcmp($user->type,"true");
			
			if($a >= 0) {
				
				return Redirect::action('SupervisorController@getNovosupervisor')
							->withInput(Input::except('password'))
							->with('error', $error);
				
			} else {
				
				return Redirect::action('UsersController@getCreate')
							->withInput(Input::except('password'))
							->with('error', $error);
			}
			
            
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function getLogin()
    {
        if (Confide::user()) {
            return Redirect::to('/');
        } else {
		    return View::make('user.signin');
        }

    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function postLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {

	        $u = Confide::user();

	        $u->ultimo_acesso = \Carbon\Carbon::now();
			$u->save();

            return Redirect::intended('/');
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@postLogin')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function getConfirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@postLogin')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@postLogin')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function getForgot()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function postForgot()
    {
		
		$this->testemail(Input::get('email'), Input::get('_token'));
		
		/*
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
			
			//return Redirect::action('UsersController@postLogin')
                //->with('notice', $notice_msg);
				
        } else {
		   $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
		   //return Redirect::action('UsersController@postForgot')
              //  ->withInput()
              //  ->with('error', $error_msg);
        }
		*/
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function getReset($token)
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function postForgotpassword()
    {
		
        $repo = App::make('UserRepository');
		
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

		echo $input;
		/*
        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            
			echo "Sim";
			
			$notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@postLogin')
                ->with('notice', $notice_msg);
				
        } else {
			
			echo "Não\n";
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
			echo $error_msg;
            return Redirect::action('UsersController@getReset', array('token'=>$input['token']))
               ->withInput()
               ->with('error', $error_msg);
        }
		*/
	}

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }


	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function listar()
	{
		$users 	= User::all();

		return View::make('user.list', compact('users'));
	}


	public function testemail($email, $token) {

		$data = [
			'token' => $token,
			'email' => $email
		];
	
		Mail::send('emails.auth.reminder',  $data, function($message) use ($data)
		{
			$message->from('mobilehealth.noreplay@gmail.com', 'Mobilehealth');
			$message->to('jerff.pinhocf2345@gmail.com', $data['email'])->subject('Password Reset');
			
		});

		

//		Mail::send('emails.auth.reminder', $data, function($message)
//		{
//			$message->to('mtullyoc@gmail.com', 'Marcos Tullyo')->subject('Welcome!');
//		});

	}
	
	

}
