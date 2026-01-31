<a class="navbar-brand <?= $args['class'] ?? ''; ?> flex justify-center items-center" href="<?= home_url() ?>">
	<?php
	$logoLink = $args['logoLink'] ?? 'site_logo';
	$logoImg = get_field( $logoLink , 'option'); ?>
	<img width="<?= $args['size'] ?? '160'; ?>" height="<?= $args['height'] ?? '40'; ?>" class="<?= $args['logoSize'] ?? 'w-20' ?> object-cover"
		 src="<?= esc_url($logoImg['url']) ?>"
		 alt="<?= esc_attr($logoImg['title']) ?>">
	<?php ?>
</a>
<?php
//instruction
//$args = array(
//	'size' => '200'
//);
//get_template_part('template-parts/global/logo', null, $args);
//?>
