
jQuery(document).ready(function ($) {

	$('.header-r .head-search-form').hide();
	$('.header-r .header-search > .search-toggle-btn').on( 'click', function (e) {
		$(this).siblings('.head-search-form').slideToggle();
		e.stopPropagation();
	});
	$('.header-r .head-search-form').on( 'click', function (e) {
		e.stopPropagation();
	});

	$(window).on( 'click', function () {
		$('.head-search-form').slideUp();
	});

	$('.header-search .btn-form-close').on( 'click', function () {
		$('.head-search-form').slideUp();
	});

	//responsive menu toggle
	 $('.site-header .mobile-menu-opener').on('click', function () {
	 	$('.menu-wrap').animate({
	 		width: 'toggle',
	 	});
	 	$('body').addClass('menu-open');
	 });

	 $('.site-header .close').on('click', function () {
	 	$('.menu-wrap').animate({
	 		width: 'toggle',
	 	});
	 	$('body').removeClass('menu-open');
	 });

	 $('.overlay').on('click', function () {
		$('.menu-wrap').animate({
			width: 'toggle',
		});
		$('body').removeClass('menu-open');
	});

	if ($('.header-r .menu-wrap').length) {
		var psw = new PerfectScrollbar('.menu-wrap');
	}

	//ul accessibility
	$('<button class="angle-down"><i class="fa fa-angle-down"></i></button>').insertAfter($('.mobile-menu-wrapper ul .menu-item-has-children > a'));
	$('.mobile-menu-wrapper ul li .angle-down').on( 'click', function () {
		$(this).next().slideToggle();
		$(this).toggleClass('active');
	});

	//desktop navigation
	$('<button class="angle-down"><i class="fa fa-angle-down"></i></button>').insertAfter($('#site-navigation ul .menu-item-has-children > a'));
	$('#site-navigation ul li .angle-down').on( 'click', function () {
		$(this).next().slideToggle();
		$(this).toggleClass('active');
	});

	$('.toggle-button').on( 'click', function () {
		$('body').removeClass('menu-toggled');
		$('.main-navigation').removeClass('toggled');
	});

	var winWidth = $(window).width();
	$(window).on( 'scroll', function () {
		if ($(this).scrollTop() > 200) {
			$('.back-to-top').addClass('show');
		}
		else {
			$('.back-to-top').removeClass('show');
		}
	});

	$('.back-to-top').on( 'click', function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1000);
	});

	if ($('.widget_rrtc_description_widget').length) {
		$('.description').each(function () {
			var psw = new PerfectScrollbar('.widget_rrtc_description_widget .rtc-team-holder-modal .text-holder .description');
		});
	}

	$(".gallery-section.style3 .gallery-wrap").owlCarousel({
		center: true,
		items: 3,
		loop: true,
		margin: 25,
		autoWidth: true,
		dots: false,
		nav: true,
		autoplay: false,
	});

	$(".gal-carousel .gallery-wrap").owlCarousel({
		center: true,
		items: 3,
		loop: true,
		margin: 25,
		autoWidth: true,
		dots: false,
		nav: true,
		autoplay: true,
	});

	$(".slider .test-wrap").owlCarousel({
		center: true,
		//items:5,
		loop: true,
		margin: 25,
		autoWidth: false,
		dots: false,
		nav: true,
		autoplay: false,
		responsive: {
			801: {
				items: 5,
			},
			641: {
				items: 3,
			},
			640: {
				items: 1,
			},
			0: {
				items: 1,
			}
		}
	});

	$("ul.slider").owlCarousel({
		items: 1,
		loop: true,
		autoWidth: false,
		dots: false,
		nav: true,
		autoplay: true,
	});

	$('.slider .owl-item .test-content').each(function () {
		var testContentHeight = $(this).height();
		if (winWidth >= 641) {
			$(this).parent('.test-block').css('padding-bottom', testContentHeight);
		}
	});
	var $grid = $('.article-wrap.grid').imagesLoaded(function () {
		$grid.isotope({
			itemSelector: '.post',
			percentPosition: true,
			gutter: 10,
			masonry: {
				columnWidth: '.grid-sizer'
			}
		});
	});

	// init Isotope
	var $grid1 = $('.gallery-section:not(.style3) .gallery-wrap').imagesLoaded(function () {
		$grid1.isotope({
			itemSelector: '.gallery-img',
		});
	});

	var $innergrid = $('body.page-template-portfolio:not(.gal-carousel) .site-main .gallery-wrap').imagesLoaded(function () {
		$innergrid.isotope({
			itemSelector: '.gallery-img',
		});
	});

	// filter items on button click
	$('.filter-button-group').on('click', 'button', function () {
		var filterValue = $(this).attr('data-filter');
		$grid1.isotope({ filter: filterValue });
		$innergrid.isotope({ filter: filterValue });
	});
	// change is-checked class on buttons
	$('.button-group').each(function (i, buttonGroup) {
		var $buttonGroup = $(buttonGroup);
		$buttonGroup.on('click', 'button', function () {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$(this).addClass('is-checked');
		});
	});

}); //document close
