<section id="feature_area">
    <article>
        <div  id="addpost">
            <ol>
                <li class="comment">
                    <blockquote>
                        <?php if(isset($added)): ?>
                            <div>
                                Post successfully added. Add another?
                            </div>
                            <br>
                        <?php endif; ?>

                        <form method = 'post' action ='/posts/p_add'>

                            <textarea name= 'content' style="width: 300px; height: 150px;"></textarea>

                            <input type='Submit' value='Add new post'>

                        </form>
                    </blockquote>
                </li>
            </ol>
        </div>
    </article>
</section>


