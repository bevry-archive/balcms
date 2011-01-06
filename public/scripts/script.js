/**
 * jQuery App (balupton edition) - Application Resource Library
 * Copyright (C) 2010 Benjamin Arthur Lupton
 * http://www.balupton.com/projects/jquery-app
 *
 * This file is part of jQuery App (balupton edition).
 *
 * jQuery App (balupton edition) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * jQuery App (balupton edition) is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with jQuery Lightbox (balupton edition).  If not, see <http://www.gnu.org/licenses/>.
 *
 * @name jquery_app: jquery.app.js
 * @package jQuery App (balupton edition)
 * @version 1.0.0-dev
 * @date January 10, 2010
 * @category jQuery plugin
 * @author Benjamin "balupton" Lupton {@link http://www.balupton.com}
 * @copyright (c) 2009 Benjamin Arthur Lupton {@link http://www.balupton.com}
 * @license GNU Affero General Public License - {@link http://www.gnu.org/licenses/agpl.html}
 * @example Visit {@link http://www.balupton.com/projects/jquery-app} for more information.
 */

(function($){

	// Construct
	$.BalCMS = {
		// Options
		options: {
			// Auto-Set by CMS
			root_url: null,
			base_url: null,
			debug: true
		}
	};

	// Cache
	var BalCMS = $.BalCMS, Ajaxy = $.Ajaxy||false, Sparkle = $.Sparkle||false, ie = $.browser.msie;

	// DomReady
	$(function(){
		// Hide Log Event Details
		$('.log .event').click(function(){
			$(this).find('.details').toggle();
		});
	});

})(jQuery);
