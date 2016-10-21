<main>
	This is where I ramble.
</main>

<?php foreach ($posts as $post): ?>
<article>
	<h3><a href="/blog/<?= $post->id; ?>"><?= $post->title; ?></a></h3>
</article>
<?php endforeach; ?>
