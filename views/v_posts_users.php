
<section id="feature_area">
    <article>
        <div  id="profile">
            <ol>
                <?php foreach($users as $user): ?>
                <li class="comment">
                    <blockquote>
                        <?=$user['first_name']?> <?=$user['last_name']?>

                        <?php if(isset($connections[$user['user_id']])): ?>
                            <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

                        <?php else: ?>
                            <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
                        <?php endif; ?>
                    </blockquote>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </article>
</section>










