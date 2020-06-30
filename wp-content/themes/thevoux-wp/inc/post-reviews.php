<?php

function thb_post_review_average() {
	$id = get_the_ID();
	if (get_post_meta($id, 'is_review', TRUE) == 'yes') {
		$features = get_post_meta($id, 'post_ratings_percentage', TRUE);
		$count = is_array($features) ? sizeof($features) : 0;
		$total = 0;
		$return = '';
		$average = false;
		if ($count > 0 && !empty($features)) {
			foreach($features as $feature) {
				$total += $feature['feature_score'];
			}
			$average = round($total / $count, 1);
		}
		return $average;
	}
}

function thb_post_review() {
	$id = get_the_ID();
	if (get_post_meta($id, 'is_review', TRUE) == 'yes') {
		$review_title = get_post_meta($id, 'post_ratings_title', TRUE);
		$comments = get_post_meta($id, 'post_ratings_comments', TRUE);
		$features = get_post_meta($id, 'post_ratings_percentage', TRUE);
		$count = $features ? count($features) : 0;
		$comment_count = $comments ? count($comments) : 0;
		$total = 0;
		?>
		<div class="post-review cf" itemscope itemtype="http://schema.org/Review">
			<?php if ($review_title) { ?><strong itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php echo esc_html($review_title); ?></span></strong><?php } ?>
			<ul>
			<?php if ($features) { foreach($features as $feature) {
				$total += $feature['feature_score'];
				?>
				<li class="thb-progressbar">
					<div class="row cf">
						<div class="small-12 medium-9 columns"><?php echo esc_attr($feature['title']); ?></div>
						<div class="small-12 medium-3 columns show-for-medium"><?php echo esc_attr($feature['feature_score']); ?></div>
					</div>
					<div class="thb-progress" data-progress="<?php echo esc_attr(10*$feature['feature_score']); ?>">
						<span></span>
					</div>
				</li>
			<?php } }?>
			</ul>
			<div class="row">
				<div class="small-12 medium-9 columns">
					<div class="row">
						<div class="small-12 medium-6 columns comment_section">
							<span class="post_comment good"><?php esc_html_e('The Good', 'thevoux'); ?></span>
							<?php if ($comments) { foreach($comments as $comment) { ?>
								<?php if ($comment['feature_comment_type'] == 'positive') { ?>
								<p class="positive"><?php echo esc_attr($comment['title']); ?></p>
								<?php } ?>
							<?php } } ?>
						</div>
						<div class="small-12 medium-6 columns comment_section">
							<span class="post_comment bad"><?php esc_html_e('The Bad', 'thevoux'); ?></span>
							<?php if ($comments) { foreach($comments as $comment) { ?>
								<?php if ($comment['feature_comment_type'] == 'negative') { ?>
								<p class="negative"><?php echo esc_attr($comment['title']); ?></p>
								<?php } ?>
							<?php } } ?>
						</div>
					</div>
				</div>
				<?php if ($features) { ?>
				<div class="small-12 medium-3 columns">
					<figure class="average" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<div class="thb-counter single-decimal">
							<div class="counter" data-count="<?php echo round($total / $count, 1); ?>" data-speed="1000">0</div>
						</div>
						<span itemprop="ratingValue" class="hide"><?php echo round($total / $count, 1); ?></span><span class="hide" itemprop="bestRating">10</span>
					</figure>


				</div>
				<?php } ?>
				<span class="hide" itemprop="author" itemscope itemtype="http://schema.org/Person">
			    <span itemprop="name"><?php the_author_meta('display_name', $id ); ?></span>
			  </span>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_post_review', 'thb_post_review' );
