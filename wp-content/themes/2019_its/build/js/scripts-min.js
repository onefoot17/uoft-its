!function(){"use strict";var e=document.querySelectorAll(".glide");Object.values(e).map((function(e){new Glide(e,{type:"carousel",perView:1}).mount()})),Element.prototype.matches||(Element.prototype.matches=Element.prototype.msMatchesSelector||Element.prototype.webkitMatchesSelector),Element.prototype.closest||(Element.prototype.closest=function(e){var t=this;do{if(t.matches(e))return t;t=t.parentElement||t.parentNode}while(null!==t&&1===t.nodeType);return null}),document.addEventListener("click",(function(e){if(e.target.closest(".menu-toggle")){var t=e.type,r=e.target.closest(".menu-toggle"),n=document.querySelector(r.getAttribute("data-href"));if("keydown"===t&&13!==e.keyCode&&32!==e.keyCode)return!0;e.preventDefault(),"true"===n.getAttribute("aria-hidden")?(n.setAttribute("aria-hidden","false"),r.setAttribute("aria-expanded","true")):(n.setAttribute("aria-hidden","true"),r.setAttribute("aria-expanded","false"))}}),!1)}();
//# sourceMappingURL=scripts-min.js.map