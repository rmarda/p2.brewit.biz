<?php

class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        # Make sure user is logged in else show them the home page
        if(!$this->user) {
            die("Members only.Please register or login at: <a href='/index'>Login</a>");
        }
    }

    public function add($added = NULL) {

        $this->template->content = View::instance("v_posts_add");
        $this->template->title = "New Post";

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array( '/css/style_posts_add.css' );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Pass data to the view
        $this->template->content->added = $added;
        echo $this->template;

    }

    public function p_add() {

        # Associate this post with the logged in user
        $_POST['user_id'] = $this->user->user_id;

        # Unix timestamp when this post was created/modified

        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert post into the database. Insert also sanitizes data.
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Send them back
        Router::redirect("/posts/add/added");

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
            posts.modified,
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

    public function modify() {

        // Display posts authored by the user

        # Set up the view
        $this->template->content = View::instance('v_posts_modify');
        $this->template->title = "Your Posts";

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array( '/css/style_posts_modify.css');
        $client_files_body = Array( '/js/posts_modify.js' );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Build the query
        $q = 'SELECT
            posts.post_id,
            posts.content,
            posts.created,
            posts.modified
            FROM posts
            WHERE user_id = '.$this->user->user_id;

        # Run the query
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        # Render the View
        echo $this->template;

    }

    public function p_modify() {

        // data passed via javascript using ajax.
        $postid = $_POST['postid'];
        $modifedPost = $_POST['modifiedPost'];

        $modifiedTime = Time::now();
        $data = Array("content" => $modifedPost, "modified" => $modifiedTime);
        DB::instance(DB_NAME)->update("posts", $data, "WHERE post_id =".$postid );

        //report back new modified time so view can display it.
        echo $modifiedTime;

    }

    public function p_deletePost() {

        $postid = $_POST['postid'];
        DB::instance(DB_NAME)->delete('posts', "WHERE post_id =" .$postid);
    }


    public function users() {

        $this->template->content = View::instance("v_posts_users");
        $this->template->title = "Users";

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array( '/css/style_posts_users.css' );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

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