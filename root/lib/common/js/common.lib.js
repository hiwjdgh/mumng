(function ($) {
    $.each(['show', 'hide'], function (i, ev) {
      var el = $.fn[ev];
      $.fn[ev] = function () {
        this.trigger(ev);
        return el.apply(this, arguments);
      };
    });

    $.fn.serializeObject = function() {
      var data = {};
      $.each( this.serializeArray(), function( key, obj ) {
        var a = obj.name.match(/(.*?)\[(.*?)\]/);
        if(a !== null)
        {
          var subName = a[1];
          var subKey = a[2];
    
          if( !data[subName] ) {
            data[subName] = [ ];
          }
    
          if (!subKey.length) {
            subKey = data[subName].length;
          }
    
          if( data[subName][subKey] ) {
            if( $.isArray( data[subName][subKey] ) ) {
              data[subName][subKey].push( obj.value );
            } else {
              data[subName][subKey] = [ ];
              data[subName][subKey].push( obj.value );
            }
          } else {
            data[subName][subKey] = obj.value;
          }
        } else {
          if( data[obj.name] ) {
            if( $.isArray( data[obj.name] ) ) {
              data[obj.name].push( obj.value );
            } else {
              data[obj.name] = [ ];
              data[obj.name].push( obj.value );
            }
          } else {
            data[obj.name] = obj.value;
          }
        }
      });
      return data;
    }

})(jQuery);

(function($) {

  var observers = [];

  $.event.special.domNodeInserted = {

    setup: function setup(data, namespaces) {
      var observer = new MutationObserver(checkObservers);

      observers.push([this, observer, []]);
    },

    teardown: function teardown(namespaces) {
      var obs = getObserverData(this);

      obs[1].disconnect();

      observers = $.grep(observers, function(item) {
        return item !== obs;
      });
    },

    remove: function remove(handleObj) {
      var obs = getObserverData(this);

      obs[2] = obs[2].filter(function(event) {
        return event[0] !== handleObj.selector && event[1] !== handleObj.handler;
      });
    },

    add: function add(handleObj) {
      var obs = getObserverData(this);

      var opts = $.extend({}, {
        childList: true,
        subtree: true
      }, handleObj.data);

      obs[1].observe(this, opts);

      obs[2].push([handleObj.selector, handleObj.handler]);
    }
  };

  function getObserverData(element) {
    var $el = $(element);

    return $.grep(observers, function(item) {
      return $el.is(item[0]);
    })[0];
  }

  function checkObservers(records, observer) {
    var obs = $.grep(observers, function(item) {
      return item[1] === observer;
    })[0];

    var triggers = obs[2];

    var changes = [];

    records.forEach(function(record) {
      if (record.type === 'attributes') {
        if (changes.indexOf(record.target) === -1) {
          changes.push(record.target);
        }

        return;
      }

      $(record.addedNodes).toArray().forEach(function(el) {
        if (changes.indexOf(el) === -1) {
          changes.push(el);
        }
      })
    });

    triggers.forEach(function checkTrigger(item) {
      changes.forEach(function(el) {
        var $el = $(el);

        if ($el.is(item[0])) {
          $el.trigger('domNodeInserted');
        }
      });
    });
  }

})(jQuery);

let pave_ajax_ready = true;
function pave_ajax(url, data, done, fail){
  let form_data = "";
  if(data.constructor == Object){
    form_data = new FormData();
    
    for (var key in data) {
        form_data.append(key, data[key]);
    }
  }else{
    if(data[0] == undefined){
      form_data = data;
    }else{
      form_data = new FormData(data[0]);
    }
  }
  
  if(pave_ajax_ready == false){
    console.log(url);
    console.log("false");
    return;
  }

  $.ajax({
    type: "POST",
    processData: false,
    contentType: false,
    cache:false,
    url: url,
    data: form_data,
    beforeSend : function(){
      pave_ajax_ready = false;
      show_loader();
    },
    success: function (result) {
      pave_ajax_ready = true;
      hide_loader();
      try{
          result = $.parseJSON(result);
      }catch(e){
        throw new Error(e);
      }
      done(result);
    },
    error: function (e) {
        fail(e);
    }
  });
}

async function pave_async_ajax(url, method, data){
  show_loader();

  let option = {method: method};

  if(method == "POST"){
    let form_data = "";
    if(data.constructor == Object){
      form_data = new FormData();
      
      for (var key in data) {
          form_data.append(key, data[key]);
      }
    }else{
      if(data[0] == undefined){
        form_data = data;
      }else{
        form_data = new FormData(data[0]);
      }
    }
    $.extend(option,{body: form_data});
  }else if(method == "GET"){
    let query = Object.keys(data)
    .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(data[k]))
    .join('&');

    url = url + "?" + query;
  }


  return await fetch(url, option)
  .then((response) => {
    hide_loader();
    if (!response.ok) {
      throw new Error('네트워크 에러입니다. 다시 시도해주세요.');
    }
    return response.json();
  });
  return request;
/* 
  return 
    .then((result) => {
      return result;
    })
    .catch((error) => {
      console.error(error);
    });
 */
}

$(document).ready(function(){
  $(document).on("keyup", "#header__search #search_keyword", function(e){
      if($(this).val() == ""){
        $(this).closest(".input-box").find("#header__search-remove-button").hide()
      }else{
        $(this).closest(".input-box").find("#header__search-remove-button").show();
      }
      if (e.key === 'Enter' || e.keyCode === 13) {
          location.href = $(this).data("link") + "/" + $(this).val();
      }
  });
  $(document).on("click", "#header__search #header__search-remove-button", function(e){
     $("#header__search #search_keyword").val("").trigger("keyup").focus();
  });
});

function show_loader(){
  $("#loader").css("display", "flex");
}

function hide_loader(){
  $("#loader").css("display", "");
}