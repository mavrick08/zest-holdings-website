/**
 * Zest Holdings – navigation and form helpers (vanilla JS, no jQuery).
 */
( function () {
	'use strict';

	var header = document.getElementById( 'site-header' );
	var nav = document.getElementById( 'primary-nav' );
	var toggle = document.querySelector( '.nav-toggle' );
	var mobile = window.matchMedia( '(max-width: 1320px)' );

	// Mobile menu open/close.
	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var open = toggle.getAttribute( 'aria-expanded' ) === 'true';
			toggle.setAttribute( 'aria-expanded', String( ! open ) );
			nav.classList.toggle( 'is-open', ! open );
		} );
	}

	// Sub-menu toggle buttons (keyboard + touch friendly).
	if ( nav ) {
		nav.querySelectorAll( '.menu-item-has-children' ).forEach( function ( item, i ) {
			var link = item.querySelector( 'a' );
			var sub = item.querySelector( '.sub-menu' );
			if ( ! link || ! sub ) {
				return;
			}
			sub.id = sub.id || 'sub-menu-' + i;
			var btn = document.createElement( 'button' );
			btn.type = 'button';
			btn.className = 'submenu-toggle';
			btn.setAttribute( 'aria-expanded', 'false' );
			btn.setAttribute( 'aria-controls', sub.id );
			btn.setAttribute( 'aria-label', 'Show ' + link.textContent.trim() + ' sub-menu' );
			btn.innerHTML = '<svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
			link.after( btn );

			btn.addEventListener( 'click', function () {
				var open = item.classList.toggle( 'is-open' );
				btn.setAttribute( 'aria-expanded', String( open ) );
			} );
		} );

		// Escape closes any open dropdown / the mobile menu.
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key !== 'Escape' ) {
				return;
			}
			nav.querySelectorAll( '.is-open' ).forEach( function ( el ) {
				el.classList.remove( 'is-open' );
			} );
			nav.querySelectorAll( '.submenu-toggle' ).forEach( function ( b ) {
				b.setAttribute( 'aria-expanded', 'false' );
			} );
			if ( toggle && mobile.matches && toggle.getAttribute( 'aria-expanded' ) === 'true' ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
				nav.classList.remove( 'is-open' );
				toggle.focus();
			}
		} );

		// Close the mobile menu after following an in-page link.
		nav.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( 'a[href*="#"]' ) && toggle ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
				nav.classList.remove( 'is-open' );
			}
		} );
	}

	// Header shadow on scroll.
	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 10 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	// Accessible client-side validation (server validates again).
	document.querySelectorAll( '.zest-form' ).forEach( function ( form ) {
		form.addEventListener( 'submit', function ( e ) {
			var firstInvalid = null;
			form.querySelectorAll( '.field' ).forEach( function ( field ) {
				var input = field.querySelector( 'input, select, textarea' );
				var old = field.querySelector( '.field-error' );
				if ( old ) {
					old.remove();
				}
				field.classList.remove( 'has-error' );
				if ( ! input ) {
					return;
				}
				input.removeAttribute( 'aria-invalid' );

				var message = '';
				if ( input.required && ! input.value.trim() ) {
					message = 'This field is required.';
				} else if ( input.type === 'email' && input.value && ! /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( input.value ) ) {
					message = 'Please enter a valid email address.';
				} else if ( input.type === 'tel' && input.value && input.value.replace( /\D/g, '' ).length < 8 ) {
					message = 'Please enter a valid phone number.';
				} else if ( input.type === 'file' && input.files && input.files[ 0 ] && input.files[ 0 ].size > 5 * 1024 * 1024 ) {
					message = 'File is larger than 5 MB.';
				}

				if ( message ) {
					var err = document.createElement( 'span' );
					err.className = 'field-error';
					err.id = input.id + '-error';
					err.textContent = message;
					field.appendChild( err );
					field.classList.add( 'has-error' );
					input.setAttribute( 'aria-invalid', 'true' );
					input.setAttribute( 'aria-describedby', err.id );
					firstInvalid = firstInvalid || input;
				}
			} );
			if ( firstInvalid ) {
				e.preventDefault();
				firstInvalid.focus();
			} else {
				var btn = form.querySelector( 'button[type="submit"]' );
				if ( btn ) {
					btn.disabled = true;
					btn.textContent = 'Sending…';
				}
			}
		} );
	} );
}() );
