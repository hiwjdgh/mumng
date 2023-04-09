(function () {
    var list_handler
      chkBoxHandler = {
      init: function () {
        initObj = {
          href: "",
          vars: "",
          param: "",
          typeStr: "",
          namingTypeStr: "",
          industryStr: "",
          levelStr: "",
          sort: "normal",
          p: "1",
          view: "list",
        };
        listType = $("input[name='listType']").val();
        viewBtn = $(".listViewT");

        cateTab = $(".cateTab");
        mLevel = $("input[name='mLevel']").val();
        allChkBox = $(".cateBox input");
        sortBox = $(".sort_btn");
        searchText = $("#searchText");
        searchBtn = $(".searchBtn");
        searchClearBtn = $(".searchClearBtn");
        pageBtn = $(".paginate_simple div");
        cl_listArea = $(".cl_listArea");
        calwrap = $(".calwrap");
        processing = false;

        chkBoxObj = {
          type: $("input[name='type[]']"),
          namingType: $("input[name='namingType[]']"),
          industry: $("input[name='industry[]']"),
          level: $("input[name='clLvl[]']"),
        };
        checkedChkBoxObj = {};
        checkedParamObj = {
          sort: "normal",
          searchKey: "",
        };
        domainObj = {};
        dropBtn = $(".dropdownBtn");
        loading = $(".cl_listArea .cl_loading");
        recoSearchBtn = $(".searchKeyBtn");

        chkBoxHandler.action();
        chkBoxHandler.initSetting();
      },
      resetInitObj: function () {
        initObj = {
          href: "",
          vars: "",
          param: "",
          typeStr: "",
          namingTypeStr: "",
          industryStr: "",
          levelStr: "",
          sort: "normal",
          p: "1",
          view: "list",
        };
        checkedChkBoxObj = {};
        checkedParamObj = {
          sort: "normal",
          searchKey: "",
        };
        domainObj = {};
        $("input[name='listType']").val("");
        $("input[name='mLevel']").val("");
        chkBoxHandler.searchClear();

        for (key in chkBoxObj) {
          chkBoxObj[key].removeAttr("checked");
        }
        sortBox.removeClass("selected");
        viewBtn.removeClass("selected");
      },
      initSetting: function () {
        initObj.href = window.location.href.split("?");
        initObj.vars = initObj.href[0];
        initObj.param = initObj.href[1];

        if (initObj.vars) {
          initObj.vars = initObj.vars.split("/");

          for (key in initObj.vars) {
            if (initObj.vars[key]) {
              if (initObj.vars[key].indexOf("view") !== -1) {
                initObj.view = initObj.vars[key].split("-")[1];
                checkedChkBoxObj["view"] = initObj.view.split(",");
              }

              if (initObj.vars[key].indexOf("type") !== -1) {
                initObj.typeStr = initObj.vars[key].split("-")[1];
                checkedChkBoxObj["type"] = initObj.typeStr.split(",");
              }

              if (initObj.vars[key].indexOf("namingType") !== -1) {
                initObj.namingTypeStr = initObj.vars[key].split("-")[1];
                checkedChkBoxObj["namingType"] =
                  initObj.namingTypeStr.split(",");
              }

              if (initObj.vars[key].indexOf("industry") !== -1) {
                initObj.industryStr = initObj.vars[key].split("-")[1];
                checkedChkBoxObj["industry"] = initObj.industryStr.split(",");
              }

              if (initObj.vars[key].indexOf("level") !== -1) {
                initObj.levelStr = initObj.vars[key].split("-")[1];
                checkedChkBoxObj["level"] = initObj.levelStr.split(",");
              }

              if (initObj.vars[key].indexOf("p") !== -1) {
                initObj.p = initObj.vars[key].split("-")[1];
                pageVal = initObj.p;
              }
            }
          }
        }

        if (initObj.param) {
          initObj.param = initObj.param.split("&");

          for (key in initObj.param) {
            if (initObj.param[key].indexOf("click") !== -1) {
              initObj.sort = initObj.param[key].split("=")[0];
              var howSort = initObj.param[key].split("=")[1];
              checkedParamObj.sort = initObj.sort + "=" + howSort;
            }

            if (initObj.param[key].indexOf("searchKey") !== -1) {
              var searchVal = decodeURI(
                decodeURIComponent(initObj.param[key].split("=")[1])
              );
              searchText.val(searchVal);
            }
          }
        }

        if (searchText.val()) {
          checkedParamObj.searchKey = "searchKey=" + searchText.val();
        }

        chkBoxHandler.initSettingDetail();
      },
      initSettingDetail: function () {
        // chkBoxObj.namingType.each(function(){
        //   initObj.namingTypeStr.indexOf($(this).val()) !== -1 ? $(this).attr("checked", "checked") : $(this).removeAttr("checked");
        // });
        chkBoxObj.namingType.each(function () {
          if ($(this).val() === "1") {
            var namingTypeArray = initObj.namingTypeStr.split(",");
            namingTypeArray.indexOf("1") !== -1
              ? $(this).attr("checked", "checked")
              : $(this).removeAttr("checked");
          } else {
            initObj.namingTypeStr.indexOf($(this).val()) !== -1
              ? $(this).attr("checked", "checked")
              : $(this).removeAttr("checked");
          }
        });

        chkBoxObj.type.each(function () {
          var typeArray = initObj.typeStr.split(",");
          if ($(this).val() === "10") {
            typeArray.indexOf("10") !== -1
              ? $(this).attr("checked", "checked")
              : $(this).removeAttr("checked");
          } else {
            typeArray.indexOf(String($(this).val())) !== -1
              ? $(this).attr("checked", "checked")
              : $(this).removeAttr("checked");
          }
        });

        chkBoxObj.industry.each(function () {
          if ($(this).val() === "1") {
            var industryArray = initObj.industryStr.split(",");
            industryArray.indexOf("1") !== -1
              ? $(this).attr("checked", "checked")
              : $(this).removeAttr("checked");
          } else {
            initObj.industryStr.indexOf($(this).val()) !== -1
              ? $(this).attr("checked", "checked")
              : $(this).removeAttr("checked");
          }
        });

        chkBoxObj.level.each(function () {
          initObj.levelStr.indexOf($(this).val()) !== -1
            ? $(this).attr("checked", "checked")
            : $(this).removeAttr("checked");
        });

        chkBoxHandler.initHide();
      },
      initHide: function () {
        sortBox.filter("[data-sort=" + initObj.sort + "]").addClass("selected");
        viewBtn.filter("[data-view=" + initObj.view + "]").addClass("selected");

        if (listType && listType !== "all" && listType !== "audit") {
          var hideBox = sortBox.filter("[data-sort='click_date']");
          var hideDot = $(".sort_dot");
          var hideViewBtn = viewBtn.filter("[data-view='calendar']");

          hideBox.add(hideDot).add(hideViewBtn).addClass("hide");
        }

        if (viewBtn.filter("[data-view='calendar']").hasClass("selected")) {
          chkBoxHandler.ablePage("disabled");
          cl_listArea.addClass("isCalendar");
          calwrap.addClass("isCalendar");
        } else {
          chkBoxHandler.ablePage("enabled");
          cl_listArea.removeClass("isCalendar");
          calwrap.removeClass("isCalendar");
        }

        if (!searchText.val()) chkBoxHandler.searchClear();
      },
      action: function () {
        if (listType == "") {
          $(".statusName").text("진행중 콘테스트");
        } else if (listType == "audit") {
          $(".statusName").text("심사중 콘테스트");
        } else {
          $(".statusName").text("종료된 콘테스트");
        }

        viewBtn.on("click", function () {
          chkBoxHandler.viewSetting($(this));
        });

        allChkBox.on("change", function () {
          chkBoxHandler.chkSetting();
        });

        sortBox.on("click", function () {
          chkBoxHandler.sortSetting($(this));
        });

        searchBtn.on("click", function () {
          chkBoxHandler.searchSetting();
        });

        searchClearBtn.on("click", function () {
          chkBoxHandler.searchClear();
        });

        pageBtn.on("click", function () {
          chkBoxHandler.pageSetting($(this));
        });

        searchText.on("keyup change", function (event) {
          $(this).val() === "" && event.keyCode !== 13
            ? chkBoxHandler.searchButtonHandler("hide")
            : chkBoxHandler.searchButtonHandler("show");
        });

        searchText.on("keydown", function (event) {
          if (event.keyCode === 13) {
            event.preventDefault();
            chkBoxHandler.searchSetting();
          }
        });

        dropBtn.on("click", function () {
          chkBoxHandler.dropBtnHandler($(this));
        });

        recoSearchBtn.on("click", function () {
          chkBoxHandler.recoSearchHandler($(this));
        });

        $(".tipunder2").poshytip({
          className: "tip-twitter",
          showTimeout: 1,
          alignTo: "target",
          alignX: "center",
          alignY: "bottom",
          offsetX: 12,
          allowTipHover: false,
          fade: true,
        });

        $(".wishBtn").insertWish();
      },
      viewSetting: function ($this) {
        if (!$this.hasClass("selected")) {
          var isLoggedIn = $("input[name='isLoggedIn']").val();
          var view = $this.data("view");

          if (!isLoggedIn && view === "wish") {
            showSignNow();
            return;
          }

          chkBoxHandler.pageReset();
          checkedChkBoxObj.view = [view];

          if (view === "calendar") {
            cl_listArea.addClass("isCalendar");
            calwrap.addClass("isCalendar");
            chkBoxHandler.ablePage("disabled");
            chkBoxHandler.domainSetting(true);
          } else if (viewBtn.filter(".selected").data("view") === "calendar") {
            cl_listArea.removeClass("isCalendar");
            calwrap.removeClass("isCalendar");
            chkBoxHandler.ablePage("enabled");
            chkBoxHandler.domainSetting();
          } else {
            chkBoxHandler.ablePage("enabled");
            chkBoxHandler.domainSetting();
          }

          viewBtn.removeClass("selected");
          $this.addClass("selected");
        }
      },
      chkSetting: function () {
        for (key in chkBoxObj) {
          var array = [];

          chkBoxObj[key].filter(":checked").each(function () {
            array.push($(this).val());
          });

          checkedChkBoxObj[key] = array;
        }

        chkBoxHandler.pageReset();
        chkBoxHandler.domainSetting();
      },
      dropBtnHandler: function ($this) {
        var thisData = $this.data("catetab");
        var cateTarget = cateTab.filter("[data-catetab=" + thisData + "]");

        if (cateTarget.hasClass("hide")) {
          cateTarget.removeClass("hide");
          cateTarget.children(".cateBot").slideDown();
        } else {
          cateTarget.addClass("hide");
          cateTarget.children(".cateBot").slideUp();
        }
      },
      recoSearchHandler: function ($this) {
        var searchTitle = $this.data("search");
        searchText.val(searchTitle);
        chkBoxHandler.searchSetting();
      },
      sortSetting: function ($this) {
        if (!$this.hasClass("selected")) {
          sortBox.removeClass("selected");
          $this.addClass("selected");

          var key = $this.data("sort");
          var type = $this.data("type");
          var param = "";

          if (key !== "normal") {
            param = key + "=" + type;
          }

          checkedParamObj.sort = param;
          chkBoxHandler.pageReset();
          chkBoxHandler.domainSetting();
        }
      },
      searchSetting: function () {
        var param = "";
        if (searchText.val()) param += "searchKey=" + searchText.val();

        checkedParamObj.searchKey = param;
        chkBoxHandler.pageReset();
        chkBoxHandler.domainSetting();
      },
      searchClear: function () {
        searchText.val("");
        chkBoxHandler.searchButtonHandler("hide");
      },
      searchButtonHandler: function (type) {
        if (type === "hide") {
          searchClearBtn.hide();
        } else {
          searchClearBtn.show();
        }
      },
      pageSetting: function ($this) {
        pageVal = $this.data("page");
        chkBoxHandler.domainSetting();
      },
      pageReset: function () {
        pageVal = "1";
      },
      domainSetting: function (noAjax, noPopSetting) {
        var modifyUrl = "/contest/list";

        if (listType) {
          modifyUrl += "/" + listType;
        }

        for (key in checkedChkBoxObj) {
          if (
            typeof checkedChkBoxObj[key] !== "undefined" &&
            checkedChkBoxObj[key].length > 0
          ) {
            domainObj[key] = checkedChkBoxObj[key].join();

            modifyUrl += "/" + key + "-" + domainObj[key];
          } else {
            domainObj[key] = null;
          }
        }

        if (pageVal) {
          modifyUrl += "/p-" + pageVal;
        }

        if (checkedParamObj.sort || checkedParamObj.searchKey) {
          var sort = checkedParamObj.sort;
          var search = checkedParamObj.searchKey;

          if (sort === "normal") {
            sort = "";
          }

          if (sort && search) {
            modifyUrl += "?" + sort + "&" + search;
          } else if ((sort && !search) || (!sort && search)) {
            modifyUrl += "?" + sort + search;
          }
        }

        chkBoxHandler.popSetting(modifyUrl, noAjax, noPopSetting);
      },
      popSetting: function (modifyUrl, noAjax, noPopSetting) {
        if (noPopSetting !== true) {
          history.pushState({ data: modifyUrl }, null, modifyUrl);
        }

        if (noAjax !== true) {
          chkBoxHandler.listAjax();
        }
      },
      popAction: function () {
        window.addEventListener("popstate", function () {
          chkBoxHandler.resetInitObj();
          chkBoxHandler.initSetting();
          chkBoxHandler.domainSetting(false, true);
        });
      },
      listAjax: function () {
        $(window).scrollTop(0);
        loading.css("display", "block");
        $(".cl_listArea ul").html("");
        var ajaxData = {
          listType: listType,
          view: domainObj.view,
          type: domainObj.type,
          namingType: domainObj.namingType,
          industry: domainObj.industry,
          level: domainObj.level,
          searchKey: checkedParamObj.searchKey,
          sort: checkedParamObj.sort,
          p: pageVal,
        };
        if (processing) {
          return;
        }
        processing = true;
        $.get("/contest/listAjax", { data: ajaxData }, function (data, status) {
          if (status === "success") {
            if (data) {
              var data = JSON.parse(data);
              $.listAjaxSetting(data);
              chkBoxHandler.reBind();
            } else {
              $.get("/contest/listAjaxNoResult", {}, function (data2, status) {
                var data2 = JSON.parse(data2);
                $.listAjaxSetting(data2);
              });
            }
            processing = false;
          }
        });
      },
      ablePage: function (type) {
        cl_botChkBox = $(".cl_botContent input");

        if (type === "disabled") {
          cl_botChkBox.attr("disabled", true);
          sortBox.removeClass("selected");
          sortBox.addClass("disabled");
          sortBox.unbind("click");
        } else {
          cl_botChkBox.attr("disabled", false);
          sortBox.removeClass("disabled");
          if (checkedParamObj.sort) {
            var sortStr = checkedParamObj.sort.split("=")[0];
            sortBox.filter("[data-sort=" + sortStr + "]").addClass("selected");
          } else {
            sortBox.filter("[data-sort=normal]").addClass("selected");
          }
          sortBox.on("click", function () {
            chkBoxHandler.sortSetting($(this));
          });
        }
      },
      reBind: function () {
        $(".tipunder").poshytip({
          className: "tip-twitter",
          showTimeout: 1,
          alignTo: "target",
          alignX: "center",
          alignY: "bottom",
          offsetX: 12,
          allowTipHover: false,
          fade: true,
        });

        $(".paginate_simple div").on("click", function () {
          chkBoxHandler.pageSetting($(this));
        });

        $(".searchKeyBtn").on("click", function () {
          chkBoxHandler.recoSearchHandler($(this));
        });

        $(".wishBtn").insertWish();
      },
    };
}());