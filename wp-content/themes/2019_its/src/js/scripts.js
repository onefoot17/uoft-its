// Imports
// Menu Toggle
import {closest_polyfill} from "./_closest_polyfill.js"

// Variables
const html = document.querySelector( 'html' );

// Non-touch device detection
// first time user touches the screen
document.addEventListener( 'touchstart', function addtouchclass( event ) {
    // add "is-touch" class to document root using classList API
    html.classList.add( 'is-touch' );

    // de-register touchstart event
    document.removeEventListener( 'touchstart', addtouchclass, false );
}, false )

// Glide slider carousel
const carousels = document.querySelectorAll( '.glide' );

Object.values( carousels ).map( carousel => {
    const slider = new Glide( carousel, {
        type: 'carousel',
        perView: 1
    });
    
    slider.mount();
});

// Menu Toggle
closest_polyfill();


document.addEventListener( 'click', function ( event ) {
	if ( event.target.closest( ( '.menu-toggle' ) ) ) {
        const type = event.type,
            menu_toggle = event.target.closest( ( '.menu-toggle' ) ),
            menu_main = document.querySelector( menu_toggle.getAttribute( 'data-href' ) );

        // Return if key pressed was not Space Bar or Enter
        if ( type === 'keydown' && ( event.keyCode !== 13 && event.keyCode !== 32 ) ) {
            return true;
        }

        event.preventDefault();

        if ( menu_main.getAttribute( 'aria-hidden' ) === 'true' ) {
            // Menu is closed
            menu_main.setAttribute( 'aria-hidden', 'false' );
            menu_toggle.setAttribute( 'aria-expanded', 'true' );
            
            html.classList.add( 'menu-open' );
        } else {
            // Menu is open
            menu_main.setAttribute( 'aria-hidden', 'true' );
            menu_toggle.setAttribute( 'aria-expanded', 'false' );
            
            html.classList.remove( 'menu-open' );
        }
    }
}, false);
