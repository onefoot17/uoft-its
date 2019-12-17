<?php
/*
Template Name: HERUG Page Template
*/
?>

<?php get_header(); ?>

<style type="text/css">

    .herug{ padding: 0; }
    .left{ width: 67%; }
    .right{
        width: 28%;
        margin-left: 5%;
        min-width: 290px;
    }
    .row-fluid{ display: flex; }
    .header-image{
        padding: 0;
        background: #ccc;
        border-bottom: 10px solid #892652;
        display: flex;
        width: 100%;
    }
    .header-image img{ margin: auto; }
    .sidebar-box{
        border: 1px solid #c4c4c4;
        padding: 5px 25px 10px 25px;
        margin-top: 20px;
    }
    #social{
        padding-top: 12px;
        min-width: 245px;}
    .herug h1, .herug h2, .herug h3, .herug h4{ color: #892652; }
    .herug h1{ font-size: 32px; }
    .herug h2{
        font-size: 24px;
        font-weight: normal;}
    .herug h3{
        font-size: 24px;
        font-weight: bold;
        padding-top: 0;
        padding-bottom: 10px;}
    .herug h4{ font-size: 18px;}


    .herug button{
        padding: 15px;
        background: #FFB616;
        font-size: 16px;
        font-weight: bold;
        color: black;
        margin-top: 20px;
        width: 100%;
    }
    #social p, #nav p{
        margin-bottom: 0;
        display: inline-flex;
    }
    #social i{
        font-size: 30px;
        margin-right: 15px;
    }
    span.twitter{color: #38A1F3;}
    #nav i{
        font-size: 40px;
        width: 28%;
        color: #8f8f8f;
        text-align: center;
    }
    .sidebar-box ul{ list-style: none; margin: 0;}
    .sidebar-box h3{ margin-bottom: 25px; }
    .sidebar-box li{ margin-bottom: 25px; }
    span.link{ vertical-align: super;}
    #nav span.link{margin-left: 20px;}
    span.notice{ color: #892652; }

    @media screen and (max-width: 1020px){
        .herug nav, .herug .left{ padding-left: 20px; }
        .herug nav, .sidebar-buttons, #social, #gallery{ padding-right: 20px; }
        .sidebar-box{ margin-right: 20px;}
    }
    @media screen and (max-width: 960px){
        .herug img.alignright{ float: none; margin-left: 0;}
    }
    @media screen and (max-width: 650px){
        .left{width: 100%;}
        .right{width: 100%; margin-left: 0;}
        .herug .row-fluid{
            display: flex;
            flex-direction: column-reverse;}
        .sidebar-buttons{ text-align: center; padding-left: 20px;}
        .sidebar-box{
            border: 0;
            padding: 0;
            text-align: center;}
        #social{
            width: 47%;
            margin: auto;}
        #nav{
            clear: both;
            background: #f0f0f0;
            padding: 10px 0 30px 0;
            margin-bottom: 15px;
            margin-right: 0;
            display: inline-block;
        }
        #nav i{ color: #777777; width: 100%;}
        #nav i::before{margin-left: 10px;}
        #nav span.link{ margin-left: 0;}
        #nav ul{
            display: inline-flex;
            width: 100%;
            margin-top: 20px;}
        #nav li{
            text-align: center;
            margin-bottom: 0;
            width: 50%;
        }
        #nav h3, #gallery{ display: none;}
        div.list{
            display: inline-flex;
            text-align: center;
            width: 100%;}
        #nav h3{ margin-bottom: 10px;}
        .herug button{width: 50%; min-width: 280px;}
    }
    @media screen and (max-width: 535px){
        .sidebar-buttons{ width: 100%;}
        #social{ margin: auto; float: none; clear: both;}
    }
    @media screen and (max-width: 430px){
        div.list{ display: block;}
        .herug button{ min-width: inherit; width: 95%;}
        #nav{padding: 0 0 10px 0;}
    }

</style>


<main class="content legacy herug">
    <section class="header-image">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/HERUG-banner.jpg"></img>
    </section>
    <section class="section__width">

        <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

        <div class="row-fluid">

            <div class="left">
                <h1><?php the_title(); ?></h1>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
            </div>

            <div class="right">

                <?php if ( (get_field('herug-buttons')) and (get_field('herug-buttons-display')) ): ?>
        			<div class="sidebar-buttons">
        				<?php the_field('herug-buttons'); ?>
        			</div>
                <?php else: //do nothing ?>
        		<?php endif; ?>

                <?php if ( (get_field('herug-social')) and (get_field('herug-social-display')) ): ?>
        			<div class="sidebar-box" id="social">
        				<?php the_field('herug-social'); ?>
        			</div>
                <?php else: //do nothing ?>
        		<?php endif; ?>

                <?php if ( (get_field('herug-nav')) and (get_field('herug-nav-display')) ): ?>
        			<div class="sidebar-box" id="nav">
        				<?php the_field('herug-nav'); ?>
        			</div>
                <?php else: //do nothing ?>
        		<?php endif; ?>

                <?php if ( (get_field('herug-gallery')) and (get_field('herug-gallery-display')) ): ?>
        			<div class="sidebar-box" id="gallery">
        				<?php the_field('herug-gallery'); ?>
        			</div>
                <?php else: //do nothing ?>
        		<?php endif; ?>

            </div>

        </div>
    </section>
</main>


<?php get_footer(); ?>
