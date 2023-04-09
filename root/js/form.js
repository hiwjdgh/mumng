let alert_elmt = null;
let alert_msg = "";

function form_submit_init(){
    $("form").each(function(){
        this.aftersubmit = this.onsubmit
        this.onsubmit = form_sanitize;
    });
}

function form_sanitize(){
    $(this).find("input,select,checkbox,radio,textarea").each(function(){
        let elmt = $(this);

        //필수 체크
        if(is_required(elmt)){
            //값 검사
            if(alert_msg = check_form_empty(elmt)){
                alert_elmt = elmt;
                return false;
            }
        }

        //실시간 검사 이벤트 체크
        if($(elmt).hasClass("form_real_time")){
            console.log(elmt);
            $.each($._data($(elmt)[0], "events"), function(i, event) {
                console.log(i);
                console.log(event);
                console.log($(elmt).trigger(i));
                if(alert_msg = $(elmt).trigger(event)){
                    alert_elmt = elmt;
                    return false;
                }
            });
        }
    });

    if(alert_msg != ""){
        alert(alert_msg);
        return false;
    }
    
    if (this.aftersubmit && this.aftersubmit() == false){
        return false;
    }

    return true;
}

function is_required(elmt){
    if($(elmt).prop('required')){
        return true;
    }
   
    return false;
}

function is_select_type(elmt){
    let elmt_type = $(elmt).prop("type");
    if(elmt_type == "select-one" || elmt_type == "checkbox" || elmt_type == "radio"){
        return true;
    }

    return false;
}

function check_form_empty(elmt){
    let value = $(elmt).val();
    let msg = "";
    value = $.trim(value);

    if(value === ""){
        msg += $(elmt).prop("title");
        msg += "을(를) ";
        msg += is_select_type(elmt) ? "선택" : "입력";
        msg += "해주세요.";
    }

    return msg;
}
$(document).ready(function(){
    form_submit_init();
});