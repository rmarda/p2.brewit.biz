<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index($error = NULL) {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file

			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "Nano Blog";

            # Pass data to the view
            $this->template->content->error = $error;

        # Create an array of 1 or many client files to be included in the head
            $client_files_head = Array( '/css/style_index.css' );

        # Use load_client_files to generate the links from the above array
            $this->template->client_files_head = Utils::load_client_files($client_files_head);

		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	      					     		
		# Render the view
			echo $this->template;

	} # End of method
	
	
} # End of class
