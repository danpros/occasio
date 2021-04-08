/* global occasioScreenReaderText */
/**
 * Theme Navigation
 *
 * @package Occasio
 */
 
 
(function ($) {
    $.fn.tabbedWidget = function (widget) {
        var instance = "#" + widget.attr("id");
        $(instance + " .tzwb-tabnavi li a:first").addClass("current-tab");
        $(instance + " .tzwb-tabcontent").hide();
        $(instance + " .tzwb-tabcontent:first").show();
        $(instance + " .tzwb-tabnavi li a").click(function () {
            $(instance + " .tzwb-tabnavi li a").removeClass("current-tab");
            $(this).addClass("current-tab");
            $(instance + " .tzwb-tabcontent").hide();
            var activeTab = $(this).attr("href");
            $(activeTab).fadeIn("fast");
            return !1;
        });
    };
    function initTabbedWidget(widget) {
        widget.find(".tzwb-tabbed-content").tabbedWidget(widget);
    }
    $(document).ready(function () {
        $(".tzwb-tabbed-content").each(function () {
            initTabbedWidget($(this));
        });
    });
})(jQuery);

(function( $ ) {

	function initNavigation( containerClass, naviClass ) {
		var container  = $( containerClass );
		var navigation = $( naviClass );

		// Return early if navigation is missing.
		if ( ! navigation.length ) {
			return;
		}

		// Enable menuToggle.
		(function() {
			var menuToggle = container.find( '.menu-toggle' );

			// Return early if menuToggle is missing.
			if ( ! menuToggle.length ) {
				return;
			}

			// Add an initial value for the attribute.
			menuToggle.attr( 'aria-expanded', 'false' );

			menuToggle.on( 'click.occasio_', function() {
				navigation.toggleClass( 'toggled-on' );

				$( this ).attr( 'aria-expanded', navigation.hasClass( 'toggled-on' ) );
			});
		})();

		// Enable dropdownToggles that displays child menu items.
		(function() {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle-button',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );;

			navigation.find( '.item.dropdown > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.item.dropdown.active > button' ).addClass( 'toggled-on' );
		container.find( '.item.dropdown.active > .sub-menu' ).addClass( 'toggled-on' );

			navigation.find( '.dropdown-toggle-button' ).click( function( e ) {
				var _this = $( this ),
					screenReaderSpan = _this.find( '.screen-reader-text' );

				e.preventDefault();
				_this.toggleClass( 'toggled-on' );
				_this.next( '.children, .sub-menu, .subnav, .dropdown-menu' ).toggleClass( 'toggled-on' );

				_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

				screenReaderSpan.text( screenReaderSpan.text() === occasioScreenReaderText.expand ? occasioScreenReaderText.collapse : occasioScreenReaderText.expand );
			} );
		})();

		// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
		(function() {
			var menuList   = navigation.children( 'ul.menu' );

			if ( ! menuList.length || ! menuList.children().length ) {
				return;
			}

			// Toggle `focus` class to allow submenu access on tablets.
			function toggleFocusClassTouchScreen() {
				if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

					$( document.body ).on( 'touchstart.occasio_', function( e ) {
						if ( ! $( e.target ).closest( naviClass + ' li' ).length ) {
							$( naviClass + ' li' ).removeClass( 'focus' );
						}
					});

					menuList.find( '.menu-item-has-children > a, .page_item_has_children > a' )
						.on( 'touchstart.occasio_', function( e ) {
							var el = $( this ).parent( 'li' );

							if ( ! el.hasClass( 'focus' ) ) {
								e.preventDefault();
								el.toggleClass( 'focus' );
								el.siblings( '.focus' ).removeClass( 'focus' );
							}
						});

				} else {
					menuList.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.occasio_' );
				}
			}

			if ( 'ontouchstart' in window ) {
				$( window ).on( 'resize.occasio_', toggleFocusClassTouchScreen );
				toggleFocusClassTouchScreen();
			}

			menuList.find( 'a' ).on( 'focus.occasio_ blur.occasio_', function() {
				$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
			});
		})();
	}

	// Init Main Navigation.
	initNavigation( '.header-main', '.main-navigation' );

	// Init Top Navigation.
	initNavigation( '.header-bar', '.top-navigation' );

})( jQuery );


