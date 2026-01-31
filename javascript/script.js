import Swiper from 'swiper/bundle';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

document.addEventListener('DOMContentLoaded', function () {
	window.Alpine = Alpine;
	Alpine.plugin(intersect);
	Alpine.start();

	const initPageSliders = () => {
		document.querySelectorAll('.post-slider').forEach((slider, i) => {
			if (slider.classList.contains('swiper-initialized')) return;
			let autoplaySpeed = slider.dataset.autoplay ? parseInt(slider.dataset.autoplay) : 0;
			let perPage = slider.dataset.perpage ? parseInt(slider.dataset.perpage) : 4.5;
			let perPageLapTop = slider.dataset.lapTop ? parseInt(slider.dataset.lapTop) : 3.5;
			let perPageTablet = slider.dataset.tablet ? parseFloat(slider.dataset.tablet) : 1.7;
			let perPageMobile = slider.dataset.mobile ? parseFloat(slider.dataset.mobile) : 1;
			let perfix = slider.dataset.perfix ?? 'slider';
			let direction = slider.dataset.direction ?? 'horizontal';
			let index = slider.dataset.index ?? i;
			let space = slider.dataset.space ? parseInt(slider.dataset.space) : 20;
			let free = slider.dataset.free === '1' ;

			new Swiper(slider, {
				direction: direction,
				grabCursor: true,
				speed: 1000,
				effect: 'slide',
				freeMode :free ,
				spaceBetween: space,
				slidesPerView: perPageMobile,
				centeredSlides: false,
				breakpoints: {
					1224: {
						slidesPerView: perPage,
					},
					768: {
						slidesPerView: perPageTablet,
					},
					992: {
						slidesPerView: perPageLapTop,
					}
				},
				pagination: {
					el: slider.querySelector('.swiper-pagination'),
					clickable: true,
					dynamicBullets: true, // Optional: Looks great for boutique stores
				},
				navigation: {
					nextEl: `.${perfix}-next-${index}`,
					prevEl: `.${perfix}-prev-${index}`,
				},
				autoplay: autoplaySpeed > 0 ? {
					delay: autoplaySpeed,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				} : false,
			});
		});
	};

	initPageSliders();

	window.initModalGallery = function() {
		setTimeout(() => {
			const thumbSlider = new Swiper(".thumb-modal-slider", {
				spaceBetween: 8,      // Unified gap
				slidesPerView: 'auto', // Important: allows thumbnails to respect CSS sizes
				freeMode: true,
				watchSlidesProgress: true,
				slideToClickedSlide: true, // Better UX for Digikala style
				centerInsufficientSlides: true,
			});

			const mainSlider = new Swiper(".main-modal-slider", {
				spaceBetween: 20,
				speed: 600,
				grabCursor: true,
				thumbs: {
					swiper: thumbSlider,
				},
				on: {
					slideChange: function () {
						// Safe check for the element
						const sliderEl = document.querySelector('.main-modal-slider');
						if (!sliderEl) return;

						const portfolioIndex = parseInt(sliderEl.dataset.portfolioStart);
						window.dispatchEvent(new CustomEvent('slide-changed', {
							detail: {
								index: this.activeIndex,
								portfolioStart: portfolioIndex
							}
						}));
					}
				}
			});

			window.modalSwiperInstance = mainSlider;
		}, 100); // Slightly higher delay for teleport stability
	};
});
