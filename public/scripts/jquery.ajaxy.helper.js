(function($){

	// Cache
	var BalCMS = $.BalCMS, Ajaxy = $.Ajaxy||false, Sparkle = $.Sparkle||false, ie = $.browser.msie;

	$(function(){
		// Fetch elements
		var $body = $(document.body),
			$content = $('article:first').parent().opacityFix(),
			$menu = $('#nav-main'),
			$search = $('#search');

		// Ajaxy OnReady
		Ajaxy.onReady(function(){
			// Add Ajaxy to Search
			$search.addAjaxy('page');

			// Sparkle
			$body.sparkle()
		});

		// Configure Ajaxy
		Ajaxy.configure({
			'options': {
				root_url: BalCMS.options.root_url,
				base_url: BalCMS.options.base_url,
				debug: BalCMS.options.debug,
				request_match: true,
				redirect: 'postpone',
				relative_as_base: false,
				support_text: false,
				track_all_anchors: true,
				track_all_internal_links: true,
				scrollto_content: true,
				aliases: [
					['','/']
				]
			},
			'Controllers': {
				'_generic': {
					request: function(){
						// Log what is happening
						if ( Ajaxy.options.debug ) window.console.debug('$.Ajaxy.configure.Controllers._generic.request', [this,arguments]);

						// Loading
						$body.addClass('loading');

						// Done
						return true;
					},
					response: function(){
						// Prepare
						var data = this.State.Response.data; var state = this.state||'unknown';

						// Log what is happening
						if ( Ajaxy.options.debug ) window.console.debug('$.Ajaxy.configure.Controllers._generic.response', [this,arguments], data, state);

						// Title
						var title = data.title||false; // if we have a title in the response JSON
						if ( !title && this.state||false ) title = 'jQuery Ajaxy - '+this.state; // if not use the state as the title
						if ( title ) document.title = title; // if we have a new title use it

						// Loaded
						$body.removeClass('loading');

						// Display State
						$('#current').text('Our current state is: ['+state+']');

						// Return true
						return true;
					},
					refresh: function(){
						// Prepare
						var data = this.State.Response.data; var state = this.state||'unknown';

						// Loaded
						$body.removeClass('loading');

						// Done
						return true;
					},
					error: function(){
						// Prepare
						var data = this.State.Error.data||this.State.Response.data, State = this.State, state = this.state||'unknown';

						// Error
						var error = data.error||data.responseText||false;
						var error_message = data.content||error;

						// Log what is happening
						if ( Ajaxy.options.debug ) window.console.error('$.Ajaxy.configure.Controllers._generic.error', [this, arguments], error_message);

						// Loaded
						$body.removeClass('loading');

						// Display State
						var url = State.clean.location;
						window.console.error(error_message);
						$content.stop(true,true).show().html('<div class="log"><div class="event error"><span class="message"><strong>An error occurred.</strong><br/>You may try to access the requested page manually by visiting: <a href="'+url+'">'+url+'</a></span></div></div>');

						// Done
						return true;
					}
				},

				'page': {
					classname: 'ajaxy-page',
					matches: /^.*$/,
					request: function(){
						// Log what is happening
						if ( Ajaxy.options.debug ) window.console.debug('$.Ajaxy.configure.Controllers.page.request', [this,arguments]);

						// Adjust Menu
						$menu.find('li.active').removeClass('active');

						// Hide Content
						$content.stop(true,true).fadeOut(800);

						// Return true
						return true;
					},
					response: function(){
						// Prepare
						var Action = this; var data = this.State.Response.data; var state = this.state; var State = this.State;

						// Log what is happening
						if ( Ajaxy.options.debug ) window.console.debug('$.Ajaxy.configure.Controllers.page.response', [this,arguments], data, state);

						// Adjust Menu
						$menu.find('a[href$="'+state+'"]').parent().addClass('active').siblings('.active').removeClass('active');

						// Prepare Content
						$content.stop(true,true).html(data.content);
						$content.sparkle();

						// Display Content
						$content.delay(100).fadeIn(400,function(){
							Action.documentReady({
								'content': $content,
								'auto_sparkle_documentReady': false,
								'auto_ajaxify_documentReady': false
							});
						});

						// Return true
						return true;
					},
					refresh: function(){
						// Prepare
						var Action = this; var data = this.State.Response.data; var state = this.state; var State = this.State;

						// Log what is happening
						if ( Ajaxy.options.debug ) window.console.debug('$.Ajaxy.configure.Controllers.page.refresh', [this,arguments], data, state);

						// Prepare Content
						$content.stop(true,true).show();

						// Display Content
						Action.documentReady({
							'content': $content
						});

						// Return true
						return true;
					}
				}
			}
		});

	});

})(jQuery);
