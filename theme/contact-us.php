<?php /* Template Name: contact us */
$form_id = get_field('gravity_form');
get_header(); ?>
	<section class="container max-w-content max-lg:mb-4 max-lg:pt-12 my-24">
		<h1 class="text-white text-6xl"><?php the_title() ?></h1>
	</section>
	<section class="relative">
		<div class="inset-y-0 bg-foreground absolute z-[0] w-full lg:w-8/12"></div>
		<div class="container max-w-content z-[1] relative flex justify-start flex-wrap items-center">
			<div class="lg:ps-8 lg:pe-20 px-4 py-12 lg:py-40 basis-full lg:basis-8/12">
				<h2 class="pb-6 text-white text-2xl">هر سوالی دارین برامون بنویسین</h2>
				<?php
				if ($form_id) {
					// Display the Gravity Form using the ID
					echo do_shortcode('[gravityform id="' . $form_id . '" title="false" ajax="false" description="false"]');
				} else {
					echo '';
				} ?>
			</div>
			<div
				class="bg-icon lg:-ms-4 px-5 py-16 lg:py-24 lg:px-12 lg:basis-4/12 flex flex-col gap-y-8 lg:items-start items-center">
				<?php $address = get_field('address', 'option');
				if ($address) :?>
					<address class="flex gap-3 not-italic justify-center items-start lg:justify-start">
						<svg width="16" height="16" class="e-font-icon-svg e-fas-map-marker-alt" viewBox="0 0 384 512"
							 xmlns="http://www.w3.org/2000/svg">
							<path
								d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
						</svg>
						<?= get_field('address', 'option'); ?>
					</address>
				<?php endif; ?>
				<?php
				$phone = get_field('phone', 'option');
				if ($phone) :?>
					<a aria-label="call us"
					   class="flex gap-3 hover:text-warning transition-colors justify-start lg:justify-start"
					   href="tel:<?= $phone; ?>">
						<svg width="16" height="16" class="e-font-icon-svg e-fas-phone-volume" viewBox="0 0 384 512"
							 xmlns="http://www.w3.org/2000/svg">
							<path
								d="M97.333 506.966c-129.874-129.874-129.681-340.252 0-469.933 5.698-5.698 14.527-6.632 21.263-2.422l64.817 40.513a17.187 17.187 0 0 1 6.849 20.958l-32.408 81.021a17.188 17.188 0 0 1-17.669 10.719l-55.81-5.58c-21.051 58.261-20.612 122.471 0 179.515l55.811-5.581a17.188 17.188 0 0 1 17.669 10.719l32.408 81.022a17.188 17.188 0 0 1-6.849 20.958l-64.817 40.513a17.19 17.19 0 0 1-21.264-2.422zM247.126 95.473c11.832 20.047 11.832 45.008 0 65.055-3.95 6.693-13.108 7.959-18.718 2.581l-5.975-5.726c-3.911-3.748-4.793-9.622-2.261-14.41a32.063 32.063 0 0 0 0-29.945c-2.533-4.788-1.65-10.662 2.261-14.41l5.975-5.726c5.61-5.378 14.768-4.112 18.718 2.581zm91.787-91.187c60.14 71.604 60.092 175.882 0 247.428-4.474 5.327-12.53 5.746-17.552.933l-5.798-5.557c-4.56-4.371-4.977-11.529-.93-16.379 49.687-59.538 49.646-145.933 0-205.422-4.047-4.85-3.631-12.008.93-16.379l5.798-5.557c5.022-4.813 13.078-4.394 17.552.933zm-45.972 44.941c36.05 46.322 36.108 111.149 0 157.546-4.39 5.641-12.697 6.251-17.856 1.304l-5.818-5.579c-4.4-4.219-4.998-11.095-1.285-15.931 26.536-34.564 26.534-82.572 0-117.134-3.713-4.836-3.115-11.711 1.285-15.931l5.818-5.579c5.159-4.947 13.466-4.337 17.856 1.304z"></path>
						</svg>
						<span class="ltr"><?= $phone; ?></span>
					</a>
				<?php endif;
				$email = get_field('email', 'option');
				if ($email) :?>
					<a aria-label="call us"
					   class="flex gap-2 hover:text-warning transition-colors justify-start lg:justify-start"
					   href="mailto:<?= $email; ?>">
						<svg width="15" height="15" class="e-font-icon-svg e-fas-envelope" viewBox="0 0 512 512"
							 xmlns="http://www.w3.org/2000/svg">
							<path
								d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
						</svg>
						<?= $email; ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<section class="container mt-16 flex justify-center">
		<?= get_field('map', 'option') ?? ''; ?>
	</section>
<?php
get_footer();
