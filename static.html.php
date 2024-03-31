<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<article class="tz-magazine-post post hentry">	
	<header class="post-header entry-header">
		<h1 class="post-title entry-title"><?php echo $p->title;?></h1>
		<?php if (authorized($p)) { echo ' <span class="edit-post"><a href="'. $p->url .'/edit?destination=post">Edit</a></span>'; } ?>
	</header><!-- .entry-header -->
	<div class="entry-content entry-excerpt">
	<?php echo $p->body; ?>		
	</div><!-- .entry-content -->
</article>
<nav class="navigation post-navigation" role="navigation" aria-label="Posts">
	<h2 class="screen-reader-text">Post navigation</h2>
	<div class="nav-links">
		<?php if (!empty($prev)): ?>
		<div class="nav-previous"><a href="<?php echo($prev['url']); ?>" rel="prev"><span class="nav-link-text"><?php echo i18n('Prev');?></span><h3 class="entry-title"><?php echo($prev['title']); ?></h3></a></div>
		<?php endif;?>
		<?php if (!empty($next)): ?>
		<div class="nav-next"><a href="<?php echo($next['url']); ?>" rel="next"><span class="nav-link-text"><?php echo i18n('Next');?></span><h3 class="entry-title"><?php echo($next['title']); ?></h3></a></div>
		<?php endif;?>
	</div>
</nav>