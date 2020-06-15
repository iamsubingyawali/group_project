;(function () {
	
	'use strict';

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var mobileMenuOutsideClick = function() {

		$(document).click(function (e) {
	    var container = $("#fh5co-offcanvas, .js-fh5co-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {

	    	if ( $('body').hasClass('offcanvas') ) {

    			$('body').removeClass('offcanvas');
    			$('.js-fh5co-nav-toggle').removeClass('active');
				
	    	}
	    
	    	
	    }
		});

	};


	var offcanvasMenu = function() {

		$('#page').prepend('<div id="fh5co-offcanvas" />');
		$('#page').prepend('<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle fh5co-nav-white"><i></i></a>');
		var clone1 = $('.menu-1 > ul').clone();
		$('#fh5co-offcanvas').append(clone1);
		var clone2 = $('.menu-2 > ul').clone();
		$('#fh5co-offcanvas').append(clone2);

		$('#fh5co-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
		$('#fh5co-offcanvas')
			.find('li')
			.removeClass('has-dropdown');

		// Hover dropdown menu on mobile
		$('.offcanvas-has-dropdown').mouseenter(function(){
			var $this = $(this);

			$this
				.addClass('active')
				.find('ul')
				.slideDown(500, 'easeOutExpo');				
		}).mouseleave(function(){

			var $this = $(this);
			$this
				.removeClass('active')
				.find('ul')
				.slideUp(500, 'easeOutExpo');				
		});


		$(window).resize(function(){

			if ( $('body').hasClass('offcanvas') ) {

    			$('body').removeClass('offcanvas');
    			$('.js-fh5co-nav-toggle').removeClass('active');
				
	    	}
		});
	};


	var burgerMenu = function() {

		$('body').on('click', '.js-fh5co-nav-toggle', function(event){
			var $this = $(this);


			if ( $('body').hasClass('overflow offcanvas') ) {
				$('body').removeClass('overflow offcanvas');
			} else {
				$('body').addClass('overflow offcanvas');
			}
			$this.toggleClass('active');
			event.preventDefault();

		});
	};



	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};


	var dropdown = function() {

		$('.has-dropdown').mouseenter(function(){

			var $this = $(this);
			$this
				.find('.dropdown')
				.css('display', 'block')
				.addClass('animated-fast fadeInUpMenu');

		}).mouseleave(function(){
			var $this = $(this);

			$this
				.find('.dropdown')
				.css('display', 'none')
				.removeClass('animated-fast fadeInUpMenu');
		});

	};


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

		});
	
	};


	// Loading page
	var loaderPage = function() {
		$(".fh5co-loader").fadeOut("slow");
	};

	var counter = function() {
		$('.js-counter').countTo({
			 formatter: function (value, options) {
	      return value.toFixed(options.decimals);
	    },
		});
	};

	var counterWayPoint = function() {
		if ($('#fh5co-counter').length > 0 ) {
			$('#fh5co-counter').waypoint( function( direction ) {
										
				if( direction === 'down' && !$(this.element).hasClass('animated') ) {
					setTimeout( counter , 400);					
					$(this.element).addClass('animated');
				}
			} , { offset: '90%' } );
		}
	};

	var sliderMain = function() {
		
	  	$('#fh5co-hero .flexslider').flexslider({
			animation: "slide",

			easing: "swing",
			direction: "vertical",

			slideshowSpeed: 5000,
			directionNav: true,
			start: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			},
			before: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			}

	  	});

	  	// $('#fh5co-hero .flexslider .slides > li').css('height', $(window).height());	
	  	// $(window).resize(function(){
	  	// 	$('#fh5co-hero .flexslider .slides > li').css('height', $(window).height());	
	  	// });

	};

	var parallax = function() {

		if ( !isMobile.any() ) {
			$(window).stellar({
				horizontalScrolling: false,
				hideDistantElements: false, 
				responsive: true

			});
		}
	};

	var testimonialCarousel = function(){
		
		var owl = $('.owl-carousel-fullwidth');
		owl.owlCarousel({
			items: 1,
			loop: true,
			margin: 0,
			nav: false,
			dots: true,
			smartSpeed: 800,
			autoHeight: true
		});

	};

	
	$(function(){
		mobileMenuOutsideClick();
		offcanvasMenu();
		burgerMenu();
		contentWayPoint();
		dropdown();
		goToTop();
		loaderPage();
		counterWayPoint();
		counter();
		parallax();
		sliderMain();
		testimonialCarousel();
	});


}());


