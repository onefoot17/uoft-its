/**
 * wud_slider
 */

function wud_slider( container, sliderheight )
{
	var options = '';
	if( sliderheight == undefined ){
		sliderheight = '33';
	}
	document.getElementById("wud_stage").style.paddingBottom= sliderheight + '%'

	if( !( this instanceof wud_slider ) )
		return new wud_slider( container, sliderheight );
	
	// WUD Extra function to enable in IE JQuery assign option
	if (typeof Object.assign != 'function') {
	  Object.assign = function(target) {
		'use strict';
		if (target == null) {
		  throw new TypeError('Cannot convert undefined or null to object');
		}

		target = Object(target);
		for (var index = 1; index < arguments.length; index++) {
		  var source = arguments[index];
		  if (source != null) {
			for (var key in source) {
			  if (Object.prototype.hasOwnProperty.call(source, key)) {
				target[key] = source[key];
			  }
			}
		  }
		}
		return target;
	  };
	}

	this.options = Object.assign({
		slideDuration: 3000,
		slideNode: 'div.wud_slide',
		nextButton: '.wud_next',
		prevButton: '.wud_prev',
		activeClass: 'on',
		toggleClass: 'toggled',
		autorun: true,
		pauseOnFocus: true,
	}, options );

	this.me = this;
	this.container = typeof container === 'string' ? document.querySelector( container ) : container;
	this.slides = this.container.querySelectorAll( this.options.slideNode );
	this.loop = false;
	this.isRunning = true;
	this.isFocused = false;
	this.currentIndex = 0;

	this.init();
};


/**
 */
wud_slider.prototype.init = function()
{
	if( this.slides.length < 2 )
	{
		this.removeNavigation();
		if( this.slides.length == 1 )
			this.slides[0].classList.add( this.options.activeClass );

		return;
	}

	var self = this.me;

	this.container.addEventListener( 'click', function( event ){
		//event.preventDefault();
		switch( true ){
			case event.target.matches( self.options.nextButton ):
				self.next( true );
				break;

			case event.target.matches( self.options.prevButton ):
				self.prev( true );
				break;
		}
	});

	this.container.addEventListener( 'mouseover', function(){
		self.isFocused = true;
	});
	this.container.addEventListener( 'mouseleave', function(){
		self.isFocused = false;

		if( !self.isRunning )
			self.run();
	});
	this.reflow();
	if( this.options.autorun )
	{
		this.currentIndex--;
		this.run();
	}
	else
		this.slides[0].classList.add( this.options.activeClass );
};


/**
 */
wud_slider.prototype.getTransitionDuration = function( elt )
{
	function getPropDurations( elt, prop ){
		return getComputedStyle( elt )[ prop ].toLowerCase().split( ',' ).map( function( duration ){
			return ( duration.indexOf( "ms" ) > -1 ) ? parseFloat( duration ) : parseFloat( duration ) * 1000;
		});
	}

	function sumArrays( arr1, arr2 ){
		return arr1.map( function( num, i ){
			var result = num + arr2[i];
			return isNaN( result ) ? 0 : result;
		});
 }

	var transDurations = getPropDurations( elt, 'transition-duration' );
	var transDelays = getPropDurations( elt, 'transition-delay' );

	return Math.max.apply( null, sumArrays( transDurations, transDelays ) );
};


/**
 */
wud_slider.prototype.idle = function(){
	this.loop = setTimeout( this.run.bind( this ), this.options.slideDuration );
};


/**
 */
wud_slider.prototype.run = function()
{
	if( !this.options.autorun || ( this.options.pauseOnFocus && this.isFocused ) )
	{
		this.isRunning = false;
		return;
	}

	this.isRunning = true;
	this.next();
};


/**
 */
wud_slider.prototype.stop = function()
{
	clearTimeout( this.loop );
	this.isRunning = false;
}


/**
 */
wud_slider.prototype.getSlide = function( relativeOrder )
{
	var	n = this.currentIndex + relativeOrder,
		l = this.slides.length;
	return this.slides[ ( ( n % l ) + l ) % l ];
};


/**
 */
wud_slider.prototype.next = function( isPrevNextButton )
{
	this.animate( this.getSlide( 0 ), this.getSlide( 1 ), isPrevNextButton );
	this.currentIndex++;
};

wud_slider.prototype.prev = function( isPrevNextButton )
{
	this.animate( this.getSlide( 0 ), this.getSlide( -1 ), isPrevNextButton );
	this.currentIndex--;
};


/**
 */
wud_slider.prototype.animate = function( current, next, isPrevNextButton )
{
	var
		on     = this.options.activeClass,
		toggle = this.options.toggleClass;

	if( isPrevNextButton )
	{
		clearTimeout( this.loop );

		for( var i = this.slides.length; i-- ; )
			this.slides[i].classList.add( toggle );

		next.classList.add( on );
		current.classList.remove( on );
	}
	else
	{	clearTimeout( this.loop );
		for( var i = this.slides.length; i-- ; )
			this.slides[i].classList.add( toggle );
		next.classList.remove( toggle );
		next.classList.add( on );
		current.classList.remove( on );
	}

	this.isRunning = true;
	this.loop = setTimeout( this.idle.bind( this ), this.getTransitionDuration( next ) );
};


/**
 */
wud_slider.prototype.removeNavigation = function()
{
	Array.prototype.forEach.call( this.container.querySelectorAll( this.options.prevButton + ', ' + this.options.nextButton ), function( elt ){
		elt.parentNode.removeChild( elt );
	});
};


/**
 */
wud_slider.prototype.reflow = function(){
	return this.container.offsetHeight;
};


/**
 jQuery-compatible libraries adapter
 */ 
( function( $ ){
	if( $ !== undefined ){
		$.fn.wud_slider = function( options ){

			return this.toArray().forEach( function( elt ){
				wud_slider( elt, options );
			});
		}
	}
})( this.$ || this.cash || this.jQuery || this.Zepto || this.jBone );

//wud_slider('.stage1','','1');
