$('.sidebar-menu li').each(function(){
	if ($(this).hasClass('active')) {
		$(this).parent('ul').parent('li').addClass('active');
	}
});