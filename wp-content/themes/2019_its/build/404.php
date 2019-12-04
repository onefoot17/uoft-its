<?php get_header(); ?>

<main id="content">
    <section class="section section--category">
        <section class="section__width section--category__width">
        
            <h1 class="search-not-found-title"><?php esc_html_e( '404', 'its_2019' ); ?></h1>
            
            <p class="search-not-found-text"><?php esc_html_e( 'Nothing found for the requested page. Try a search instead?', 'its_2019' ); ?></p>

            <section class="search-form-container"><?php get_search_form(); ?></section>
        </section>
    </section>
</main>

<?php get_footer(); ?>
