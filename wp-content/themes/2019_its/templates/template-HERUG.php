<?php
/*
Template Name: HERUG Page Template
*/
?>

<?php get_header("landing"); ?>

<style type="text/css">
.herug {
    padding: 0;
}

.left {
    width: 67%;
}

.right {
    width: 28%;
    margin-left: 5%;
    min-width: 290px;
}

.row-fluid {
    display: flex;
}

.header {
    padding: 2rem 2rem 2rem 6rem !important;
    justify-content: space-between;
}

.header-image {
    padding: 0;
    /* background: blue; */
    /* border-bottom: 10px solid #892652; */
    border-bottom: 10px solid var(--blue-light);
    display: flex;
    width: 100%;
    height: 38vw;
}


.header-image {
    margin: auto;
    width: 100%;
    position: relative;
    display: flex !important;
    flex-direction: column;
    /* justify-content: center; */
}

img.herug-logo {
    position: relative;
    z-index: 1;
    margin-left: 50px;
    padding-top: 11vw;
    width: 23vw;
}


.cta-button {
    position: relative;
    z-index: 1;
    margin-left: 60px;
    width: 22%;
    margin-top: 1%;
    color: white;
}

.nav__esc__text {
    color: white;
}

.nav__image-con .nav__esc__image-con {
    color: white;
}

i.fa .fa-envelope {
    color: white;
}

.herug-banner {
    z-index: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    min-height: 37.5vw;
    height: auto;
}




.sidebar-box {
    border: 1px solid #c4c4c4;
    padding: 5px 25px 10px 25px;
    margin-top: 20px;
}

#social {
    padding-top: 12px;
    min-width: 245px;
}

.herug h1,
.herug h2,
.herug h3,
.herug h4,
.sidebar-box h3 a {
    /* color: #892652; */
    color: var(--blue-light);

}

.herug h1 {
    font-size: 32px;
    margin-bottom: 30px;
}

.herug h2 {
    font-size: 24px;
    font-weight: normal;
}

.herug h3,
.sidebar-box h3 a {
    font-size: 24px;
    font-weight: bold;
    padding-top: 0;
    padding-bottom: 10px;
    margin-bottom: 0;
}

.herug h4 {
    font-size: 18px;
}


.herug button {
    padding: 15px;
    background: #FFB616;
    font-size: 16px;
    font-weight: bold;
    color: black;
    margin-top: 20px;
    width: 100%;
}

#social p,
#nav p {
    margin-bottom: 0;
    display: inline-flex;
}

#social i {
    font-size: 30px;
    margin-right: 15px;
}

span.twitter {
    color: #38A1F3;
}

#nav i {
    font-size: 40px;
    width: 28%;
    color: #8f8f8f;
    text-align: center;
}

.sidebar-box ul {
    list-style: none;
    margin: 0;
}

.sidebar-box#nav h3 {
    margin-bottom: 25px;
}

.sidebar-box li {
    margin-bottom: 25px;
}

span.link {
    vertical-align: super;
}

#nav span.link {
    margin-left: 20px;
}

span.notice {
    /* color: #892652; */
    color: var(--blue-light);
}

.legacy a {
    color: var(--blue-light);
}

.sidebar-box .ms-nav-next {
    width: 35px !important;
    height: 35px !important;
    right: -20px !important;
    background-position: -90px -107.5px !important;
}

.sidebar-box .ms-nav-prev {
    left: -20px !important;
    width: 35px !important;
    height: 35px !important;
    background-position: -92px -30.5px !important;
}

.sidebar-box .ms-skin-light-6 .ms-bullets.ms-dir-h {
    bottom: -10px !important;
    width: 100% !important;
    position: relative;
    margin-bottom: 60px;
}

.sidebar-box .master-slider-parent {
    padding-bottom: 0px;
}

/* NAV MENU FIXES  */

li.menu-has-children {
    position: relative;
}


.sub-menu {
    display: none;
    position: absolute;
    width: auto;
    min-width: 150px;
    padding: 0;
    margin-left: -10px;
    background-color: var(--blue-medium);
    margin-top: 58px;
}

.mobileMenuToggle {
    font-size: 3rem;
    color: white;
    display: none;
}

.twitter {
    color: white;
    font-size: 2rem;
}

.envelope {
    color: white;
    font-size: 2rem;
}






@media screen and (max-width: 1020px) {

    .herug nav,
    .herug .left {
        padding-left: 20px;
    }

    .herug nav,
    .sidebar-buttons,
    #social,
    #gallery {
        padding-right: 20px;
    }

    .sidebar-box {
        margin-right: 20px;
    }
}

