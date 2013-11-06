<!--<section id="feature_area">
    <article id="allusers">
        <table >
            <caption>List of all users</caption>
            <tr>
                <th scope="col" >Name</th>
                <th scope="col" >Follow/Unfollow</th>
            </tr>

            <?php foreach($users as $user): ?>
            <tr>
                <td>
                    <?=$user['first_name']?> <?=$user['last_name']?>
                </td>

                <td><?php if(isset($connections[$user['user_id']])): ?>
                    <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

                    <?php else: ?>
                    <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </article>
</section>
-->


<section id="feature_area">
    <article>
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
    </article>
</section>
