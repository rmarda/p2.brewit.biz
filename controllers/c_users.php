<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();

    }


    public function signup($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

        # Pass data to the view
        $this->template->content->error = $error;

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array( '/css/style_signup.css' );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Render template
        echo $this->template;

    }

    public function p_signup() {

        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        foreach( $_POST as $key => $value )
        {
            if( empty( $value ) )
            {
                //this should be an error.
                Router::redirect("/users/signup/errorEmptyField");
            }
        }

        //lookup database if an account with this email already exists. If yes, report error.

        $email = $_POST['email'];
        $q = 'SELECT first_name FROM users WHERE email = "'.$email.'" ';
        $username = DB::instance(DB_NAME)->select_field($q);
        if($username) {
            //this should be an error.
            Router::redirect("/users/signup/errorDupEmail");
        }

        $_POST['created'] = Time::now();
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        DB::instance(DB_NAME)->insert_row('users', $_POST);

        // Now that the user has registered successfully, log them in as well
        $this->loginHelper($_POST);
    }

    public function p_login() {
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $this->loginHelper($_POST);
    }

    /* This is a utility method for logging in. To be used only
     * by class methods, hence private.
     */
    private function loginHelper($inputArr)
    {
        $q = 'SELECT token FROM users WHERE email = "'.$inputArr['email'].'" AND password = "'.$inputArr['password'].'"';
        $token = DB::instance(DB_NAME)->select_field($q);
        if($token) {
            setcookie('token', $token, strtotime('+1 year'), '/');

            // set last login time
            $data = Array("last_login" => Time::now());
            DB::instance(DB_NAME)->update("users", $data, 'WHERE email = "'.$inputArr['email'].'"' );

            Router::redirect('/users/profile');
        }
        else {
            Router::redirect("/index/index/error");
        }
    }

    public function logout() {

        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
        $data = Array('token'=>$new_token);
        DB::instance(DB_NAME)->update('users', $data, 'WHERE user_id ='. $this->user->user_id);
        setcookie('token', '', strtotime('-1 year'), '/');
        Router::redirect('/');
    }

    public function profile($user_name = NULL)
    {
        if(!$this->user)
        {
            Router::redirect('/index');
        }

        # give a title to the view page
        $this->template->title = "Profile";

        # create an instance of my custom view
        $view = View::instance('v_users_profile');

        # inject the view in master template
        $this->template->content = $view;
        $this->template->content->user_name = $user_name;

        echo $this->template;
    }

} # end of the class
