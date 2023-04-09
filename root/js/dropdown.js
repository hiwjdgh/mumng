//dropdown
$(document).on("click", ".dropdown-anchor", function(e){
    e.stopPropagation();
    let anchor = $(this).data("anchor");
    let content = $("." + anchor);
    hide_dropdown(anchor);

    
    if(content.is(":visible")){
        content.hide();
        return;
    }

    change_position($(this));
});

//window scroll change position
$(window).on("scroll", function(){
    if($(".dropdown-box").is(":visible")){
        change_position($(".dropdown-box:visible").prev());
    }
});

//container scroll change hide
document.addEventListener('scroll', function (event) {
    if (event.target.className != undefined && event.target.className.indexOf("dropdown-container") != -1) {
        if($(".dropdown-box").is(":visible")){
            $(".dropdown-box:visible").hide();
        }
    }
  
}, true);

//window resize hide
$(window).on("resize", function(){
    $(".dropdown-box").hide();
});

//inner content click prevent
$(document).on("click mousedown", ".dropdown-box", function(e){
    e.stopPropagation();
});

//outside click hide
$(document).on("click", function(e){
    $(".dropdown-box").hide();
});

function init_dropdown(content){
    content.css({
        top : "",
        left : "",
        right : "",
        bottom : "",
    });
}

function change_position(elmt){
    let $this = elmt;
    let content = $("." + $this.data("anchor"));

    init_dropdown(content);
   //x축
   let x_pos = 0;
   if($(window).width() < ($this.offset().left + content.width())){
       x_pos = $(window).width() - $this.offset().left - $this.width();
       content.css("right", x_pos + "px");
   }else{
       x_pos = $this.offset().left;
       content.css("left", x_pos + "px");
   }

   //y축
   let y_pos = 0;
   let y_offset = 5;
   if(($(window).height() + $(window).scrollTop()) < ($this.offset().top + $this.height() + content.height() + y_offset)){
       y_pos = $(window).height() + $(window).scrollTop() - $this.offset().top + y_offset;
       content.css("bottom", y_pos + "px");
   }else{
       y_pos = $this.offset().top + $this.height() + y_offset - $(window).scrollTop();
       content.css("top", y_pos + "px");
   }

   show_dropdown(content);
}

function hide_dropdown(anchor){
    $(".dropdown-box").not("." + anchor).hide();
}

function show_dropdown(content){
    content.show();
}
