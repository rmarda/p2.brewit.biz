
<section id="feature_area">
    <article>
        <ol>
            <?php foreach($posts as $post): ?>

                <li class="comment">
                    <div class="comment-meta">
                        <h4>post created:</h4>
                        <span>
                            <time datetime="<?=Time::display($post['created'],'Y-m-d G:i', $user->timezone)?>">
                                <?=Time::display($post['created'], '', $user->timezone)?>
                            </time>
                        </span>
                        <h4>post modified:</h4>
                        <span>
                            <time datetime="<?=Time::display($post['modified'],'Y-m-d G:i', $user->timezone)?>">
                                <?=Time::display($post['modified'], '', $user->timezone)?>
                            </time>
                        </span>
                    </div>
                    <blockquote>
                        <textarea class = "mypost"  title = <?=$post['post_id']?> readonly="readonly"><?=$post['content']?></textarea>
                        <button class = "editbutton" id = <?=$count?> >Edit Post</button>
                        <button class = "deletebutton">Delete</button>

                    </blockquote>
                </li>
            <?php endforeach;?>
        </ol>
    </article>
</section>


