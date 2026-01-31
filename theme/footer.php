</main>
<?php
get_template_part('template-parts/layout/footer-content');
if (is_front_page()):
	get_template_part('template-parts/layout/sticky-social');
endif;
wp_footer();
get_template_part('template-parts/global/lines'); ?>
<?php get_template_part('template-parts/global/backToTop'); ?>
</body>
</html>
