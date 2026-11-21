jQuery(document).ready(function($) {
	
	
	// Toggle blog-menu
	$(".nav-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".mobile-menu").slideToggle();
		return false;
	});
	
	
	// Hide mobile-menu > 960
	$(window).on("resize", function() {
		if ($(window).width() > 960) {
			$(".nav-toggle").removeClass("active");
			$(".mobile-menu").hide();
		}
	});
	
	// Toggle post-meta
	$(".post-meta-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$('.post-meta').toggleClass("active");
		$(".post-meta-inner").slideToggle();
		return false;
	});
	
	
    // Post meta tabs
    $('.tab-selector a').on("click", function() {
    	$('.tab-selector a').removeClass('active');
		$('.post-meta-tabs .tab').hide(); 
		return false;
    });
    
    $('.tab-selector .tab-comments').on("click", function() {
    	$(this).addClass('active');
		$('.post-meta-tabs .tab-comments').show(); 
    });
    
    $('.tab-selector .tab-post-meta').on("click", function() {
    	$(this).addClass('active');
		$('.post-meta-tabs .tab-post-meta').show(); 
    });
    
    $('.tab-selector .tab-author-meta').on("click", function() {
    	$(this).addClass('active');
		$('.post-meta-tabs .tab-author-meta').show(); 
    });
	
	
	// Resize videos after container
	var vidSelector = "iframe, object, video";	
	var resizeVideo = function(sSel) {
		$( sSel ).each(function() {
			var $video = $(this),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( !$video.attr("data-origwidth") ) {
				$video.attr("data-origwidth", $video.attr("width"));
				$video.attr("data-origheight", $video.attr("height"));
			}

			var ratio = iTargetWidth / $video.attr("data-origwidth");

			$video.css("width", iTargetWidth + "px");
			$video.css("height", ( $video.attr("data-origheight") * ratio ) + "px");
		});
	};

	resizeVideo(vidSelector);

	$(window).on("resize", function() {
		resizeVideo(vidSelector);
	});

	// top scroll
    $(window).on("scroll", function () {
        if ($(this)
                .scrollTop() > 100) {
            $('.topScroll')
                .fadeIn();
        } else {
            $('.topScroll')
                .fadeOut();
        }
    });
    $('.topScroll').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
	
	
});

// Initialize galleries on first render and after Jetpack Infinite Scroll appends posts.
jQuery(function ($) {
	function initializeGalleries() {
		document.querySelectorAll('.rams-gallery:not(.rams-gallery-ready)').forEach(function (gallery) {
			var navigation = gallery.querySelector('.rams-gallery-nav');

			if (!navigation) {
				return;
			}

			var slides = gallery.querySelectorAll('.slides > li');
			var current = 0;

			function move(step) {
				slides[current].hidden = true;
				current = (current + step + slides.length) % slides.length;
				slides[current].hidden = false;
			}

			slides.forEach(function (slide, index) {
				slide.hidden = index !== current;
			});

			navigation.querySelector('.rams-gallery-prev').addEventListener('click', function () {
				move(-1);
			});
			navigation.querySelector('.rams-gallery-next').addEventListener('click', function () {
				move(1);
			});
			gallery.classList.add('rams-gallery-ready');
			navigation.hidden = false;
		});
	}

	initializeGalleries();
	$(document.body).on('post-load', initializeGalleries);
});
