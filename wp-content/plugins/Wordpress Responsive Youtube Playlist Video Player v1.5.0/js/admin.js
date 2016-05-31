(function($){
	$(document).ready(function() {
		
		// Load correct admin tab
		var $_GET = {};
		document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
		    function decode(s) {
		        return decodeURIComponent(s.split("+").join(" "));
		    }
		    $_GET[decode(arguments[1])] = decode(arguments[2]);
		});

		if('page' in $_GET && $_GET['page'] == 'ytp-youtube' && 'tab' in $_GET) {
			var tab = $_GET['tab'];
			open_admin_tab(tab);
		}

		$(".ytp-a-tabs a").click(function(e) {
			e.preventDefault();
			open_admin_tab($(this).attr('data-tab'));
		});

		function open_admin_tab(name) {
			var $this = $(".ytp-a-tabs a[data-tab="+name+"]");
			if($this.parent().hasClass('ytp-a-tabs-active')) {
				return;
			}
			$(".ytp-a-tabs li").removeClass('ytp-a-tabs-active');
			$this.parent().addClass('ytp-a-tabs-active');
			$(".ytp-a-tab").hide();
			$("#ytp-a-tab-"+$this.attr('data-tab')).show();

			var action = $(".ytp-a-form").attr('data-original-action');

			$(".ytp-a-form").attr('action', action+'&tab='+name);
		}

		$(".ytp-checkbox").click(function(e) {
			e.preventDefault();
			var $this = $(this),
				checked = ($this.attr('data-checked') == '1') ? true : false,
				check_id = $this.attr('data-id'),
				$checkbox = $this.siblings('#'+check_id);
			if(checked) {
				// $this.attr('data-checked', '0').html('NO');
				$this.attr('data-checked', '0').html('<i class="fa fa-times"></i>');
				$checkbox.val('0');
			}else {
				// $this.attr('data-checked', '1').html('YES');
				$this.attr('data-checked', '1').html('<i class="fa fa-check"></i>');
				$checkbox.val('1');
			}
			if($this.attr('data-toggle')) {
				var $el = $($this.attr('data-toggle'));
				if($el.css('display') == 'none') {
					$el.fadeIn();
				}else {
					$el.hide();
				}
			}
		});

		$('.ytp-color-picker').wpColorPicker({
			palettes: false,
		});

		$(".ytp-a-notification-success, .ytp-a-notification-error").click(function(e) {
			e.preventDefault();
			$(this).slideUp(300);
		});

		$(".ytp-reset-colors").click(function(e) {
			e.preventDefault();
			if(!confirm('Are you sure you want to reset the colors back to default?')) {
				return false;
			}
			var colors = {
				controls_bg: 		'#000000',
				buttons: 			'#FFFFFF',
				buttons_hover: 		'#FFFFFF',
				buttons_active: 	'#FFFFFF',
				time_text: 			'#FFFFFF',
				bar_bg: 			'#FFFFFF',
				buffer: 			'#FFFFFF',
				fill: 				'#FFFFFF',
				video_title: 		'#FFFFFF',
				video_channel: 		'#DFF76D',
				playlist_overlay: 	'#000000',
				playlist_title: 	'#FFFFFF',
				playlist_channel: 	'#DFF76D',
				scrollbar: 			'#FFFFFF',
				scrollbar_bg: 		'#FFFFFF',
			};
			var transparencies = {
				controls_bg: 		0.75,
				buttons: 			0.5,
				buttons_hover: 		1,
				buttons_active: 	1,
				time_text: 			1,
				bar_bg: 			0.5,
				buffer: 			0.25,
				fill: 				1,
				video_title: 		1,
				video_channel: 		1,
				playlist_overlay: 	0.75,
				playlist_title: 	1,
				playlist_channel: 	1,
				scrollbar: 			1,
				scrollbar_bg: 		0.25,
			};

			for(key in colors) {
				var color = colors[key],
					transparency = transparencies[key];

				$("input[name=ytp_color_"+key+"_opacity]").val(transparency*100);
				console.log($("input[name=ytp_color_"+key+"_color]").wpColorPicker('color', color));
			}

		});

		$(".ytp-faq > .ytp-faq-title").click(function() {
			$(this).parent().toggleClass('ytp-faq-open')
		});

		$(".ytp-open-help-tab").click(function(e) {
			e.preventDefault();
			open_admin_tab('help');
		});

		$(".ytp-submit").click(function(e) {
			$(this)
				.click(function(e) {
					e.preventDefault()
				})
				.addClass('ytp-submit-clicked')
				.attr('value', 'Please Wait...');
		});

	});

})(jQuery);