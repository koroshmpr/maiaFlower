<?php
/**
 * Sticky WooCommerce notices for single product page
 */

$notices = wc_get_notices(); // ['error'=>[], 'success'=>[], 'notice'=>[]]

if ( empty( $notices['error'] ) && empty( $notices['success'] ) && empty( $notices['notice'] ) ) {
	return; // Nothing to show
}

/**
 * Recursively flatten an array to string
 */
function flatten_notice( $notice ) {
	if ( is_array( $notice ) ) {
		$notice = array_map( 'flatten_notice', $notice );
		return implode( ' ', $notice );
	}
	return (string) $notice;
}
?>

<div x-data="{ close: false }"
	 x-show="!close"
	 x-transition
	 class="fixed max-lg:top-7 lg:bottom-8 end-4 w-96 max-w-xs z-50">

	<div class="bg-white border border-gray-300 rounded-md shadow-lg p-4 relative">

		<!-- Close button -->
		<button @click="close = true"
				class="absolute top-2 start-2 p-1 rounded-full bg-gray-100 hover:bg-gray-200 transition-all">
			<?php get_template_part('template-parts/svg/close', null, [
				'class' => 'text-gray-700',
				'size'  => '15'
			]); ?>
		</button>

		<!-- Loop through notices -->
		<?php foreach ( $notices as $type => $list ) : ?>
			<?php foreach ( $list as $notice ) : ?>
				<div class="mb-2 p-2 rounded flex justify-between items-center text-xs [&>a]:!bg-flower [&>a]:!text-white
                    <?= $type === 'error' ? 'bg-red-100 text-red-700' : '' ?>
                    <?= $type === 'success' ? 'bg-green-100 text-green-700' : '' ?>
                    <?= $type === 'notice' ? 'bg-yellow-100 text-yellow-700' : '' ?>">
					<?php
					// Flatten recursively and print safely with HTML
					echo wp_kses_post( flatten_notice( $notice ) );
					?>
				</div>
			<?php endforeach; ?>
		<?php endforeach; ?>

	</div>
</div>

<?php
// Clear notices so they don't repeat
wc_clear_notices();
?>
