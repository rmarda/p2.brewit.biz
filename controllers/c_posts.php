<?php

class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        # Make sure user is logged in else show them the home page
        if(!$this->user) {
            die("Members only.Please register or login at: <a href='/index'>Login</a>");
        }
    }

    public function add() {

        $this->template->content = View::instance("v_posts_add");
        $this->template->title = "New Post";
        echo $this->template;

    }

    public function p_add() {

        # Associate this post with the logged in user
        $_POST['user_id'] = $this->user->user_id;

        # Unix timestamp when this post was created/modified

        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert

        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Feedback
        echo "Your post has been added. <a href='/posts/add'> Add Another</a>";

    }

    public function index() {

        # Set up the view
        $this->template->content = View::instance('v_posts_index');
        $this->template->title = "Posts";

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array( '/css/style_posts.css' );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Build the query
        $q = 'SELECT
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts
        INNER JOIN users_users
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;

        # Run the query
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        # Render the View
        echo $this->template;

    }

    public function users() {

        $this->template->content = View::instance("v_posts_users");
        $this->template->title = "Users";

        # Build query to get all users.
        $q = 'SELECT * FROM users';

        # Execute query to get all users.
        $users = DB::instance(DB_NAME)->select_rows($q);

        # Who is the logged in user following?
        $q = "SELECT * FROM users_users
                WHERE user_id = ".$this->user->user_id;

        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');


        $this->template->content->users = $users;
        $this->template->content->connections = $connections;

        echo $this->template;

    }

    public function follow($user_id_followed) {

        # Prepare the data array to be inserted
        $data = Array(
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed
        );

        # Do the insert
        DB::instance(DB_NAME)->insert('users_users', $data);

        # Send them back
        Router::redirect("/posts/users");

    }

    public function unfollow($user_id_followed) {

        # Delete this connection
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users_users', $where_condition);

        # Send them back
        Router::redirect("/posts/users");

    }

}