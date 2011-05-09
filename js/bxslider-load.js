jQuery(function(){
	jQuery('#slider').bxSlider({
		easing: 'jswing',
		mode: 'horizontal',
		pager: true,
		speed: 700,
		auto: true,
		autoControls: false,
		nextText: '',
		prevText: '',
		pagerSelector: '.bx-pager'
	});
});