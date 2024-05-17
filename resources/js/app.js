import './bootstrap';
import $ from 'jquery';

$(document).ready(function(){
    $('.menu-link').click(function(e){
        e.preventDefault();
        var submenu = $(this).siblings('.sub-menu');
        var arrow = $(this).siblings('.arrow-menu');
        submenu.slideToggle();
        arrow.toggleClass("active-menu")
    });
});

// export default $;