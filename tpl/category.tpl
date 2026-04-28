{extends file="index.tpl"}

{block name="title"}{$category->title}{/block}

{block name="content"}
    <section class="category-section">
        <div class="category-header">
            <h2 class="category-title">{$category->title|upper}</h2>
        </div>
        <div class="category-content">
            <p class="category-description">
                {$category->description|escape}
            </p>
        </div>

        <div class="control-container">
            <label for="posts-sorting">Sorting</label>
            <select id="posts-sorting" name="sort" class="sort" onchange="window.location.href = '?sort=' + this.value;">
                <option value="created-desc" {if isset($smarty.get.sort) && $smarty.get.sort == 'created-desc'}selected{/if}>Newer first</option>
                <option value="created-asc" {if isset($smarty.get.sort) && $smarty.get.sort == 'created-asc'}selected{/if}>Newer last</option>
                <option value="views-desc" {if isset($smarty.get.sort) && $smarty.get.sort == 'views-desc'}selected{/if}>Popular first</option>
                <option value="views-asc" {if isset($smarty.get.sort) && $smarty.get.sort == 'views-asc'}selected{/if}>Popular last</option>
            </select>
        </div>

        <div class="posts-grid">
            {foreach $posts as $post}
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
        {include file='pagination.tpl'}
    </section>
{/block}
