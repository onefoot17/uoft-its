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
    .herug h1, .herug h2, .herug h3,
    .herug h4, .sidebar-box h3 a{ color: #892652; }

    .herug h1{
        font-size: 32px;
        margin-bottom: 30px;}
    .herug h2{
        font-size: 24px;
        font-weight: normal;}
    .herug h3, .sidebar-box h3 a{
        font-size: 24px;
        font-weight: bold;
        padding-top: 0;
        padding-bottom: 10px;
        margin-bottom: 0;}
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
    .sidebar-box#nav h3{ margin-bottom: 25px; }
    .sidebar-box li{ margin-bottom: 25px; }
    span.link{ vertical-align: super;}
    #nav span.link{margin-left: 20px;}
    span.notice{ color: #892652; }

    .sidebar-box .ms-nav-next{
        width: 35px !important;
        height: 35px !important;
        right: -20px !important;
        background-position: -90px -107.5px !important;
    }
    .sidebar-box .ms-nav-prev{
        left: -20px !important;
        width: 35px !important;
        height: 35px !important;
        background-position: -92px -30.5px !important;
    }
    .sidebar-box .ms-skin-light-6 .ms-bullets.ms-dir-h{
        bottom: -10px !important;
        width: 100% !important;
        position: relative;
        margin-bottom: 60px;
    }
    .sidebar-box .master-slider-parent{ padding-bottom: 0px; }

    @media screen and (max-width: 1020px){
        .herug nav, .herug .left{ padding-left: 20px; }
        .herug nav, .sidebar-buttons, #social, #gallery{ padding-right: 20px; }
        .sidebar-box{ margin-right: 20px;}
    }
    @media screen and (max-width: 960px){
        .herug img.alignright{ float: none; margin-left: 0;}
    }
    @media screen and (max-width: 710px){
        .herug .left{width: 100%; padding-right: 20px;}
        .herug .right{width: 100%; margin-left: 0;}
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
            margin: auto;
            padding-right: 0;
            padding-top: 0
        }
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
        <img src="http://main.its.utoronto.ca/wp-content/uploads/2019/12/HERUG-banner.jpg"></img> 
    </section>
    <section class="section__width">

        <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

        <div class="row-fluid">

            <?php if ( is_active_sidebar( 'herug-sidebar' ) ): ?>

                <div class="left">
                    <h1><?php the_title(); ?></h1>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>

                <div class="right">

                    <?php dynamic_sidebar('herug-sidebar') ?>

                </div>

            <?php else: ?>
                <div class="left" style="width: 100%; padding-right: 20px;">
                    <h1><?php the_title(); ?></h1>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>


<?php get_footer(); ?>
