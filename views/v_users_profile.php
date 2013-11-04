<?php if($user):?>

<h4> This is profile for <?= $user->first_name ?></h4>

<?php else :?>
<h1> No user specified</h1>
<?php endif ;?>


