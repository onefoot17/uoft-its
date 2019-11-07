// Glide slider carousel
const carousels = document.querySelectorAll( '.glide' );

Object.values( carousels ).map( carousel => {
    const slider = new Glide( carousel, {
        type: 'carousel',
        perView: 1
    });
    
    slider.mount();
});
