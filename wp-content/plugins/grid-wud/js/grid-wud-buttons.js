/**
=== Grid WUD ===
Contributors: wistudat.be
Plugin Name: Grid WUD
Description: Adds 100% responsive, customizable and dynamic grids to WordPress posts and pages.
Author: Danny WUD
Author URI: https://wud-plugins.com
Last Modification: 2017-03-16
 */
 (function($) {

    tinymce.PluginManager.add('grid_wud_mce_button', function(editor, url) {
        editor.addButton('grid_wud_mce_button', {
            icon: true,
            text: " Grid WUD",
			style: 'border-color:#444; background: #82bdf7; -webkit-box-shadow: none !important; box-shadow: none !important;',
			image : url+"/../images/edit-grid-wud.png",
			tooltip: 'Insert grids/tiles into your post/page',
         type: 'listbox',
		 name: 'wud_cat_term',			
            onselect: function(e) {
			var wud_select =this.value();
			if (wud_select=='nothing'){return false;}
			var wud_selected = '';
			var wud_select_tax = '';
			var wud_label = '';
			var wud_info = '';
			var showit = 'none';
			var ctpshow = 'none';
			var wooshow = 'none';
			var banh = 'hidden';
			var post_cats = jQuery.parseJSON(document.getElementById("wud_cats").value);
			var post_tags = jQuery.parseJSON(document.getElementById("wud_tags").value);
			var post_alle = jQuery.parseJSON(document.getElementById("wud_alle").value);
			var page_cats = jQuery.parseJSON(document.getElementById("wud_page_cat").value);
			var page_tags = jQuery.parseJSON(document.getElementById("wud_page_tag").value);
			var woo_list = jQuery.parseJSON(document.getElementById("wud_woo_all").value);	
			var woo_feat = jQuery.parseJSON(document.getElementById("wud_woo_feat").value);	
			var woo_cats = jQuery.parseJSON(document.getElementById("wud_woo_cat").value);
			var woo_tags = jQuery.parseJSON(document.getElementById("wud_woo_tag").value);			
			var tax_alle = jQuery.parseJSON(document.getElementById("wud_tax_all").value);
			
//-----------------------------------------------------------------------------------//
			
	//START SELECT FROM DROPDOWN LIST		
		//Get all possible data, if a DROPDOWN LIST item is selected
			if (wud_select=='category'){				
				wud_selected = post_cats;
				wud_label = "Category";
				wud_info = 'WordPress Post Categories';
			}
			else if (wud_select=='post_tag'){
				wud_selected = post_tags;
				wud_label = "Tag";
				wud_info = 'WordPress Post Tags';
			}
			else if (wud_select=='news'){
				wud_selected = post_alle;				
				wud_label = "Latest Post";
				wud_info = 'WordPress Latest Post';
			}			
			else if (wud_select=='categories'){
				wud_selected = page_cats;
				wud_label = "WUD Page Category";
				wud_info = 'Categories from category-to-pages-wud';
				ctpshow = 'block';
			}
			else if (wud_select=='tags'){
				wud_selected = page_tags;
				wud_label = "WUD Page Tag";
				wud_info = 'Tags from category-to-pages-wud';
				ctpshow = 'block';
			}			
			else if (wud_select=='woo'){	
				if(jQuery.isEmptyObject( woo_cats ) && jQuery.isEmptyObject( woo_tags )){
						wud_selected = ''
				}
				else{
					wud_selected = woo_list;
					wud_label = "WooCommerce";
					wud_info = 'All WooCommerce products';
					showit = 'block';
					wooshow = 'block';				
				}
			}	
			else if (wud_select=='woofeat'){
				if(jQuery.isEmptyObject( woo_cats ) && jQuery.isEmptyObject( woo_tags )){
						wud_selected = ''
				}
				else{				
				wud_selected = woo_feat;
				wud_label = "WooCommerce";
				wud_info = 'Featured WooCommerce products';
				showit = 'block';
				wooshow = 'block';
				}
			}			
			else if (wud_select=='woocat'){
				wud_selected = woo_cats;
				wud_label = "WooCommerce";
				wud_info = 'WooCommerce per Category';
				showit = 'block';
				wooshow = 'block';
			}
			else if (wud_select=='wootag'){
				wud_selected = woo_tags;
				wud_label = "WooCommerce";
				wud_info = 'WooCommerce per Tag';
				showit = 'block';
				wooshow = 'block';
			}
			else if (wud_select=='taxselect'){
				wud_select_tax = tax_alle;
				wud_label = "Selection";
				wud_info = 'Selected shortcode';
			}

		//If the selected DROPDOWN LIST item has no value
			if(wud_selected.length === 0 ){
					if (wud_select=='category'){
						wud_err_hdr = 'w01 - Error Post Category';
						wud_err_info = "There are no POST found with a CATEGORY,";
						wud_err_msg = '';
						wud_err_url = 'https://en.support.wordpress.com/posts/categories/';
						wud_err_plg = 'Wordpress Post Category';
						AlertPopup();
						return false;						
					}
					else if (wud_select=='post_tag'){
						wud_err_hdr = 'w02 - Error Post Tag';
						wud_err_info = "There are no POST found with a TAG,";
						wud_err_msg = '';
						wud_err_url = 'https://en.support.wordpress.com/posts/tags/';
						wud_err_plg = 'Wordpress Post Tag';
						AlertPopup();
						return false;						
					}				
					if (wud_select=='categories'){
						wud_err_hdr = '001 - Error Page Category';
						wud_err_info = "There are no PAGES found with a CATEGORY,";
						wud_err_msg = 'from WP Plugin: Category to Pages WUD';
						wud_err_url = 'https://wud-plugins.com/category-to-pages-how-to-use/';
						wud_err_plg = 'Category to Pages WUD';
						AlertPopup();
						return false;						
					}
					else if (wud_select=='tags'){
						wud_err_hdr = '002 - Error Page Tag';
						wud_err_info = "There are no PAGES found with a TAG,";
						wud_err_msg = 'from WP Plugin: Category to Pages WUD';
						wud_err_url = 'https://wud-plugins.com/category-to-pages-how-to-use/';
						wud_err_plg = 'Category to Pages WUD';
						AlertPopup();
						return false;						
					}	
					else if (wud_select=='woo'){
						wud_err_hdr = '003 - Error WooCommerce Products';
						wud_err_info = "There are no PRODUCTS found with a CATEGORY or TAG,";
						wud_err_msg = 'from WP Plugin: WooCommerce';
						wud_err_url = 'https://wordpress.org/plugins/woocommerce/';
						wud_err_plg = 'WooCommerce';
						AlertPopup();
						return false;						
					}
					else if (wud_select=='woofeat'){
						wud_err_hdr = '004 - Error WooCommerce Featured';
						wud_err_info = "There are no FEATURED PRODUCTS found,";
						wud_err_msg = 'from WP Plugin: WooCommerce';
						wud_err_url = 'https://wordpress.org/plugins/woocommerce/';
						wud_err_plg = 'WooCommerce';
						AlertPopup();
						return false;						
					}					
					else if (wud_select=='woocat'){
						wud_err_hdr = '004 - Error WooCommerce Category';
						wud_err_info = "There are no PRODUCTS found with a CATEGORY,";
						wud_err_msg = 'from WP Plugin: WooCommerce';
						wud_err_url = 'https://wordpress.org/plugins/woocommerce/';
						wud_err_plg = 'WooCommerce';
						AlertPopup();
						return false;						
					}
					else if (wud_select=='wootag'){
						wud_err_hdr = '005 - Error WooCommerce Tag';
						wud_err_info = "There are no PRODUCTS found with a TAG,";
						wud_err_msg = 'from WP Plugin: WooCommerce';
						wud_err_url = 'https://wordpress.org/plugins/woocommerce/';
						wud_err_plg = 'WooCommerce';
						AlertPopup();
						return false;						
					}					
				}
	//END SELECT FROM DROPDOWN LIST	
	
//-----------------------------------------------------------------------------------//
	
	//START SELECT FROM EDITOR SELECTED TEXT
			//Capture selection	
				var seltext = tinyMCE.activeEditor.selection.getContent();

				var Arr_Short = seltext.split('[gridwud ').join('( ').split('="').join(') ( ').split('" ').join(') ( ').split('"]').join(')');
				
				var mydefault = "Use the default value";
				var myslug = "", idslug = "", mytitle = "", idtitle = "", mybutton = mydefault, mypopup = mydefault, idpopup = "", idbutton = "", mygrid = mydefault, idgrid = "", myshape = mydefault, idshape = "";
				var mytiles = mydefault, idtiles = "", myskip = mydefault, idskip = "",mybannerh = mydefault, idbannerh = "", mysticky = mydefault, idsticky = "", myorder = mydefault, idorder = "";
				var mybg = mydefault, idbg = "", mygray = mydefault, idgray = "", mywoocss = mydefault, idwoocss = "", mydarkexp = mydefault, iddarkexp = "";
			
			//Check values from selection.
			if(seltext && wud_label == "Selection"){
				// Check [] 
				if (seltext.substring(seltext.length-1) != "]" || seltext.substring(0,1)!= "["){
						wud_err_hdr = '006 - Error Selection';
						wud_err_info = "Please select the whole shortcode,";
						wud_err_msg = 'please try again';
						wud_err_url = 'https://wud-plugins.com/how-to-create-grids-or-tiles/';
						wud_err_plg = 'Grid WUD';
						AlertPopup();
						return false;
				}	
				// Check lenght
				if (Arr_Short.length > 0){
					var myresult = '';
					var txtx = Arr_Short;
					var regExpx = /\(([^)]+)\)/g;
					var matches = txtx.match(regExpx);
					if(matches != null){
						if(matches[0]=="( slug)"){
							for (var i = 0; i < matches.length; i++) {
								var strx = matches[i].substring(2, matches[i].length - 1);
								if(i==0 && strx=="slug"){myslug="subfound"; idslug=i+1;}
							}
						}
					}
					//Check slug haves a ... value ...	
					if(myslug=="subfound"){myslugx=matches[idslug].substring(2, matches[idslug].length - 1).toLowerCase()}
					else{
						wud_err_hdr = '007 - Error Selection';
						wud_err_info = "The selection has no valid slug,";
						wud_err_msg = 'please try again';
						wud_err_url = 'https://wud-plugins.com/how-to-create-grids-or-tiles/';
						wud_err_plg = 'Grid WUD';
						AlertPopup();
						return false;						
					}

					//If selected try to collect the DATA LIST
					for(var i in wud_select_tax) {					
						if(myslugx == wud_select_tax[i].text.toLowerCase()){
							myresult = wud_select_tax[i].value;
							
							if(myresult == "category"){
								wud_selected = post_cats;
								wud_label = "Category";
								wud_info = 'WordPress Post Categories';								
							}							
							else if(myresult == "post_tag"){
								wud_selected = post_tags;
								wud_label = "Tag";
								wud_info = 'WordPress Post Tags';								
							}
							else if(myresult == "wud-latest"){
								wud_selected = post_alle;
								wud_label = "Latest Post";
								wud_info = 'WordPress Latest Post';								
							}	
							else if(myresult == "categories"){
								wud_selected = page_cats;
								wud_label = "WUD Page Category";
								wud_info = 'Categories from category-to-pages-wud';
								ctpshow = 'block';							
							}	
							else if(myresult == "tags"){
								wud_selected = page_tags;
								wud_label = "WUD Page Tag";
								wud_info = 'Tags from category-to-pages-wud';
								ctpshow = 'block';								
							}
							else if(myresult == "woocommerce"){
								wud_selected = woo_list;
								wud_label = "WooCommerce";
								wud_info = 'All WooCommerce products';
								showit = 'block';
								wooshow = 'block';							
							}	
							else if (myresult=='woofeatured'){
								wud_selected = woo_feat;
								wud_label = "WooCommerce";
								wud_info = 'Featured WooCommerce products';
								showit = 'block';
								wooshow = 'block';
							}								
							else if(myresult == "product_cat"){
								wud_selected = woo_cats;
								wud_label = "WooCommerce";
								wud_info = 'WooCommerce per Category';
								showit = 'block';
								wooshow = 'block';								
							}	
							else if(myresult == "product_tag"){
								wud_selected = woo_tags;
								wud_label = "WooCommerce";
								wud_info = 'WooCommerce per Tag';
								showit = 'block';
								wooshow = 'block';								
							}							
							else{
								wud_err_hdr = '008 - Error Selection';
								wud_err_info = "The selection has no valid slug,";
								wud_err_msg = 'please try again';
								wud_err_url = 'https://wud-plugins.com/how-to-create-grids-or-tiles/';	
								wud_err_plg = 'Grid WUD';
								AlertPopup();
								return false;								
							}
							
						}
						
					}
					if(wud_selected==''){
						wud_err_hdr = '009 - Error Selection';
						wud_err_info = "The selection has no valid slug,";
						wud_err_msg = 'please try again';
						wud_err_url = 'https://wud-plugins.com/how-to-create-grids-or-tiles/';
						wud_err_plg = 'Grid WUD';
						AlertPopup();
						return false;
					}
			  }
			}
			//If there are no values from the selection.
			if(!seltext && wud_label == "Selection"){
				wud_err_hdr = '010 - Error Selection';
				wud_err_info = "Please select a shortcode,";
				wud_err_msg = 'before using this function';
				wud_err_url = 'https://wud-plugins.com/how-to-create-grids-or-tiles/';
				wud_err_plg = 'Grid WUD';
				AlertPopup();
				return false;
			}
		//END SELECT FROM EDITOR SELECTED TEXT

//-----------------------------------------------------------------------------------//
		
		//START If the SELECTED TEXT haves OPTION values ... Try to remember them as SELECTED DROPDOWN VALUE
			if (Arr_Short.length > 0){			
				var txt = Arr_Short;
				var regExp = /\(([^)]+)\)/g;
				var matches = txt.match(regExp);
				if(matches != null){
					if(matches[0]=="( slug)"){
						for (var i = 0; i < matches.length; i++) {
							var str = matches[i].substring(2, matches[i].length - 1);
							if(i==0 && str=="slug"){myslug="found"; idslug=i+1;}
							if(str=="title"){mytitle="found"; idtitle=i+1;}
							if(str=="button"){mybutton="found"; idbutton=i+1;}
							if(str=="grid"){mygrid="found"; idgrid=i+1;}
							if(str=="shape"){myshape="found"; idshape=i+1;}
							if(str=="tiles"){mytiles="found"; idtiles=i+1;}
							if(str=="skip"){myskip="found"; idskip=i+1;}
							if(str=="sticky"){mysticky="found"; idsticky=i+1;}
							if(str=="order"){myorder="found"; idorder=i+1;}
							if(str=="bg"){mybg="found"; idbg=i+1;}
							if(str=="woocss"){mywoocss="found"; idwoocss=i+1;}
							if(str=="gray"){mygray="found"; idgray=i+1;}
							if(str=="dark"){mydarkexp="found"; iddarkexp=i+1;}
							if(str=="popup"){mypopup="found"; idpopup=i+1;}
							if(str=="bannerheight"){mybannerh="found"; idbannerh=i+1;}
						}
						
						if(myslug=="found"){myslug=matches[idslug].substring(2, matches[idslug].length - 1)}
						if(mytitle=="found"){mytitle=matches[idtitle].substring(2, matches[idtitle].length - 1)}
						
						if(mybutton=="found"){
							mybutton=matches[idbutton].substring(2, matches[idbutton].length - 1);
							if(mybutton==0){mybutton="Show Grids";}
							else if(mybutton==1){mybutton="Hide the Button";}
							else if(mybutton==2){mybutton="Show Archive";}
							else{mybutton=mydefault;}
						}
						
						if(mygrid=="found"){
							mygrid=matches[idgrid].substring(2, matches[idgrid].length - 1);
							if(mygrid < 2 || mygrid > 50 ){mygrid=mydefault;}
						}
						
						if(myshape=="found"){
							myshape=matches[idshape].substring(2, matches[idshape].length - 1);
							if(myshape==0){myshape="Standard";}
							else if(myshape==1){myshape="Standard";}
							else if(myshape==2){myshape="Square";}
							else if(myshape==3){myshape="Blocks";}
							else if(myshape==4){myshape="Circle";}
							else if(myshape==5){myshape="Photo\'s";}
							else if(myshape==6){myshape="Horizon";}
							else if(myshape==7){myshape="Mixed One";}
							else if(myshape==8){myshape="Mixed Two";}
							else{myshape=mydefault;}								
						}
						
						if(mytiles=="found"){
							mytiles=matches[idtiles].substring(2, matches[idtiles].length - 1);
							if(mytiles==0){mytiles="Grids";}
							else if(mytiles==1){mytiles="Tiles";}
							else if(mytiles==2){mytiles="Tiles with shadow";}
							else{mytiles=mydefault;}						
						}	
						
						if(myskip=="found"){
							myskip=matches[idskip].substring(2, matches[idskip].length - 1);
							if(myskip < 1 || myskip > 10 ){myskip=mydefault;}
						}
						
						if(mysticky=="found"){
							mysticky=matches[idsticky].substring(2, matches[idsticky].length - 1);
							if(mysticky==0){mysticky="Show All Post";}
							else if(mysticky==1){mysticky="Show Sticky Only";}
							else{mysticky=mydefault;}
						}	
						
						if(myorder=="found"){
							myorder=matches[idorder].substring(2, matches[idorder].length - 1);
							if(myorder==11){myorder="Date ASC";}
							else if(myorder==12){myorder="Date DESC";}
							else if(myorder==21){myorder="Name ASC";}
							else if(myorder==22){myorder="Name DESC";}
							else if(myorder==31){myorder="Post ID ASC";}
							else if(myorder==32){myorder="Post ID DESC";}
							else if(myorder==99){myorder="Random Order";}							
							else{myorder=mydefault;}
						}	
						
						if(mybg=="found"){
							mybg=matches[idbg].substring(2, matches[idbg].length - 1);
							if(mybg==1){mybg="BG 1 with title";}
							else if(mybg==11){mybg="BG 1 without title";}
							else if(mybg==2){mybg="BG 2 with title";}
							else if(mybg==12){mybg="BG 2 without title";}
							else if(mybg==3){mybg="BG 3 with title";}
							else if(mybg==13){mybg="BG 3 without title";}
							else if(mybg==4){mybg="BG 4 with title";}	
							else if(mybg==14){mybg="BG 4 without title";}
							else if(mybg==5){mybg="BG 5 with title";}
							else if(mybg==15){mybg="BG 5 without title";}								
							else{mybg=mydefault;}
						}	
						if(mywoocss=="found"){
							mywoocss=matches[idwoocss].substring(2, matches[idwoocss].length - 1);
							if(mywoocss==1){mywoocss="Show Detail Product";}
							else if(mywoocss==2){mywoocss="Show Title Product";}
							else if(mywoocss==3){mywoocss="Show Only Title Product";}
							else{mywoocss=mydefault;}						
						}
						
						if(mygray=="found"){
							mygray=matches[idgray].substring(2, matches[idgray].length - 1);
							if(mygray==0){mygray="Force gray images";}
							else if(mygray==1){mygray="Force colorized images";}
							else{mygray=mydefault;}						
						}
						
						if(mydarkexp=="found"){
							mydarkexp=matches[iddarkexp].substring(2, matches[iddarkexp].length - 1);
							if(mydarkexp==0){mydarkexp="Light Excerpt Background";}
							else if(mydarkexp==1){mydarkexp="Dark Excerpt Background";}
							else{mydarkexp=mydefault;}						
						}
						
						if(mypopup=="found"){
							mypopup=matches[idpopup].substring(2, matches[idpopup].length - 1);
							if(mypopup==0){mypopup="Post or Page";}
							else if(mypopup==1){mypopup="LightBox Popup";}
							else if(mypopup==2){mypopup="Banner Slider"; banh="visible";}
							else{mypopup=mydefault;}
						}						

						if(mybannerh=="found"){
							mybannerh=matches[idbannerh].substring(2, matches[idbannerh].length - 1);
							if(mybannerh < 30 || mybannerh > 100 ){mybannerh=mydefault;}
						}						
					}
				}
			}
		//END If the SELECTED TEXT haves OPTION values ... Try to remember them as SELECTED DROPDOWN VALUE	

//-----------------------------------------------------------------------------------//
		
		//START POPUP WINDOW WITH VALUES
                editor.windowManager.open({
                    title: "Insert a Grid WUD shortcode",				
                    body: [	
					{
						type   : 'container',
						label  : 'Info',
						html   : wud_info,
					},					
					{
						type: 'listbox',
						name: 'grid_wud_slug',
						label: wud_label,
						value: myslug,
						values: wud_selected
					},
					{
						type   : 'listbox',
						name   : 'wud_woo',						
						label  : ' ',
						text: mywoocss,
						value: mywoocss,
						style: 'display: '+showit+';',
						values : [
						  { text: mydefault, value: mydefault },
						  { text: 'Show Detail Product', value: 'Show Detail Product' },
						  { text: 'Show Title Product', value: 'Show Title Product' },
						  { text: 'Show Only Title Product', value: 'Show Only Title Product' }
						]
					},	
					{
						type   : 'listbox',
						name   : 'wud_popup',
						onselect: function( ) {
							if (this.value() == 'Banner Slider') {
								document.getElementById("TESTID").style.visibility= 'visible';
							} 
							else {
								document.getElementById("TESTID").style.visibility= 'hidden';
							}   
						},						
						label  : 'Popup, Content, Slider',
						text: mypopup,
						value: mypopup,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Post or Page', value: 'Post or Page' },
						  { text: 'LightBox Popup', value: 'LightBox Popup' },
						  { text: 'Banner Slider', value: 'Banner Slider' }
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_bannerh',
						id 	   : 'TESTID',
						style: 'visibility: '+banh+';',
						label  : 'Height % banner/slider',
						text: mybannerh,
						value: mybannerh,
						values : [
						   { text: mydefault, mydefault },
						  { text: '30', value: '30' },						  
						  { text: '40', value: '40' },
						  { text: '50', value: '50' },
						  { text: '60', value: '60' },
						  { text: '70', value: '70' },
						  { text: '80', value: '80' },
						  { text: '90', value: '90' },
						  { text: '100', value: '100' }
						]
					},					
                    {
                        type: 'textbox',
                        name: 'wud_title',
                        label: 'Custom Title',
                        value: mytitle
                    },
					{
						type   : 'container',
						label  : 'Info',
						html   : 'Change Default values \'only\' if needed.',
					},						
					{
						type   : 'listbox',
						name   : 'wud_button',
						label  : 'Button action',
						text: mybutton,
						value: mybutton,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Show Grids', value: 'Show Grids' },
						  { text: 'Hide the Button', value: 'Hide the Button' },
						  { text: 'Show Archive', value: 'Show Archive' }
						]
					},					
                    {
                        type: 'listbox',
                        name: 'wud_grids',
                        label: 'Grids to show',
						tooltip: 'You can enter another amount in the shortcode.',
						text: mygrid,
						value: mygrid,
						values : [
						  { text: mydefault, value: mydefault },
						  { text: '2', value: '2' },
						  { text: '3', value: '3' },
						  { text: '4', value: '4' },
						  { text: '5', value: '5' },
						  { text: '6', value: '6' },
						  { text: '7', value: '7' },
						  { text: '8', value: '8' },
						  { text: '9', value: '9' },
						  { text: '10', value: '10' }
						]
                    },						
					{
						type   : 'listbox',
						name   : 'wud_shape',
						label  : 'Shape',
						text: myshape,
						value: myshape,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Standard', value: 'Standard' },
						  { text: 'Square', value: 'Square' },
						  { text: 'Blocks', value: 'Blocks' },
						  { text: 'Circle', value: 'Circle' },
						  { text: 'Photo\'s', value: 'Photo\'s' },
						  { text: 'Horizon', value: 'Horizon' },
						  { text: 'Mixed One', value: 'Mixed One' },
						  { text: 'Mixed Two', value: 'Mixed Two' }
						]
					},				
					{
						type   : 'listbox',
						name   : 'wud_tiles',
						label  : 'Lay-Out',
						text: mytiles,
						value: mytiles,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Grids', value: 'Grids' },
						  { text: 'Tiles', value: 'Tiles' },
						  { text: 'Tiles with shadow', value: 'Tiles with shadow' }
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_skip',
						label  : 'Skip post(s)',
						text: myskip,
						value: myskip,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: '1', value: '1' },						  
						  { text: '2', value: '2' },
						  { text: '3', value: '3' },
						  { text: '4', value: '4' },
						  { text: '5', value: '5' },
						  { text: '6', value: '6' },
						  { text: '7', value: '7' },
						  { text: '8', value: '8' },
						  { text: '9', value: '9' },
						  { text: '10', value: '10' }
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_sticky',
						label  : 'Sticky only',
						text: mysticky,
						value: mysticky,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Show All Post', value: 'Show All Post' },
						  { text: 'Show Sticky Only', value: 'Show Sticky Only' }
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_order',
						label  : 'Sort Order',
						text: myorder,
						value: myorder,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Date ASC', value: 'Date ASC' },
						  { text: 'Date DESC', value: 'Date DESC' },
						  { text: 'Name ASC', value: 'Name ASC' },
						  { text: 'Name DESC', value: 'Name DESC' },	
						  { text: 'Post ID ASC', value: 'Post ID ASC' },
						  { text: 'Post ID DESC', value: 'Post ID DESC' },
						  { text: 'Random Order', value: 'Random Order' }
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_back',
						label  : 'Background',
						tooltip: 'See Grid-WUD settings page for the BG colors.',
						text: mybg,
						value: mybg,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'BG 1 with title', value: 'BG 1 with title' },
						  { text: 'BG 1 without title', value: 'BG 1 without title' },
						  { text: 'BG 2 with title', value: 'BG 2 with title' },
						  { text: 'BG 2 without title', value: 'BG 2 without title' },
						  { text: 'BG 3 with title', value: 'BG 3 with title' },
						  { text: 'BG 3 without title', value: 'BG 3 without title' },
						  { text: 'BG 4 with title', value: 'BG 4 with title' },
						  { text: 'BG 4 without title', value: 'BG 4 without title' },
						  { text: 'BG 5 with title', value: 'BG 5 with title' },
						  { text: 'BG 5 without title', value: 'BG 5 without title' },						  
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_gray',
						label  : 'Images color/gray',
						text: mygray,
						value: mygray,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Force gray images', value: 'Force gray images' },
						  { text: 'Force colorized images', value: 'Force colorized images' }				  
						]
					},
					{
						type   : 'listbox',
						name   : 'wud_exp_back',
						label  : 'Excerpt Background',
						text: mydarkexp,
						value: mydarkexp,
						values : [
						   { text: mydefault, value: mydefault },
						  { text: 'Light Excerpt Background', value: 'Light Excerpt Background' },
						  { text: 'Dark Excerpt Background', value: 'Dark Excerpt Background' }				  
						]
					},					
					{
						type   : 'buttongroup',
						label  : 'Support',
						style : 'margin: 0; padding: 0; border: none;',
						items  : [
						  { text: 'Manual', tooltip: 'Read our online manual.', style: 'max-width: 100px; overflow: hidden; float: left; border-color:#444; background-color: #82bdf7;margin-right:2px;', value: 'button1', onclick: function(e) {window.open('https://wud-plugins.com/how-to-create-grids-or-tiles/', '_blank');} },
						  { text: '? Category to Pages WUD', tooltip: 'More info about Category to Pages WUD.', style: 'max-width: 174px; overflow: hidden; text-align: center; border-color:#444; background-color: #8bc34a; display:'+ctpshow+';', value: 'button2', onclick: function(e) {window.open('https://wud-plugins.com/category-to-pages-how-to-use/', '_blank');} },
						  { text: '? WooCommerce Tiles', tooltip: 'More info about WooCommerce Tiles/Grids.', style: 'max-width: 174px; overflow: hidden; text-align: center; border-color:#444; background-color: #8bc34a; display:'+wooshow+';', value: 'button3', onclick: function(e) {window.open('https://wud-plugins.com/woocommerce-tiles-and-grids/', '_blank');} }
						]
					}
					
					],
					
				//START COLLECT AND SAVE DATA
					onsubmit: function(e) {
						if(e.data.grid_wud_slug==''){
						//Check slug entry
						wud_err_hdr = '011 - Error Slug';
						wud_err_info = "Please select at least one slug,";
						wud_err_msg = 'please try again';
						wud_err_url = 'https://wud-plugins.com/how-to-create-grids-or-tiles/';
						wud_err_plg = 'Grid WUD';
						AlertPopup();
						return false;								
						}
						//Check data entry
						if(e.data.wud_title==mydefault){e.data.wud_title=''}
						
						if(e.data.wud_button=='Show Grids'){e.data.wud_button='0'}
						else if(e.data.wud_button=='Hide the Button'){e.data.wud_button='1'}
						else if(e.data.wud_button=='Show Archive'){e.data.wud_button='2'}
						else{e.data.wud_button=''}
						

						if(e.data.wud_grids > 50 || e.data.wud_grids < 1 || e.data.wud_grids==mydefault){e.data.wud_grids=''}
						if(e.data.wud_skip > 10 || e.data.wud_skip < 1 || e.data.wud_skip==mydefault){e.data.wud_skip=''}
						
						if(e.data.wud_bannerh < 30 || e.data.wud_bannerh > 100 || e.data.wud_bannerh==mydefault || e.data.wud_popup!='Banner Slider'){e.data.wud_bannerh=''}
						
						if(e.data.wud_shape=='Standard'){e.data.wud_shape='1'}
						else if(e.data.wud_shape=='Square'){e.data.wud_shape='2'}
						else if(e.data.wud_shape=='Blocks'){e.data.wud_shape='3'}
						else if(e.data.wud_shape=='Circle'){e.data.wud_shape='4'}
						else if(e.data.wud_shape=='Photo\'s'){e.data.wud_shape='5'}
						else if(e.data.wud_shape=='Horizon'){e.data.wud_shape='6'}
						else if(e.data.wud_shape=='Mixed One'){e.data.wud_shape='7'}
						else if(e.data.wud_shape=='Mixed Two'){e.data.wud_shape='8'}
						else{e.data.wud_shape=''}

						if(e.data.wud_tiles=='Grids'){e.data.wud_tiles='0'}
						else if(e.data.wud_tiles=='Tiles'){e.data.wud_tiles='1'}
						else if(e.data.wud_tiles=='Tiles with shadow'){e.data.wud_tiles='2'}
						else{e.data.wud_tiles=''}

						if(e.data.wud_sticky=='Show All Post'){e.data.wud_sticky='0'}
						else if(e.data.wud_sticky=='Show Sticky Only'){e.data.wud_sticky='1'}
						else{e.data.wud_sticky=''}

						if(e.data.wud_order=='Date ASC'){e.data.wud_order='11'}
						else if(e.data.wud_order=='Date DESC'){e.data.wud_order='12'}
						else if(e.data.wud_order=='Name ASC'){e.data.wud_order='21'}
						else if(e.data.wud_order=='Name DESC'){e.data.wud_order='22'}
						else if(e.data.wud_order=='Post ID ASC'){e.data.wud_order='31'}
						else if(e.data.wud_order=='Post ID DESC'){e.data.wud_order='32'}
						else if(e.data.wud_order=='Random Order'){e.data.wud_order='99'}
						else{e.data.wud_order=''}

						if(e.data.wud_back=='BG 1 with title'){e.data.wud_back='1'}
						else if(e.data.wud_back=='BG 1 without title'){e.data.wud_back='11'}
						else if(e.data.wud_back=='BG 2 with title'){e.data.wud_back='2'}
						else if(e.data.wud_back=='BG 2 without title'){e.data.wud_back='12'}
						else if(e.data.wud_back=='BG 3 with title'){e.data.wud_back='3'}
						else if(e.data.wud_back=='BG 3 without title'){e.data.wud_back='13'}
						else if(e.data.wud_back=='BG 4 with title'){e.data.wud_back='4'}
						else if(e.data.wud_back=='BG 4 without title'){e.data.wud_back='14'}
						else if(e.data.wud_back=='BG 5 with title'){e.data.wud_back='5'}
						else if(e.data.wud_back=='BG 5 without title'){e.data.wud_back='15'}
						else{e.data.wud_back=''}	

						if(e.data.wud_gray==mydefault){e.data.wud_gray=''}
						else if(e.data.wud_gray=='Force gray images'){e.data.wud_gray='0'}
						else if(e.data.wud_gray=='Force colorized images'){e.data.wud_gray='1'}
						else{e.data.wud_gray=''}

						if(e.data.wud_exp_back==mydefault){e.data.wud_exp_back=''}
						else if(e.data.wud_exp_back=='Light Excerpt Background'){e.data.wud_exp_back='0'}
						else if(e.data.wud_exp_back=='Dark Excerpt Background'){e.data.wud_exp_back='1'}
						else{e.data.wud_exp_back=''}

						if(e.data.wud_woo==mydefault){e.data.wud_woo=''}
						else if(e.data.wud_woo=='Show Detail Product'){e.data.wud_woo='1'}
						else if(e.data.wud_woo=='Show Title Product'){e.data.wud_woo='2'}
						else if(e.data.wud_woo=='Show Only Title Product'){e.data.wud_woo='3'}
						else{e.data.wud_woo=''}

						if(e.data.wud_popup==mydefault){e.data.wud_popup=''}
						else if(e.data.wud_popup=='Post or Page'){e.data.wud_popup='0'}
						else if(e.data.wud_popup=='LightBox Popup'){e.data.wud_popup='1'}
						else if(e.data.wud_popup=='Banner Slider'){e.data.wud_popup='2'}
						else{e.data.wud_popup=''}
						
						//Generate the shortcode
						var shortcode="";
						if(e.data.grid_wud_slug != ''){shortcode=(shortcode+ '[gridwud slug="'+e.data.grid_wud_slug+'" ')}
							if(e.data.wud_title != ''){shortcode=(shortcode+ ' title="'+e.data.wud_title+'" ')}
							if(e.data.wud_button != ''){shortcode=(shortcode+ ' button="'+e.data.wud_button+'" ')}
							if(e.data.wud_grids != ''){shortcode=(shortcode+ ' grid="'+e.data.wud_grids+'" ')}
							if(e.data.wud_shape != ''){shortcode=(shortcode+ ' shape="'+e.data.wud_shape+'" ')}
							if(e.data.wud_tiles != ''){shortcode=(shortcode+ ' tiles="'+e.data.wud_tiles+'" ')}
							if(e.data.wud_skip != ''){shortcode=(shortcode+ ' skip="'+e.data.wud_skip+'" ')}
							if(e.data.wud_sticky != ''){shortcode=(shortcode+ ' sticky="'+e.data.wud_sticky+'" ')}
							if(e.data.wud_order != ''){shortcode=(shortcode+ ' order="'+e.data.wud_order+'" ')}
							if(e.data.wud_back != ''){shortcode=(shortcode+ ' bg="'+e.data.wud_back+'" ')}
							if(e.data.wud_gray != ''){shortcode=(shortcode+ ' gray="'+e.data.wud_gray+'" ')}
							if(e.data.wud_exp_back != ''){shortcode=(shortcode+ ' dark="'+e.data.wud_exp_back+'" ')}
							if(e.data.wud_woo != ''){shortcode=(shortcode+ ' woocss="'+e.data.wud_woo+'" ')}
							if(e.data.wud_popup != ''){shortcode=(shortcode+ ' popup="'+e.data.wud_popup+'" ')}
							if(e.data.wud_bannerh != ''){shortcode=(shortcode+ ' bannerheight="'+e.data.wud_bannerh+'" ')}
						//Remove begin and end spaces
						shortcode=$.trim(shortcode);
						if(e.data.grid_wud_slug != ''){shortcode=(shortcode+ ']')}
						
						//Place the shortcode in the post
                        editor.insertContent(
							shortcode
                        );
                    }
				//END COLLECT AND SAVE DATA
                });
				},
		//END POPUP WINDOW WITH VALUES
		
		//Button drop down list
         values: [
		    { text: 'Grid WUD', value: 'nothing' },
			{ text: 'Grab the selected Shortcode', value: 'taxselect' },	
			{ text: '-'},			
			{ text: 'Post Category', value: 'category' },
			{ text: 'Post Tag', value: 'post_tag' },
			{ text: 'Latest Post', value: 'news' },
			{ text: '-'},
			{ text: 'Page Category WUD', value: 'categories' },
			{ text: 'Page Tag WUD', value: 'tags' },
			{ text: '-'},
			{ text: 'WooCommerce Category', value: 'woocat' },
			{ text: 'WooCommerce Tag', value: 'wootag' },
			{ text: 'Featured Products', value: 'woofeat' },
			{ text: 'All  Products', value: 'woo' }		
         ]			
        });
    });	

	function AlertPopup($){
	tinymce.activeEditor.windowManager.open({
		title: wud_err_hdr,				
		body: [	
		{
		type   : 'container',
		label  : '',
		html   : wud_err_info + "<br>" + wud_err_msg + "<br><br>",
		}					
		],
		buttons: [{
		text: ' About: ' + wud_err_plg,
		style: 'background: #cddc39;',
		onclick: function() {
		window.open(wud_err_url);
		}
		}, {
		text: 'OK',
		subtype: 'primary',
		onclick: function() {
		(this).parent().parent().close();
		}
		}],		  			
	});
	}
})(jQuery);