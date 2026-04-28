<html lang="en">
<head>
    <title>{$post->title}</title>
    <link type="text/css" href="/style.css" rel="stylesheet">
</head>
<body>
    <main class="container">
        <h1><a href="/">Bloggy</a></h1>
        <section>
            <h2>{$post->title}</h2>

            <article class="post-card">
                <div class="post-image">
                    <img src="/assets/{$post->image}" alt="{$post->title}">
                </div>
                <div class="post-content">
                    <h3 class="post-title">{$post->title}</h3>
                    <time class="post-date">{$post->created_at|date_format:"%B %e, %Y"}</time>
                    <p class="post-excerpt">
                        {$post->text|escape}
                    </p>
                </div>
            </article>
        </section>
        <div class="similar-posts">
            <h2>Similar posts</h2>
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
        </div>
    </main>
</body>
</html>