function check(event) {
	if(event.target.id != 'userName'){
		var displayProfile = document.getElementsByClassName('profile')[0];
		if(displayProfile.classList.contains('displayProfile')){
			displayProfile.classList.remove('displayProfile');
		}
	}

	if(event.target.id !='change-btn' && event.target.id !='change-pass'){
		var form = document.getElementsByClassName('change-password')[0];
		if(form != null){
			if(form.style.display=='block'){
				form.style.display = 'none';
			}
		}
	}

	if(event.target.id != 'evaluate' && event.target.id != 'evaluate-form' 
	&& event.target.id != 'marks' && event.target.id != 'grade' && event.target.id != 'done_btn'){
		var eval = document.getElementsByClassName('evaluate')[0];
		var table = document.getElementsByClassName('limiter')[0];

		if(eval != null && table != null){
			eval.style.display = "none";
			table.style.opacity = "1";
		}
	}
}

function profile(){
	var displayProfile = document.getElementsByClassName('profile')[0];
	displayProfile.classList.toggle('displayProfile');
}

function change() {
	var form = document.getElementsByClassName('change-password')[0];
	var body = document.getElementsByTagName('body')[0];
	form.style.display='block';
}

function hide(event) {
	var div = document.getElementById(event.target.id);
	var nextElement = div.parentNode.nextElementSibling;
	nextElement.classList.toggle('show-contents');
}

function hide_h3(event){
	var div = document.getElementById(event.target.id);
	var nextElement = div.nextElementSibling;
	if(nextElement != null)
	nextElement.classList.toggle('show-contents');
}

function showWindow(event) {
	var button = document.getElementById(event.target.id);
	var window = button.parentElement.previousElementSibling;

	window.style.display = "block";
	button.style.display = "none"
}

function showEvaluation(std_id) {
	var eval = document.getElementsByClassName('evaluate')[0];
	eval.style.display = "block";

	var table = document.getElementsByClassName('limiter')[0];
	table.style.opacity = "0.2";

	var std = document.getElementById('std_id');
	std.value = std_id;
}

function calculateGrade() {
	var marks = document.getElementById('marks');
	marks = marks.value;

	var grade = " ";

	if(marks >=80 && marks <=100) grade = "A+";
	else if(marks >=75 && marks <80) grade = "A";
	else if(marks >=70 && marks <75) grade = "A-";
	else if(marks >=67 && marks <70) grade = "B+";
	else if(marks >=63 && marks <67) grade = "B";
	else if(marks >=60 && marks <63) grade = "B-";
	else if(marks >=57 && marks <60) grade = "C+";
	else if(marks >=53 && marks <57) grade = "C";
	else if(marks >=50 && marks <53) grade = "C-";
	else if(marks >=47 && marks <50) grade = "D+";
	else if(marks >=43 && marks <47) grade = "D";
	else if(marks >=40 && marks <43) grade = "D-";
	else if(marks >=35 && marks <40) grade = "F+";
	else if(marks >=20 && marks <35) grade = "F";
	else if(marks >=5 && marks <20) grade = "F-";
	else if(marks >=0 && marks <5) grade = "G";
	else grade = '-';

	var grades = document.getElementById('grade');
	grades.value = grade;
}



function addAttendance(){
	var table = document.getElementsByClassName('table100')[0];
	var btn = document.getElementsByClassName('add-contents')[0];
	table.style.display = 'none';
	btn.style.display = "none";
	console.log(table.previousSibling);

	var attend = document.getElementsByClassName('attend')[0];
	attend.style.display = 'block';
}

function presentCheck(event) {
	var hide = event.target.previousElementSibling;
	if(event.target.checked){
		event.target.value= 1;
		hide.disabled = true;
	}

	else{
		event.target.value= 0;
		hide.disabled = false;
	}
}

function markAll(){
	var present = document.getElementsByClassName('present');
	var hidden = document.getElementsByClassName('hiddenElements');
	for(var item of present){
		item.checked = true;
	}

	for (var item of hidden){
		item.disabled = true;
	}
}