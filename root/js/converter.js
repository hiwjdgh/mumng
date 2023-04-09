function string_to_byte(size){
    let matches = size.match(/(\d+)(\w+)/);
    let type = matches[2].toLowerCase();
    let bytes = "";
    switch (type) {
        case "kb":
            bytes = matches[1]*1024;
            break;
        case "mb":
            bytes = matches[1]*1024*1024;
            break;
        case "gb":
            bytes = matches[1]*1024*1024*1024;
            break;
        default:
            bytes = matches[1];
    
    }

    return bytes;
}

function display_byte_format(bytes){
    var sizes = ['bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

function display_time_ago(str, format = "Y-m-d"){
    let time_ago = Math.floor(Date.parse(str)/1000);
    let time_now = Math.floor(Date.now()/1000);
    let time_elapsed = time_now - time_ago;
    
   /*  console.log(time_now);
    console.log(time_ago); */

    let seconds    = time_elapsed ;
    let minutes    = Math.round(time_elapsed / 60 );
    let hours      = Math.round(time_elapsed / 3600);
    let days       = Math.round(time_elapsed / 86400 );

    // Seconds
    if(seconds <= 60){
        return seconds+"초 전";
    }
    //Minutes
    else if(minutes <=60){
        return minutes+"분 전";
    }
    //Hours
    else if(hours <=24){
        return hours+"시간 전";
    }
    //Days
    else if(days <= 7){
        return days+"일 전";
    }

    return new Date(str);
}

function display_number(number, unit = ""){
    if(number == ""){
        return "0" + unit;
    }else if(typeof(number) == "undefined"){
        return "0" + unit;
    }
    return Number(number).toLocaleString() + unit; 
}
function display_number_format(number, unit = "", comma = 1){
    if(number == ""){
        return "0" + unit;
    }

    if(number < 900){
        return display_number(number, unit); 
    }else if(number < 900000){
        return (number/1000).toFixed(comma) + "K"; 
    }else if(number < 900000000){
        return (number/1000000).toFixed(comma) + "M"; 
    }else{
        return (number/1000000000).toFixed(comma) + "B";
    }
}

function escape_html(unsafe){
    if (unsafe === undefined) {
        return "";
    }
    if(unsafe == ""){
        return "";
    }
    return unsafe.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');
}

function read_more(str, len = 50){
    if (str.length > len) {
        var c = str.substr(0, len);
        var html = c + '...'+ '<span class="readmore">더보기</span>';
        return html
    }
    return str;

}

function nl2br(str){
    return str.replace(/\n/g, "<br/>");
}

function escape_json(key, val) {
    if (typeof(val)!="string") return val;
    return val      
        .replace(/[\\]/g, '\\\\')
        .replace(/[\/]/g, '\\/')
        .replace(/[\b]/g, '\\b')
        .replace(/[\f]/g, '\\f')
        .replace(/[\n]/g, '\\n')
        .replace(/[\r]/g, '\\r')
        .replace(/[\t]/g, '\\t')
        .replace(/[\"]/g, '\\"')
        .replace(/\\'/g, "\\'"); 
}