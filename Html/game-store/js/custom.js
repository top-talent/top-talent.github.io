$(document).ready(function(){
    $("#answer1").click(function(){
        $("#comment1").slideToggle("slow");
    });
    $("#answer2").click(function(){
        $("#comment2").slideToggle("slow");
    });
    $("#answer3").click(function(){
        $("#comment3").slideToggle("slow");
    });
    
    var e = $("div.stores-list"),
	      t = $(".stores-list-elements").height(),
	      o = $("#stores-title").length ? $("#stores-title") : $("#store_list_products");
	  $("#product_right_home tr.hidden-store").hide(), $("#stores-collapse").click(function(a) {
	      a.preventDefault(), e.hasClass("stores-limit-height") ? (e.height(t), e.removeClass("stores-limit-height")) : (e.height(""), e.addClass("stores-limit-height"), $("html, body").animate({
	          scrollTop: o.offset().top
	      }, 500))
	  }), $("#load-stores").click(function(e) {
	      e.preventDefault(), $("#product_right_home tr.hidden-store").fadeIn(200, function() {
	          $("div.loader.show-all-stores").remove()
	      })
	  })
    
});