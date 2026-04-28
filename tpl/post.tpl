{extends file="index.tpl"}

{block name="title"}{$post->title}{/block}

{block name="content"}
    <section>
        <h2>{$post->title}</h2>

        <article class="post-page">
            <div class="post-image">
                <img src="/assets/{$post->image}" alt="{$post->title}">
            </div>
            <div class="post-content">
                <h3 class="post-title">{$post->title}</h3>
                <div class="post-info">
                    <time class="post-date">{$post->created_at|date_format:"%B %e, %Y"}</time>
                    <label class="post-views" for="post-views">views: </label>
                    <span id="post-views">{$post->views|number_format:0:".":" "}</span>
                </div>
                <div>
                    <p class="post-description">
                        {$post->description|escape}
                    </p>
                </div>
                <div>
                    <p class="post-text">
                        {$post->text|escape}
                    </p>
                </div>

            </div>
        </article>
    </section>
    <div class="similar-posts">
        <h2>Similar posts</h2>
        {get_category_posts category_id=$category->id var="category_posts" limit=3 sort="created-asc"}
        <div class="posts-grid">
            {foreach $category_posts as $post}
                <article class="post-card">
                    <div class="post-image">
                        <img src="/assets/{$post->image}" alt="{$post->title}">
                    </div>
                    <div class="post-content">
                        <h3 class="post-title">{$post->title}</h3>
                        <time class="post-date">{$post->created_at|date_format:"%B %e, %Y"}</time>
                        <p class="post-excerpt">
                            {$post->description|truncate:150:"..."}
                        </p>
                        <a href="/post/{$post->id}" class="continue-reading">Continue Reading</a>
                    </div>
                </article>
            {/foreach}
        </div>
    </div>
{/block}
