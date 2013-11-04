<?php foreach($users as $user): ?>

<!--Print logged in user's name-->
<?=$user['first_name']?> <?=$user['last_name']?><br>

<!--Show an unfollow link if a connection exists-->
<?php if(isset($connections[$user['user_id']])): ?>
    <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
<?php else: ?>
    <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
<?php endif; ?>

<br><br>


<?php endforeach ?>