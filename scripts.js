$(document).ready(function() {
  $(".mainContainer").css("min-height", $(window).height()-60);
  $("textarea").css("min-height", $(window).height()-100);
  $("textarea").keyup(function(){
    $.post("php/updateDiary.php", {diary:$("textarea").val()});
  });
});