<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<?php foreach ($posts as $p):?>
<?php $img = get_image($p->body);?>
<article class="tz-magazine-post post type-post status-publish format-standard has-post-thumbnail hentry">
	<?php if (!empty($p->image)) {?>
	<figure class="post-image">
		<a class="wp-post-image-link" href="<?php echo $p->url;?>" rel="bookmark" aria-hidden="true">
			<img src="<?php echo $p->image;?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $p->title;?>" loading="lazy" width="100%"/>
		</a>
	</figure>
	<?php } elseif (!empty($img) && empty($p->quote) && empty($p->video) && empty($p->audio) && config('teaser.type') === 'trimmed') { ?>
	<figure class="post-image">
		<a class="wp-post-image-link" href="<?php echo $p->url;?>" rel="bookmark" aria-hidden="true">
			<img src="<?php echo $img;?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $p->title;?>" loading="lazy" width="100%"/>			
		</a>
	</figure>
	<?php } ?>
	<?php if (!empty($p->video)):?>
	<figure class="post-image" <?php if (config('teaser.type') === 'full') {?>style="height:315px;"<?php } else {?>style="height:215px;"<?php } ?>>
		<iframe width="100%" height="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_video_id($p->video); ?>" frameborder="0" allowfullscreen></iframe>
	</figure>	
	<?php endif;?>
	<?php if (!empty($p->audio)):?>
	<figure class="post-image" <?php if (config('teaser.type') === 'full') {?>style="height:215px;"<?php } else {?>style="height:215px;"<?php } ?>>
		<iframe width="100%" height="100%" class="embed-responsive-item" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $p->audio;?>&amp;auto_play=false&amp;visual=true"></iframe>
	</figure>	
	<?php endif;?>
	<?php if (!empty($p->quote)):?>
	<figure class="post-image" style="font-size:20px;">
		<blockquote><?php echo $p->quote;?></blockquote>
	</figure>
	<?php endif;?>
	<header class="post-header entry-header">
		<?php if(!empty($p->link)){ ?>
		<h2 class="post-title entry-title post-link"><a href="<?php echo $p->link;?>" target="_blank"><?php echo $p->title;?></a></h2>
		<?php } else { ?>
		<h2 class="post-title entry-title"><a href="<?php echo $p->url;?>" rel="bookmark"><?php echo $p->title;?></a></h2>
		<?php } ?>
		<div class="entry-meta">
			<div class="entry-categories"> <?php echo $p->category;?></div>
			<span class="posted-on"><a href="<?php echo $p->url;?>" rel="bookmark"><time class="entry-date published"><?php echo format_date($p->date);?></time></a></span>
			<?php if (disqus_count()) { ?> 
				<span><i class="fa fa-comments"></i> <a href="<?php echo $p->url ?>#disqus_thread"> <?php echo i18n('Comments');?></a></span>
			<?php } elseif (facebook()) { ?> 
				<span><i class="fa fa-comments"></i> <a href="<?php echo $p->url ?>#comments"><span><fb:comments-count href=<?php echo $p->url ?>></fb:comments-count> <?php echo i18n('Comments');?></span></a></span>
			<?php } ?>
			<?php if (authorized($p)) { echo ' <span class="edit-post"><a href="'. $p->url .'/edit?destination=post">Edit</a></span>'; } ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content entry-excerpt">
	<?php echo get_teaser($p->body, $p->url); ?>
	<?php if (config('teaser.type') === 'trimmed'):?><div style="display:block;"><a style="margin-top:1.5em;" class="read-more" href="<?php echo $p->url; ?>"><?php echo config('read.more'); ?> <span class="screen-reader-text"><?php echo $p->title; ?></span></a> </div><?php endif;?>	
	</div><!-- .entry-content -->
</article>
<?php endforeach;?>
<?php if (!empty($pagination['prev']) || !empty($pagination['next'])): ?>
<nav class="navigation pagination" role="navigation" aria-label="Posts" style="">
	<h2 class="screen-reader-text">Posts navigation</h2>
	<div class="nav-links"><?php echo $pagination['html'];?></div>
</nav>
<?php endif;?>
<?php if (disqus_count()): ?>
    <?php echo disqus_count() ?>
<?php endif; ?>
