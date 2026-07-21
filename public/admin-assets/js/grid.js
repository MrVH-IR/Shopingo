$(document).ready(function(){
    const $body = $('#admin-body');
    const $sidebar = $('#sidebar');
    const $mainBody = $('#main-body');
    const $showToggle = $('#sidebar-toggle-show');
    const $hideToggle = $('#sidebar-toggle-hide');

    function setSidebarCollapsed(isCollapsed)
    {
        $body.toggleClass('sidebar-collapsed', isCollapsed);

        if (isCollapsed) {
            $showToggle.removeClass('hidden');
            $hideToggle.addClass('hidden');
        } else {
            $showToggle.addClass('hidden');
            $hideToggle.removeClass('hidden');
        }
    }

    $showToggle.click(function(){
       setSidebarCollapsed(false);
    });

    $hideToggle.click(function(){
       setSidebarCollapsed(true);
    });

    $('#menu-toggle').click(function(){
       $('#body-header').toggle(300);
    });

   $('#search-toggle').click(function(){
      $('#search-toggle').addClass('hidden');
      $('#search-area').removeClass('hidden');
      $('#search-input').animate({width : "12rem"}, 300);
   });

   $('#search-area-hide').click(function(){
      $('#search-input').animate({width : "0"}, 300);
      setTimeout(function(){
      $('#search-toggle').removeClass('hidden');
      $('#search-area').addClass('hidden');
   },300);
   });

   $('#header-notification-toggle').click(function(){
      $('#header-notification').fadeToggle();
   });

   $('#header-comment-toggle').click(function(){
      $('#header-comment').fadeToggle();
   });

   $('#header-profile-toggle').click(function(){
      $('#header-profile').fadeToggle();
   });



    $('.sidebar-group-link').click(function () {
        const isActive = $(this).hasClass('sidebar-group-link-active');

        $('.sidebar-group-link').removeClass('sidebar-group-link-active');
        $('.sidebar-group-link .angle')
            .removeClass('fa-angle-down')
            .addClass('fa-angle-left');

        if (!isActive) {
            $(this).addClass('sidebar-group-link-active');
            $(this).find('.angle')
                .removeClass('fa-angle-left')
                .addClass('fa-angle-down');
        }
    });

    setSidebarCollapsed(false);
});




   $('#full-screen').click(function(){
      toggleFullScreen();
   });

   function toggleFullScreen()
   {
      if((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)){
         if(document.documentElement.requestFullscreen){
            document.documentElement.requestFullscreen();
         }
         else if(document.documentElement.mozRequestFullscreen){
            document.documentElement.mozRequestFullscreen();
         }
         else if(document.documentElement.webkitRequestFullscreen){
            document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
         }
         $('#screen-compress').removeClass('hidden');
         $('#screen-expand').addClass('hidden');
      }
      else{
         if(document.cancelFullScreen)
         {
            document.cancelFullScreen();
         }
         else if(document.mozCancelFullScreen)
         {
            document.mozCancelFullScreen();
         }
         else if(document.webkitCancelFullScreen)
         {
            document.webkitCancelFullScreen();
         }
         $('#screen-compress').addClass('hidden');
         $('#screen-expand').removeClass('hidden');
      }
   }
