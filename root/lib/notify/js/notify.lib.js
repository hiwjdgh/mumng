let notify_obj = {
    page : 1,
    notify_end : false,
    notify_request : false,
};
async function get_notify_list(elmt){
    if(notify_obj.notify_request == 1){
        return;
    }

    if(notify_obj.notify_end == 1){
        return;
    }

    notify_obj.notify_request = true;
    await pave_async_ajax("/api/notify/list", "GET", notify_obj).then(function(result){
        notify_obj.notify_request = false;

        if(result.data.list.length < 1){
            notify_obj.notify_end = 1;
        }

        if(notify_obj["page"] == 1){
            $(elmt).html(result.data.html);
        }else{
            $(elmt).append(result.data.html);
        }

        notify_obj["page"]++;
    });
}

$(document).ready(function(){
    $("#header__notify-button").on("click", function(){
        get_notify_list($(".notify-dropdown__list"));
    });

});