@media screen and (max-width: 960px) {
    .herug img.alignright {
        float: none;
        margin-left: 0;
    }

    .header-image {
        padding: 0;
        /* background: blue; */
        /* border-bottom: 10px solid #892652; */
        border-bottom: 10px solid var(--blue-light);
        display: flex;
        width: 100%;
        height: 38vw;
    }


    .header-image {
        margin: auto;
        width: 100%;
        position: relative;
        display: flex !important;
        flex-direction: column;
        /* justify-content: center; */
    }

    img.herug-logo {
        position: relative;
        z-index: 1;
        margin-left: 2vw;
        padding-top: 0;
        width: 50vw;
        margin: auto;
        margin-bottom: 14vw;
    }


    .cta-button {
        position: relative;
        z-index: 1;
        margin-left: 2.5vw;
        width: 50vw;
        margin: auto;
        color: white;
    }

    .nav__esc__text {
        color: white;
    }

    .nav__image-con .nav__esc__image-con {
        color: white;
    }

    i.fa .fa-envelope {
        color: white;
    }

    .herug-banner {
        z-index: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 38vw;
        height: auto;
    }




}

@media screen and (max-width: 710px) {
    .herug .left {
        width: 100%;
        padding-right: 20px;
    }

    .herug .right {
        width: 100%;
        margin-left: 0;
    }

    .herug .row-fluid {
        display: flex;
        flex-direction: column-reverse;
    }

    .sidebar-buttons {
        text-align: center;
        padding-left: 20px;
    }

    .sidebar-box {
        border: 0;
        padding: 0;
        text-align: center;
    }

    #social {
        width: 47%;
        margin: auto;
        padding-right: 0;
        padding-top: 0
    }

    #nav {
        clear: both;
        background: #f0f0f0;
        padding: 10px 0 30px 0;
        margin-bottom: 15px;
        margin-right: 0;
        display: inline-block;
    }

    #nav i {
        color: #777777;
        width: 100%;
    }

    #nav i::before {
        margin-left: 10px;
    }

    #nav span.link {
        margin-left: 0;
    }

    #nav ul {
        display: inline-flex;
        width: 100%;
        margin-top: 20px;
    }

    #nav li {
        text-align: center;
        margin-bottom: 0;
        width: 50%;
    }

    #nav h3,
    #gallery {
        display: none;
    }

    div.list {
        display: inline-flex;
        text-align: center;
        width: 100%;
    }

    #nav h3 {
        margin-bottom: 10px;
    }

    .herug button {
        width: 50%;
        min-width: 280px;
    }
}



@media screen and (max-width: 535px) {
    .sidebar-buttons {
        width: 100%;
    }

    #social {
        margin: auto;
        float: none;
        clear: both;
    }

    .mobileMenuToggle {
        display: block;
        text-align: right;
        cursor: pointer;
    }

    .sub-menu {
        display: block;
        position: relative;
        padding-left: 5%;
        margin-top: 0;
        background-color: inherit;
    }

    .submission {
        padding-top: 0;
        margin-bottom: 5px;
        text-align: center;
    }
}

@media screen and (max-width: 430px) {
    div.list {
        display: block;
    }

    .herug button {
        min-width: inherit;
        width: 95%;
    }

    #nav {
        padding: 0 0 10px 0;
    }
}

/* The Modal (background) */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
    position: fixed;
    top: 10% !important;
    left: 10% !important;
    width: 80% !important;
    margin: auto !important;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>


<main class="content legacy herug">
    <section class="header-image">
        <img class="herug-logo" src="https://main.its.utoronto.ca/wp-content/uploads/2020/01/herug-logo.png">
        <!-- <a href="mailto:herug2020@utoronto.ca?Subject=HERUG2020" class="nav__top__button nav__esc cta-button"
            style="background-color: var(--blue-dark);">
            <section class="nav__image-con nav__esc__image-con">
                <i style="color: white;" class="fa fa-envelope"> </i>
            </section>

            <section class="nav__esc__text">Click here to learn more</section>
        </a> -->
        <img class="herug-banner" src="https://main.its.utoronto.ca/wp-content/uploads/2020/01/herug-banner.jpg">
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
<script>
if (navigator.userAgent.toLowerCase().indexOf("msie") > -1) {
    alert("This site is best viewed in a modern browser.")
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php get_footer(); ?>
