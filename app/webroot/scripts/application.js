$(function() {
	
	// Target blank
	$("a").click(function(e) {
		  e.preventDefault();
		  window.open(this.href, "_blank");
	});
	
	$.fn.placeholder = function(options) {
		return this.each(function() {
			if ( !("placeholder"	in document.createElement(this.tagName.toLowerCase()))) {
				var $this = $(this);
				var placeholder = $this.attr('placeholder');
				$this.val(placeholder);
				$this
					.focus(function(){ if ($.trim($this.val())==placeholder){ $this.val(''); }; })
					.blur(function(){ if (!$.trim($this.val())){ $this.val(placeholder); }; });
			}
		});
	};
	
	$('input[placeholder]').placeholder();
	
	if ($('.alert').length > 0) {
		setTimeout(function() {
			$('.alert').slideUp('fast');
		}, 1000);
	}

});