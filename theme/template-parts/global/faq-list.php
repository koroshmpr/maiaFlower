<?php
/**
 * Simplified Reusable FAQ List
 * @param array $args ['items'] The repeater array containing 'question' and 'answer'
 */
$items = $args['items'] ?? get_field('faq_list');

if (empty($items)) return;
?>

<section class="w-full py-5 grid gap-2">

	<?php foreach ($items as $index => $item) :
		$question = $item['question'] ?? '';
		$answer = $item['answer'] ?? '';
		if (empty($question) || empty($answer)) continue;
		?>

		<div x-data="{ expanded: false }"
			 class="bg-white border border-gray-200 rounded-md p-5 transition-all duration-300">

			<button
				type="button"
				class="flex items-center justify-between w-full cursor-pointer text-start"
				@click="expanded = !expanded"
				:aria-expanded="expanded">

                <span class="text-gray-900 text-sm lg:text-base leading-tight">
                    <?= esc_html($question); ?>
                </span>

				<span class="shrink-0 ms-3 text-flower transition-transform duration-300">
					<svg x-show="!expanded" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
						<path
							d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
					</svg>
					<svg x-show="expanded" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" x-cloak>
						<path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
					</svg>
				</span>
			</button>

			<div
				class="grid text-sm text-gray-600 overflow-hidden transition-all duration-300 ease-in-out"
				:class="expanded ? 'grid-rows-[1fr] opacity-100 mt-4 pt-4 border-t border-gray-100' : 'grid-rows-[0fr] opacity-0'"
			>
				<div class="overflow-hidden">
					<div class="text-justify leading-7 pb-2">
						<?= wp_kses_post($answer); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

</section>
