function open_cert_window(cert_type){
    var width= 640;
    var height = 660;

    var leftpos = screen.width  / 2 - ( width  / 2 );
    var toppos  = screen.height / 2 - ( height / 2 );


    var popupWindow = window.open("/cert/form/"+cert_type, "cert_popup", "left=" + leftpos + ", top="    + toppos + ", width=" + width   + ", height=" + height + ", fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=yes, popup=yes" );
    popupWindow.focus();
}

async function check_cert(elmt){
    let result = await pave_async_ajax("/api/cert/check/cert_count","POST", {cert_type: $(elmt).data("cert")});

    if(result.status == "success"){
        open_cert_window($(elmt).data("cert"));
    }else{
        alert(result.msg);
    }
}

$(function(){
    $(".cert-button").on("click", async function(e){
        check_cert($(this));
    });
})