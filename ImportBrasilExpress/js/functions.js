$().ready(function(e) {
    

	$('ul.navbar-nav li a').click(function (e) {
		if ($(this).attr('href') !== '#') {
			$('ul.navbar-nav li').each(function () {
				$(this).removeClass('active');
			});
			$(this).closest('li').addClass('active');
			self.loadContent($(this).attr('href'));
		}
	});
	
	function loadContent (content, params) {
		if ($('.navbar-collapse').hasClass('in')) {
			$('.navbar-toggle').trigger('click');
		}
		if (params === undefined) {
			params = '';
		}
		$('#content').hide();
		if (content[0] === '#') {
			content = content.substr(1);
		}
		$('#content').load(content + '.php?' , function () {
		});
		if (content === 'home') {
			$('#content').show();
		}
	};

	$('#login').click(function(){
		loadContent('#./inc/login');
		$('#content').show();
	  })
	  
	$('.carousel').carousel({
	  interval: 2500
	})
});