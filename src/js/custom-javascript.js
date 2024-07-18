// Add your custom JS here.

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