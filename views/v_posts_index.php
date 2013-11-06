
<section id="feature_area">
    <article>
        <div  id="posts">
            <ol>
                <?php foreach($posts as $post): ?>
                <li class="comment">
                    <div class="comment-meta">

                        <h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4>
                        <span>
                            <time datetime="<?=Time::display($post['modified'],'Y-m-d G:i', $user->timezone)?>">
                                <?=Time::display($post['modified'], '', $user->timezone)?>
                            </time>
                        </span>
                    </div>
                    <blockquote>
                        <p><?=$post['content']?></p>
                    </blockquote>
                </li>
                <?php endforeach;?>
            </ol>
        </div>
    </article>
</section>










