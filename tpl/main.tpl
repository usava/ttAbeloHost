{extends file="index.tpl"}

{block name="title"}Bloggy{/block}

{block name="content"}
    {foreach $categories as $category}
        <section class="category-section">
            <div class="category-header">
                <h2 class="category-title">{$category->title|upper}</h2>
                <a href="/category/{$category->id}" class="view-all">View All</a>
            </div>

            <div class="posts-grid">
                {foreach $category->getPosts(['limit' => 3]) as $post}
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
        </section>
    {/foreach}
{/block}