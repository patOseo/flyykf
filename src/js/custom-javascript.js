// Add your custom JS here.

import Tooltip from 'bootstrap/js/dist/tooltip';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

// on page load, initialize Swiper if present on page
document.addEventListener('DOMContentLoaded', function() {
    var mySwiper = document.getElementById('swiper');
    if(mySwiper) {
        const swiper = new Swiper('.swiper', {
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
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true,
            },
            keyboard: true
        });
    }
});


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new Tooltip(tooltipTriggerEl)
});

// When scrolling past 20px, add class .bg-darkblue to #main-nav
window.addEventListener('scroll', function() {
    if (window.pageYOffset > 20) {
        var mainNav = document.getElementById('main-nav');
        mainNav.classList.add('bg-darkblue');
        mainNav.classList.add('shadow-sm');
    } else {
        var mainNav = document.getElementById('main-nav');
        mainNav.classList.remove('bg-darkblue');
        mainNav.classList.remove('shadow-sm');
    }
});



// jQuery specifc code
jQuery(function($){
    // Smooth anchor scrolling
	$('a').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top -200
	    }, 0, 'linear');
	    return false;
	});
});