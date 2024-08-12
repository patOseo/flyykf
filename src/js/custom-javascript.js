// Add your custom JS here.

import Tooltip from 'bootstrap/js/dist/tooltip';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';

// on page load, initialize testimonial Swiper if present on page
document.addEventListener('DOMContentLoaded', function() {
    var reviewsSwiper = document.getElementById('reviewsSlider');
    if(reviewsSwiper) {
        const swiper = new Swiper(reviewsSwiper, {
            modules: [Pagination, Navigation],
            slidesPerView: 1,
            spaceBetween: 48,
            loop: true,
            autoHeight: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.reviews-pagination',
                dynamicBullets: true,
                clickable: true,
            },
            keyboard: true
        });
    }

    var heroSlider = document.getElementById('heroSlider');
    if(heroSlider) {
        var swiper = new Swiper(heroSlider, {
            modules: [Pagination, Autoplay, EffectFade],
            spaceBetween: 30,
            draggable: false,
            allowTouchMove: false,
            simulateTouch: false,
            touchStartPreventDefault: false,
            noSwiping: true,
            noSwipingClass: 'no-swiping',
            loop: true,
            autoplay: {
              delay: 5000,
              disableOnInteraction: false,
            },
            slidesPerView: 1,
            effect: 'fade',
            fadeEffect: {
              crossFade: true,

            },
            speed: 1000,
            pagination: {
              el: '.hero-pagination',
              clickable: true
            },
        });
    }
});


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new Tooltip(tooltipTriggerEl)
});

// When scrolling past 20px, add class .bg-darkblue to #main-nav
// window.addEventListener('scroll', function() {
//     if (window.pageYOffset > 20) {
//         var mainNav = document.getElementById('main-nav');
//         mainNav.classList.add('bg-darkblue');
//         mainNav.classList.add('shadow-sm');
//     } else {
//         var mainNav = document.getElementById('main-nav');
//         mainNav.classList.remove('bg-darkblue');
//         mainNav.classList.remove('shadow-sm');
//     }
// });



// jQuery specifc code
jQuery(function($){
    // Smooth anchor scrolling
    $(document).ready(function() {
        // Check if the page loads with an anchor
        if (window.location.hash) {
            var target = $(window.location.hash);
            $('html, body').animate({
                scrollTop: target.offset().top - 200
            }, 0, 'linear');
        }

        // Scroll animation on click
        $('a').click(function() {
            var target = $($(this).attr('href'));
            $('html, body').animate({
                scrollTop: target.offset().top - 200
            }, 0, 'linear');
            return false;
        });
    });
});