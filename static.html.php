<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<article class="tz-magazine-post post hentry">	
	<header class="post-header entry-header">
		<h1 class="post-title entry-title"><?php echo $p->title;?></h1>
	</header><!-- .entry-header -->
	<div class="entry-content entry-excerpt">
	<?php echo $p->body; ?>		
	</div><!-- .entry-content -->
</article>