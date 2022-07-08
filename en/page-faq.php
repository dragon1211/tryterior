<?php
/**
 * Template Name: Q&A-英
 */
?>
<?php
get_header();
the_post();
?>
<div class="page-header" style="background-image: url(/images/faq/header.jpg)">
	<h1><i>Q &amp; A</i><strong>FAQs</strong></h1>
</div><!-- .page-header -->
	<div id="faq2">
		<section id="faq21">
		<?php the_content(); ?>
			<!-- /wp:html -->
		</section>
	</div>
<?php get_footer(); ?>