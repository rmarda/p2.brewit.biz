
<section id="feature_area">
    <article>
        <ol>
        <?php foreach($posts as $post): ?>

            <li class="comment">
                <div class="comment-meta">

                    <h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4>
                    <span><time datetime="<?=Time::display($post['created'],'Y-m-d G:i', $user->timezone)?>">
                            <?=Time::display($post['created'], '', $user->timezone)?>
                        </time>
                    </span>
                </div>
                <blockquote>
                    <p><?=$post['content']?></p>
                </blockquote>
            </li>
        <?php endforeach;?>
        </ol>
    </article>
</section>

