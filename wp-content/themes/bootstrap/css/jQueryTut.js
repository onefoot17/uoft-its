/* =============================================================================
   Day 2 - Waiting for the Page to load
   ========================================================================== */

$(document).ready(function() {
    
});

// OR

$(function() {
    
});

/* =============================================================================
   Day 2 - Selectors
   ========================================================================== */

// Select all descendants
$('ul').find('li').css('color', '#fff');

// Select direct children
$('ul').children('li').css('color', '#fff');

// Select first child
$('ul').children('li:first').text('Changed by jQuery'); // This method works in IE6 and IE7

// Select a specific child (2nd)
$('ul').children('li:nth-child(2)').text('Changed by jQuery');

// Eq method to select the 2nd child
$('ul').children('li').eq(1).text('Changed by jQuery')

// Using Eq and next, selecting the 5th child
$('ul').children('li').eq(3).next().text('Changed by jQuery');

// Select the direct parent
$('li').parent().removeClass('emphasis');

// Select all ancestors (keep bubbling up)
$('li').parents().removeClass('.container');

// Select closest ancestor (stops bubbling -- it will even return the selected element)
$('li').closest().removeClass('.container');
