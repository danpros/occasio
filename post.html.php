<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<article class="tz-magazine-post post type-post hentry">
	<?php if (!empty($p->image)) :?>
	<figure class="post-image">
		<a class="wp-post-image-link" href="<?php echo $p->url;?>" rel="bookmark" aria-hidden="true">
			<img src="<?php echo $p->image;?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $p->title;?>" loading="lazy" width="100%"/>
		</a>
	</figure>
	<?php endif;?>
	<?php if (!empty($p->video)):?>
	<figure class="post-image" style="height:315px;">
		<iframe width="100%" height="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_video_id($p->video); ?>" frameborder="0" allowfullscreen></iframe>
	</figure>	
	<?php endif;?>
	<?php if (!empty($p->audio)):?>
	<figure class="post-image" style="height:215px;">
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
		<h1 class="post-title entry-title post-link"><a href="<?php echo $p->link;?>" target="_blank"><?php echo $p->title;?></a></h1>
		<?php } else { ?>
		<h1 class="post-title entry-title"><?php echo $p->title;?></h1>
		<?php } ?>
		<div class="entry-meta">
			<div class="entry-categories"> <?php echo $p->category;?></div>
			<span class="posted-on"><a href="<?php echo $p->url;?>" rel="bookmark"><time class="entry-date published"><?php echo format_date($p->date);?></time></a></span>
			<span class="author"><a class="url" href="<?php echo $p->authorUrl;?>"><?php echo $p->authorName;?></a></span>
			<?php if (disqus_count()) { ?> 
				<span><i class="fa fa-comments"></i> <a href="<?php echo $p->url ?>#disqus_thread"> <?php echo i18n('Comments');?></a></span>
			<?php } elseif (facebook()) { ?> 
				<span><i class="fa fa-comments"></i> <a href="<?php echo $p->url ?>#comments"><span><fb:comments-count href=<?php echo $p->url ?>></fb:comments-count> <?php echo i18n('Comments');?></span></a></span>
			<?php } ?>
			<?php if (authorized($p)) { echo ' <span class="edit-post"><a href="'. $p->url .'/edit?destination=post">Edit</a></span>'; } ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content entry-excerpt">
	<?php echo $p->body; ?>	
	</div><!-- .entry-content -->
	<div class="entry-tags"><span class="entry-tags-label screen-reader-text"><?php echo i18n('Tags');?></span><?php echo $p->tag;?></div>

</article>

<nav class="navigation post-navigation" role="navigation" aria-label="Posts">
	<div class="related-posts"><style>.related-posts span{relative;display: inline-block;} .related-posts ul {margin-top:10px;}.related-posts a {text-decoration:none}</style><span class="nax-link-text"><?php echo i18n("related_posts");?></span>
	<?php echo get_related($p->related);?></div>
	<h2 class="screen-reader-text">Post navigation</h2>
	<div class="nav-links">
		<?php if (!empty($prev)): ?>
		<div class="nav-previous"><a href="<?php echo($prev['url']); ?>" rel="prev"><span class="nav-link-text"><?php echo i18n('Prev_post');?></span><h3 class="entry-title"><?php echo($prev['title']); ?></h3></a></div>
		<?php endif;?>
		<?php if (!empty($next)): ?>
		<div class="nav-next"><a href="<?php echo($next['url']); ?>" rel="next"><span class="nav-link-text"><?php echo i18n('Next_post');?></span><h3 class="entry-title"><?php echo($next['title']); ?></h3></a></div>
		<?php endif;?>
	</div>
</nav>

<?php if (disqus()): ?>
    <?php echo disqus($p->title, $p->url) ?>
<?php endif; ?>
<?php if (disqus_count()): ?>
    <?php echo disqus_count() ?>
<?php endif; ?>

<?php if (facebook() || disqus()): ?>
<div id="comments" class="comments-area">
	<h3 id="reply-title" class="comment-reply-title"><?php echo i18n('Comments');?></h3>
    <?php if (facebook()): ?>
        <div class="fb-comments" data-href="<?php echo $p->url ?>" data-numposts="<?php echo config('fb.num') ?>" data-colorscheme="<?php echo config('fb.color') ?>"></div>
    <?php endif; ?>
    <?php if (disqus()): ?>
        <div id="disqus_thread"></div>
    <?php endif; ?>
</div>
<?php endif; ?>