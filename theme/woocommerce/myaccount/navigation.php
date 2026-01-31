<nav class="woocommerce-MyAccount-navigation p-0" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<ul class="list-none gap-0.5 p-0 !m-0">
		<?php
		// 1. Define your icon mapping here
		$icons = array(
			'dashboard'       => 'dashicons-dashboard',
			'orders'          => 'dashicons-cart',
			'downloads'       => 'dashicons-download',
			'edit-address'    => 'dashicons-location',
			'payment-methods' => 'dashicons-id',
			'edit-account'    => 'dashicons-admin-users',
			'customer-logout' => 'dashicons-exit',
		);

		foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
			$active = wc_is_current_account_menu_item( $endpoint );
			// 2. Get the icon for this specific item, or use a default
			$icon_class = isset( $icons[ $endpoint ] ) ? $icons[ $endpoint ] : 'dashicons-admin-generic';
			?>

			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> bg-gray-50 flex flex-col hover:bg-gray-100 p-3 px-8 items-center my-0 text-center border border-gray-100 <?php echo $active ? '!bg-flower/50' : ''; ?>">
				<a class="no-underline w-full flex justify-center items-center gap-1 <?php echo $active ? '!text-white' : '!text-black/50'; ?>" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" <?php echo $active ? 'aria-current="page"' : ''; ?>>

					<span class="dashicons <?php echo esc_attr( $icon_class ); ?> mb-1"></span>

					<span class="text-xs font-medium"><?php echo esc_html( $label ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
