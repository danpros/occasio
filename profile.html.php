<article class="tz-magazine-post post hentry">
	<header class="post-header entry-header">
		<h1 class="post-title entry-title"><?php echo $name;?></h1>
	</header><!-- .entry-header -->
	<div class="entry-content entry-excerpt">
	<?php echo $about; ?>
	<h3 class="post-index">Posts by this author</h3>
	<?php if (!empty($posts)) { ?>
		<ul class="post-list">
			<?php $i = 0; $len = count($posts); ?>
			<?php foreach ($posts as $p): ?>
				<?php if ($i == 0) {
					$class = 'item first';
				} elseif ($i == $len - 1) {
					$class = 'item last';
				} else {
					$class = 'item';
				}
				$i++; ?>
				<li class="<?php echo $class; ?>">
					<span><a href="<?php echo $p->url ?>"><?php echo $p->title ?></a></span> on
					<span><?php echo format_date($p->date) ?></span>. <?php echo i18n('Posted_in');?> <span class="tags-p"><?php echo $p->tag?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php } else {
		echo i18n('No_posts_found') . '!';
	} ?>	
	</div><!-- .entry-content -->
</article>
<?php if (!empty($pagination['prev']) || !empty($pagination['next'])): ?>
	<nav class="navigation pagination" role="navigation" aria-label="Posts" style="">
		<h2 class="screen-reader-text">Posts navigation</h2>
		<div class="nav-links"><?php echo $pagination['html'];?></div>
	</nav>
<?php endif;?>