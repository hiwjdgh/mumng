function delete_latest(elmt, callback = null){
    pave_ajax(
        "/api/latest/delete",
        {hit_id: elmt.data("hit")},
        function(result){
            if(result.status == "200"){
                if(result.msg){
                    alert(result.msg);
                }else{
                    alert("최근본 회차가 삭제되었습니다.");

                    if(callback){
                        callback();
                    }
                }
                
            }else{
                if(result.msg){
                    if(result.redirect_url){
                        if(confirm(result.msg)){
                            location.href = result.redirect_url;
                        }
                    }else{
                        alert(result.msg);
                    }
                }else{
                    alert("에러가 발생하였습니다. 다시 시도해주시기 바랍니다.");
                }
            }
        },
        function(error){
            alert(error);
        }
    );
}