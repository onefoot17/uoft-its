import {closest_polyfill} from "./_closest_polyfill.js"

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
    const body = document.querySelector( 'body' );
    
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
            
            body.classList.add( 'menu-is-open' );
        } else {
            // Menu is open
            menu_main.setAttribute( 'aria-hidden', 'true' );
            menu_toggle.setAttribute( 'aria-expanded', 'false' );
            
            body.classList.remove( 'menu-is-open' );
        }
    }
}, false);
