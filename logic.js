$(document).ready(function(){
   $('.contents article').hide();
   $('ul.menu li a').click(function(){
       $('.contents article').hide();
       $('ul.menu li a').removeClass('active');       
       $(this).addClass('active');
       var contActivo = $(this).attr('href');
       $(contActivo).show();
       return false;
   });
});





