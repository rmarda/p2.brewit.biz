<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href='http://fonts.googleapis.com/css?family=Metrophobic|Droid+Sans:400,700|Droid+Sans+Mono|Open+Sans:400italic,700italic,800italic,300italic,600italic,400,300,600,700,800|Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href="/css/style_template.css" rel="stylesheet" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="/js/jstz.min.js" type="text/javascript"></script>
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>
    <div id="wrapper">
        <header>
            <img id="logo" src="/uploads/images/Blogging.jpg" alt="Nano Blog Logo" />
            <h1>Nano Blog</h1>
            <hgroup id="userPref">
                <h5>Hello <?php echo $user->first_name . ' !'; ?></h5>
                <h5><a href="/users/logout">Log Out</a></h5>
            </hgroup>
        </header>
        <nav id="mainmenu">
            <ul>
                <li> <a href="/posts/users"> All Users</a> </li>
                <li> <a href="/posts/index"> Posts</a> </li>
                <li> <a href='/posts/add'> Add Post</a> </li>
                <li> <a href='/posts/modify'> Manage Posts</a> </li>
            </ul>
        </nav>
        <!-- Hide User name, logout option and posts nav if no user is logged in-->
        <?php if(!$user):?>
        <script>
            document.getElementById('userPref').style.display="none";
            document.getElementById('mainmenu').style.display="none";
        </script>
        <?php endif;?>

        <?php if(isset($content)) echo $content; ?>
        <footer>
            <p>Copyright, All rights reserved.</p>
        </footer>
    </div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>