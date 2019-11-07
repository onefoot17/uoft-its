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
	if ( event.target.closest( ( '.menu-toggle' ) ) ) {
        const type = event.type,
        button = event.target.closest( ( '.menu-toggle' ) ),
        content = document.querySelector( button.getAttribute( 'data-href' ) );

        // Return if key pressed was not Space Bar or Enter
        if ( type === 'keydown' && ( event.keyCode !== 13 && event.keyCode !== 32 ) ) {
            return true;
        }

        event.preventDefault();

        if ( content.getAttribute( 'aria-hidden' ) === 'true' ) {
            content.setAttribute( 'aria-hidden', 'false' );
            button.setAttribute( 'aria-expanded', 'true' );
        } else {
            content.setAttribute( 'aria-hidden', 'true' );
            button.setAttribute( 'aria-expanded', 'false' );
        }
	}
}, false);
