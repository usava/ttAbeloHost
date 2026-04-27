<html lang="en">
<head>
    <title>{$post->title}</title>
</head>
<body>
    <main class="container">
        <h1>{$post->title}</h1>

        <article class="post-card">
            <div class="post-image">
                <img src="assets/{$post->image}" alt="{$post->title}">
            </div>
            <div class="post-content">
                <h3 class="post-title">{$post->title}</h3>
                <time class="post-date">{$post->created_at|date_format:"%B %e, %Y"}</time>
                <p class="post-excerpt">
                    {$post->text|escape}
                </p>
            </div>
        </article>
    </main>
</body>
</html>
