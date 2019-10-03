<!DOCTYPE html>
<html> 
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title(''); ?> | ITS | University of Toronto</title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" media="screen, print" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/news.css" media="screen, print" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!-- Adaptive Images -->
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
	<!-- Typekit - It Rocks -->	
	    <script type="text/javascript" src="http://use.typekit.com/hub0gqc.js"></script>
	    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	    <!--[if IE 8]>
	    <script src="<?php bloginfo('template_url'); ?>/js/respond.js"></script>
	    <![endif]-->
	    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>    
	    <![endif]-->
	    <!--[if lt IE 7]>
	    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" media="screen" />
	    <![endif]-->
	<?php
	if (is_singular() && get_option('thread_comments'))
	    wp_enqueue_script('comment-reply');
	?>
	<?php wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jlite.js"></script>
	<script type="text/javascript" language="javascript" src="<?php bloginfo('template_directory');?>/js/jquery.jfontsize.js"></script>
	<script>
	$(function (){
		$('body').jfontsize({
			 	btnMinusClasseId: '.smallFont',
				 btnDefaultClasseId: '.defaultFont',
			    btnPlusClasseId: '.largeFont',
	            btnMinusMaxHits: 5,
	            btnPlusMaxHits: 5,
	            sizeChange: 1
			});
	});
	</script>
	<style>
	.aero {
	    float: right;
	    margin-top: -17px;
	    position: relative;
	    z-index: 9999;
		}
	.top_links{float:right;width:300px; clear:both}	
	</style>
</head>
<body <?php body_class(); ?>>
        <div class="container-fluid">
            <header class="clearfix">
                <a href="http://www.its.utoronto.ca"><h1>University of Toronto Logo</h1></a>
                <a href="http://www.its.utoronto.ca"><h2>Information + Technology Services</h2></a>
                <div class="tools">
		    <?php wp_nav_menu(array('theme_location' => 'header_right', 'container' => 'ul', 'depth' => '1')); ?>
<div class="top_links">

<ul class="qa_buttons">
		
    		<li>
    		    <a class="btn text-shadow" href="http://www.systemstatus.utoronto.ca/">
    			<i class="icon-status"></i>
    			System Status
    		    </a>
    		</li>
    	    </ul>   
                    <!--<div id="fontsize" class="hidden-phone"></div>-->

<div class="hidden-phone" id="font_size"><a title="reduce font size" class="smallFont" href="javascript:void(0);">- A</a> <a title="Reset font size" class="defaultFont" href="javascript:void(0);">A</a> <a title="increase font size" class="largeFont" href="javascript:void(0);">A+</a></div>



		    <?php //get_search_form(); ?>
                </div>
</div>
            </header>
<div style="display:none"> <a href="#" class="smallFont" style="color:#FFFFFF;">Small</a> <a style="color:#FFFFFF;" href="#" class="defaultFont">normal</a> <a style="color:#FFFFFF;" href="#" class="largeFont">big</a>
</div>
            <!-- Main Navigation -->
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <ul>
                                <li>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </li>
                                <li>
                                    <span class="mlabel">Menu</span>
                                </li>
                            </ul>
                        </a>
			<?php wp_nav_menu(array('theme_location' => 'main-demo', 'container' => 'span', 'container_class' => 'nav-collapse', 'menu_class' => 'nav', 'depth' => '2', 'walker' => new bootstrap_walker())); ?>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs -->