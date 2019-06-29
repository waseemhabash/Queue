// global variables
var isIE8 = false;
var isIE9 = false;
var $windowWidth;
var $windowHeight;
var $pageArea;
// Debounce Function
(function ($, sr) {
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        var timeout;
        return function debounced() {
            var obj = this,
                args = arguments;

            function delayed() {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            };

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    };
    // smartresize
    jQuery.fn[sr] = function (fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'clipresize');

//Main Function
var Main = function () {
    //function to detect explorer browser and its version
    var runInit = function () {
        if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
            var ieversion = new Number(RegExp.$1);
            if (ieversion == 8) {
                isIE8 = true;
            } else if (ieversion == 9) {
                isIE9 = true;
            }
        }
    };
    //function to adjust the template elements based on the window size
    var runElementsPosition = function () {
        $windowWidth = $(window).width();
        $windowHeight = $(window).height();
        $pageArea = $windowHeight - $('body > .navbar').outerHeight() - $('body > .footer').outerHeight();
        $('.sidebar-search input').removeAttr('style').removeClass('open');
        runContainerHeight();

    };
    //function to adapt the Main Content height to the Main Navigation height
    var runContainerHeight = function () {
        mainContainer = $('.main-content > .container');
        mainNavigation = $('.main-navigation');
        if ($pageArea < 760) {
            $pageArea = 760;
        }
        if (mainContainer.outerHeight() < mainNavigation.outerHeight() && mainNavigation.outerHeight() > $pageArea) {
            mainContainer.css('min-height', mainNavigation.outerHeight());
        } else {
            mainContainer.css('min-height', $pageArea);
        };
        if ($windowWidth < 768) {
            mainNavigation.css('min-height', $windowHeight - $('body > .navbar').outerHeight());
        }
    };
    //function to activate the ToDo list, if present
    var runToDoAction = function () {
        if ($(".todo-actions").length) {
            $(".todo-actions").click(function () {
                if ($(this).find("i").hasClass("fa-square-o") || $(this).find("i").hasClass("icon-check-empty")) {
                    if ($(this).find("i").hasClass("fa")) {
                        $(this).find("i").removeClass("fa-square-o").addClass("fa-check-square-o");
                    } else {
                        $(this).find("i").removeClass("icon-check-empty").addClass("fa fa-check-square-o");
                    };
                    $(this).parent().find("span").css({
                        opacity: .25
                    });
                    $(this).parent().find(".desc").css("text-decoration", "line-through");
                } else {
                    $(this).find("i").removeClass("fa-check-square-o").addClass("fa-square-o");
                    $(this).parent().find("span").css({
                        opacity: 1
                    });
                    $(this).parent().find(".desc").css("text-decoration", "none");
                }
                return !1;
            });
        }
    };
    //function to activate the Tooltips, if present
    var runTooltips = function () {
        if ($(".tooltips").length) {
            $('.tooltips').tooltip();
        }
    };
    //function to activate the Popovers, if present
    var runPopovers = function () {
        if ($(".popovers").length) {
            $('.popovers').popover();
        }
    };
    //function to allow a button or a link to open a tab
    var runShowTab = function () {
        if ($(".show-tab").length) {
            $('.show-tab').bind('click', function (e) {
                e.preventDefault();
                var tabToShow = $(this).attr("href");
                if ($(tabToShow).length) {
                    $('a[href="' + tabToShow + '"]').tab('show');
                }
            });
        };
        if (getParameterByName('tabId').length) {
            $('a[href="#' + getParameterByName('tabId') + '"]').tab('show');
        }
    };
    var runPanelScroll = function () {
        if ($(".panel-scroll").length) {
            $('.panel-scroll').perfectScrollbar({
                wheelSpeed: 50,
                minScrollbarLength: 20,
                suppressScrollX: true
            });
        }
    };
    //function to extend the default settings of the Accordion
    var runAccordionFeatures = function () {
        if ($('.accordion').length) {
            $('.accordion .panel-collapse').each(function () {
                if (!$(this).hasClass('in')) {
                    $(this).prev('.panel-heading').find('.accordion-toggle').addClass('collapsed');
                }
            });
        }
        $(".accordion").collapse().height('auto');
        var lastClicked;

        $('.accordion .accordion-toggle').bind('click', function () {
            currentTab = $(this);
            $('html,body').animate({
                scrollTop: currentTab.offset().top - 100
            }, 1000);
        });
    };
    //function to reduce the size of the Main Menu
    var runNavigationToggler = function () {
        $('.navigation-toggler').bind('click', function () {
            if (!$('body').hasClass('navigation-small')) {
                $('body').addClass('navigation-small');
            } else {
                $('body').removeClass('navigation-small');
            };
        });
    };
    //function to activate the panel tools
    var runModuleTools = function () {
        $('.panel-tools .panel-expand').bind('click', function (e) {
            $('.panel-tools a').not(this).hide();
            $('body').append('<div class="full-white-backdrop"></div>');
            $('.main-container').removeAttr('style');
            backdrop = $('.full-white-backdrop');
            wbox = $(this).parents('.panel');
            wbox.removeAttr('style');
            if (wbox.hasClass('panel-full-screen')) {
                backdrop.fadeIn(200, function () {
                    $('.panel-tools a').show();
                    wbox.removeClass('panel-full-screen');
                    backdrop.fadeOut(200, function () {
                        backdrop.remove();
                    });
                });
            } else {
                $('body').append('<div class="full-white-backdrop"></div>');
                backdrop.fadeIn(200, function () {
                    $('.main-container').css({
                        'max-height': $(window).outerHeight() - $('header').outerHeight() - $('.footer').outerHeight() - 100,
                        'overflow': 'hidden'
                    });
                    backdrop.fadeOut(200);
                    backdrop.remove();
                    wbox.addClass('panel-full-screen').css({
                        'max-height': $(window).height(),
                        'overflow': 'auto'
                    });
                });
            }
        });
        $('.panel-tools .panel-close').bind('click', function (e) {
            $(this).parents(".panel").remove();
            e.preventDefault();
        });
        $('.panel-tools .panel-refresh').bind('click', function (e) {
            var el = $(this).parents(".panel");
            el.block({
                overlayCSS: {
                    backgroundColor: '#fff'
                },
                message: '<img src="assets/images/loading.gif" /> Just a moment...',
                css: {
                    border: 'none',
                    color: '#333',
                    background: 'none'
                }
            });
            window.setTimeout(function () {
                el.unblock();
            }, 1000);
            e.preventDefault();
        });
        $('.panel-tools .panel-collapse').bind('click', function (e) {
            e.preventDefault();
            var el = jQuery(this).parent().closest(".panel").children(".panel-body");
            if ($(this).hasClass("collapses")) {
                $(this).addClass("expand").removeClass("collapses");
                el.slideUp(200);
            } else {
                $(this).addClass("collapses").removeClass("expand");
                el.slideDown(200);
            }
        });
    };
    //function to activate the 3rd and 4th level menus
    var runNavigationMenu = function () {
        $('.main-navigation-menu li.active').addClass('open');
        $('.main-navigation-menu > li a').bind('click', function () {
            if ($(this).parent().children('ul').hasClass('sub-menu') && ((!$('body').hasClass('navigation-small') || $windowWidth < 767) || !$(this).parent().parent().hasClass('main-navigation-menu'))) {
                if (!$(this).parent().hasClass('open')) {
                    $(this).parent().addClass('open');
                    $(this).parent().parent().children('li.open').not($(this).parent()).not($('.main-navigation-menu > li.active')).removeClass('open').children('ul').slideUp(200);
                    $(this).parent().children('ul').slideDown(200, function () {
                        runContainerHeight();
                    });
                } else {
                    if (!$(this).parent().hasClass('active')) {
                        $(this).parent().parent().children('li.open').not($('.main-navigation-menu > li.active')).removeClass('open').children('ul').slideUp(200, function () {
                            runContainerHeight();
                        });
                    } else {
                        $(this).parent().parent().children('li.open').removeClass('open').children('ul').slideUp(200, function () {
                            runContainerHeight();
                        });
                    }
                }
            }
        });
    };
    //function to activate the Go-Top button
    var runGoTop = function () {
        $('.go-top').bind('click', function (e) {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            e.preventDefault();
        });
    };
    //function to avoid closing the dropdown on click
    var runDropdownEnduring = function () {
        if ($('.dropdown-menu.dropdown-enduring').length) {
            $('.dropdown-menu.dropdown-enduring').click(function (event) {
                event.stopPropagation();
            });
        }
    };
    //function to return the querystring parameter with a given name.
    var getParameterByName = function (name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    };
    //function to activate the iCheck Plugin
    var runCustomCheck = function () {
        if ($('input[type="checkbox"]').length || $('input[type="radio"]').length) {
            $('input[type="checkbox"].grey, input[type="radio"].grey').iCheck({
                checkboxClass: 'icheckbox_minimal-grey',
                radioClass: 'iradio_minimal-grey',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].red, input[type="radio"].red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].green, input[type="radio"].green').iCheck({
                checkboxClass: 'icheckbox_minimal-green',
                radioClass: 'iradio_minimal-green',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].teal, input[type="radio"].teal').iCheck({
                checkboxClass: 'icheckbox_minimal-aero',
                radioClass: 'iradio_minimal-aero',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].orange, input[type="radio"].orange').iCheck({
                checkboxClass: 'icheckbox_minimal-orange',
                radioClass: 'iradio_minimal-orange',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].purple, input[type="radio"].purple').iCheck({
                checkboxClass: 'icheckbox_minimal-purple',
                radioClass: 'iradio_minimal-purple',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].yellow, input[type="radio"].yellow').iCheck({
                checkboxClass: 'icheckbox_minimal-yellow',
                radioClass: 'iradio_minimal-yellow',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-black, input[type="radio"].square-black').iCheck({
                checkboxClass: 'icheckbox_square',
                radioClass: 'iradio_square',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-grey, input[type="radio"].square-grey').iCheck({
                checkboxClass: 'icheckbox_square-grey',
                radioClass: 'iradio_square-grey',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-red, input[type="radio"].square-red').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-green, input[type="radio"].square-green').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-teal, input[type="radio"].square-teal').iCheck({
                checkboxClass: 'icheckbox_square-aero',
                radioClass: 'iradio_square-aero',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-orange, input[type="radio"].square-orange').iCheck({
                checkboxClass: 'icheckbox_square-orange',
                radioClass: 'iradio_square-orange',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-purple, input[type="radio"].square-purple').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-yellow, input[type="radio"].square-yellow').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-black, input[type="radio"].flat-black').iCheck({
                checkboxClass: 'icheckbox_flat',
                radioClass: 'iradio_flat',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass: 'iradio_flat-red',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-teal, input[type="radio"].flat-teal').iCheck({
                checkboxClass: 'icheckbox_flat-aero',
                radioClass: 'iradio_flat-aero',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-orange, input[type="radio"].flat-orange').iCheck({
                checkboxClass: 'icheckbox_flat-orange',
                radioClass: 'iradio_flat-orange',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-purple, input[type="radio"].flat-purple').iCheck({
                checkboxClass: 'icheckbox_flat-purple',
                radioClass: 'iradio_flat-purple',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-yellow, input[type="radio"].flat-yellow').iCheck({
                checkboxClass: 'icheckbox_flat-yellow',
                radioClass: 'iradio_flat-yellow',
                increaseArea: '10%' // optional
            });
        };
    };
    //Search Input function
    var runSearchInput = function () {
        var search_input = $('.sidebar-search input');
        var search_button = $('.sidebar-search button');
        var search_form = $('.sidebar-search');
        search_input.attr('data-default', $(search_input).outerWidth()).focus(function () {
            $(this).animate({
                width: 200
            }, 200);
        }).blur(function () {
            if ($(this).val() == "") {
                if ($(this).hasClass('open')) {
                    $(this).animate({
                        width: 0,
                        opacity: 0
                    }, 200, function () {
                        $(this).hide();
                    });
                } else {
                    $(this).animate({
                        width: $(this).attr('data-default')
                    }, 200);
                }
            }
        });
        search_button.bind('click', function () {
            if ($(search_input).is(':hidden')) {
                $(search_input).addClass('open').css({
                    width: 0,
                    opacity: 0
                }).show().animate({
                    width: 200,
                    opacity: 1
                }, 200).focus();
            } else if ($(search_input).hasClass('open') && $(search_input).val() == '') {
                $(search_input).removeClass('open').animate({
                    width: 0,
                    opacity: 0
                }, 200, function () {
                    $(this).hide();
                });
            } else if ($(search_input).val() != '') {
                return;
            } else
                $(search_input).focus();
            return false;
        });
    };
    //Set of functions for Style Selector
    var runStyleSelector = function () {
        $('.style-toggle').bind('click', function () {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open').addClass('close');
                $('#style_selector_container').hide();
            } else {
                $(this).removeClass('close').addClass('open');
                $('#style_selector_container').show();
            }
        });
        setColorScheme();
        setLayoutStyle();
        setHeaderStyle();
        setFooterStyle();
        setBoxedBackgrounds();
    };
    $('.drop-down-wrapper').perfectScrollbar({
        wheelSpeed: 50,
        minScrollbarLength: 20,
        suppressScrollX: true
    });
    $('.navbar-tools .dropdown').on('shown.bs.dropdown', function () {
        $(this).find('.drop-down-wrapper').scrollTop(0).perfectScrollbar('update');
    });
    var setColorScheme = function () {
        $('.icons-color a').bind('click', function () {
            $('.icons-color img').each(function () {
                $(this).removeClass('active');
            });
            $(this).find('img').addClass('active');
            if ($('#skin_color').attr("rel") == "stylesheet/less") {
                $('#skin_color').next('style').remove();
                $('#skin_color').attr("rel", "stylesheet");

            }
            $('#skin_color').attr("href", "assets/css/theme_" + $(this).attr('id') + ".css");

        });
    };
    var setBoxedBackgrounds = function () {
        $('.boxed-patterns a').bind('click', function () {
            if ($('body').hasClass('layout-boxed')) {
                var classes = $('body').attr("class").split(" ").filter(function (item) {
                    return item.indexOf("bg_style_") === -1 ? item : "";
                });
                $('body').attr("class", classes.join(" "));
                $('.boxed-patterns img').each(function () {
                    $(this).removeClass('active');
                });
                $(this).find('img').addClass('active');
                $('body').addClass($(this).attr('id'));
            } else {
                alert('Select boxed layout');
            }
        });
    };
    var setLayoutStyle = function () {
        $('select[name="layout"]').change(function () {
            if ($('select[name="layout"] option:selected').val() == 'boxed')
                $('body').addClass('layout-boxed');
            else
                $('body').removeClass('layout-boxed');
        });
    };
    var setHeaderStyle = function () {
        $('select[name="header"]').change(function () {
            if ($('select[name="header"] option:selected').val() == 'default')
                $('body').addClass('header-default');
            else
                $('body').removeClass('header-default');
        });
    };
    var setFooterStyle = function () {
        $('select[name="footer"]').change(function () {
            if ($('select[name="footer"] option:selected').val() == 'fixed')
                $('body').addClass('footer-fixed');
            else
                $('body').removeClass('footer-fixed');
        });
    };
    var runColorPalette = function () {
        if ($('.colorpalette').length) {
            $('.colorpalette').colorPalette().on('selectColor', function (e) {
                $(this).closest('ul').prev('a').children('i').css('background-color', e.color).end().closest('div').prev('input').val(e.color);
                runActivateLess();
            });
        };
    };

    //function to activate Less style
    var runActivateLess = function () {
        $('		.icons-color img').removeClass('active');
        if ($('#skin_color').attr("rel") == "stylesheet") {
            $('#skin_color').attr("rel", "stylesheet/less").attr("href", "assets/less/styles.less");
            less.sheets.push($('link#skin_color')[0]);
            less.refresh();
        };
        less.modifyVars({
            '@base': $('.color-base').val(),
            '@text': $('.color-text').val(),
            '@badge': $('.color-badge').val()
        });
    };

    //Window Resize Function
    var runWIndowResize = function (func, threshold, execAsap) {
        //wait until the user is done resizing the window, then execute
        $(window).clipresize(function () {
            runElementsPosition();
        });
    };
    //function to save user settings
    var runSaveSetting = function () {
        $('.save_style').bind('click', function () {
            var clipSetting = new Object;
            if ($('body').hasClass('rtl')) {
                clipSetting.rtl = true;
            } else {
                clipSetting.rtl = false;
            };
            if ($('body').hasClass('layout-boxed')) {
                clipSetting.layoutBoxed = true;
                $("body[class]").filter(function () {
                    var classNames = this.className.split(/\s+/);
                    for (var i = 0; i < classNames.length; ++i) {
                        if (classNames[i].substr(0, 9) === "bg_style_") {
                            clipSetting.bgStyle = classNames[i];
                        }
                    }

                });
            } else {
                clipSetting.layoutBoxed = false;
            };
            if ($('body').hasClass('header-default')) {
                clipSetting.headerDefault = true;
            } else {
                clipSetting.headerDefault = false;
            };
            if ($('body').hasClass('footer-fixed')) {
                clipSetting.footerDefault = false;
            } else {
                clipSetting.footerDefault = true;
            };
            if ($('#skin_color').attr('rel') == 'stylesheet') {
                clipSetting.useLess = false;
            } else if ($('#skin_color').attr('rel') == 'stylesheet/less') {
                clipSetting.useLess = true;
                clipSetting.baseColor = $('.color-base').val();
                clipSetting.textColor = $('.color-text').val();
                clipSetting.badgeColor = $('.color-badge').val();
            };
            clipSetting.skinClass = $('#skin_color').attr('href');

            $.cookie("clip-setting", JSON.stringify(clipSetting));

            var el = $('#style_selector_container');
            el.block({
                overlayCSS: {
                    backgroundColor: '#fff'
                },
                message: '<img src="assets/images/loading.gif" /> Just a moment...',
                css: {
                    border: 'none',
                    color: '#333',
                    background: 'none'
                }
            });
            window.setTimeout(function () {
                el.unblock();
            }, 1000);
        });
    };
    //function to load user settings
    var runCustomSetting = function () {
        if ($.cookie("clip-setting")) {
            var loadSetting = jQuery.parseJSON($.cookie("clip-setting"));
            if (loadSetting.layoutBoxed) {

                $('body').addClass('layout-boxed');
                $('#style_selector select[name="layout"]').find('option[value="boxed"]').attr('selected', 'true');
            };
            if (loadSetting.headerDefault) {
                $('body').addClass('header-default');
                $('#style_selector select[name="header"]').find('option[value="default"]').attr('selected', 'true');
            };
            if (!loadSetting.footerDefault) {
                $('body').addClass('footer-fixed');
                $('#style_selector select[name="footer"]').find('option[value="fixed"]').attr('selected', 'true');
            };
            if ($('#style_selector').length) {
                if (loadSetting.useLess) {

                    $('.color-base').val(loadSetting.baseColor).next('.dropdown').find('i').css('background-color', loadSetting.baseColor);
                    $('.color-text').val(loadSetting.textColor).next('.dropdown').find('i').css('background-color', loadSetting.textColor);
                    $('.color-badge').val(loadSetting.badgeColor).next('.dropdown').find('i').css('background-color', loadSetting.badgeColor);
                    runActivateLess();
                } else {
                    $('.color-base').val('#FFFFFF').next('.dropdown').find('i').css('background-color', '#FFFFFF');
                    $('.color-text').val('#555555').next('.dropdown').find('i').css('background-color', '#555555');
                    $('.color-badge').val('#007AFF').next('.dropdown').find('i').css('background-color', '#007AFF');
                    $('#skin_color').attr('href', loadSetting.skinClass);
                };
            };
            $('body').addClass(loadSetting.bgStyle);
        } else {
            runDefaultSetting();
        };
    };
    //function to clear user settings
    var runClearSetting = function () {
        $('.clear_style').bind('click', function () {
            $.removeCookie("clip-setting");
            $('body').removeClass("layout-boxed header-default footer-fixed");
            $('body')[0].className = $('body')[0].className.replace(/\bbg_style_.*?\b/g, '');
            if ($('#skin_color').attr("rel") == "stylesheet/less") {
                $('#skin_color').next('style').remove();
                $('#skin_color').attr("rel", "stylesheet");

            }

            $('.icons-color img').first().trigger('click');
            runDefaultSetting();
        });
    };
    //function to restore user settings
    var runDefaultSetting = function () {
        $('#style_selector select[name="layout"]').val('default');
        $('#style_selector select[name="header"]').val('fixed');
        $('#style_selector select[name="footer"]').val('default');
        $('		.boxed-patterns img').removeClass('active');
        $('.color-base').val('#FFFFFF').next('.dropdown').find('i').css('background-color', '#FFFFFF');
        $('.color-text').val('#555555').next('.dropdown').find('i').css('background-color', '#555555');
        $('.color-badge').val('#007AFF').next('.dropdown').find('i').css('background-color', '#007AFF');
    };
    return {
        //main function to initiate template pages
        init: function () {
            runWIndowResize();
            runInit();
            runStyleSelector();
            runSearchInput();
            runElementsPosition();
            runToDoAction();
            runNavigationToggler();
            runNavigationMenu();
            runGoTop();
            runModuleTools();
            runDropdownEnduring();
            runTooltips();
            runPopovers();
            runPanelScroll();
            runShowTab();
            runAccordionFeatures();
            runCustomCheck();
            runColorPalette();
            runSaveSetting();
            runCustomSetting();
            runClearSetting();
        }
    };
}();

function getRandomColor(i) {
    var colors = [
        "#9651ec","#30D99D","#4713AD","#710B19","#0961B8","#896496","#2592D5","#ED6822",
        "#2B0488","#2B7FC0","#C6AE0F","#D1BC60","#67DB79","#1B702C","#DEDCD6","#B25DBB",
        "#B2ABB1","#2A378A","#CEFDD2","#88D9A1","#2EE7B0","#49A1CF","#D3B830","#5072BB",
        "#40F121","#24EBBC","#0FA32B","#4C2DC3","#A106E9","#753773","#92F1DA","#96172C",
        "#E878CE","#45A43B","#8B20E9","#8FDFB4","#3EC711","#964095","#61B6BE","#D7F645",
        "#17559B","#88DBDD","#CE199A","#D3B5F3","#2AF0E1","#246488","#A135B3","#61D97A",
        "#43A894","#87B3F4","#3E3AC1","#A1E047","#A4DB53","#83CDA4","#D89D0E","#AEDB7B",
        "#4E0D94","#64DFB5","#C52085","#F4D0A3","#7D6AD3","#722C90","#9B1C03","#BE4C20",
        "#7B8325","#65A26E","#26DB87","#17C91A","#389AAB","#1FBA60","#C5E118","#DDAA8F",
        "#2C97B9","#51857D","#AEEF2F","#1D903C","#051E6D","#978F36","#90C0E6","#A67EB5",
        "#183A41","#BA039F","#FB653E","#682BCE","#7BE497","#BE6BA8","#442194","#866E16",
        "#E00C19","#108AAA","#DAD3E1","#0A0C00","#1B19C7","#F19CAA","#949A1F","#5EE69F",
        "#B9C016","#36B94A","#50E654","#DC1E52","#38EBF5","#C479E1","#19D872","#647F39",
        "#5C5B15","#216212","#19FC48","#7B071D","#F6D70D","#91769E","#0C81C1","#7FC50C",
        "#44C690","#205280","#1B33CE","#82475D","#54648D","#327F75","#7A85C7","#A120D4",
        "#F60F5F","#DA7A2D","#9EBA36","#26E570","#70F891","#009406","#07D3FE","#F225BA",
        "#87131F","#E3F12E","#8AE876","#7A7E0E","#907681","#661302","#E81546","#A94C37",
        "#AD44D9","#ED1233","#E18B2F","#947E32","#D8E72D","#3C657A","#EFEF58","#03F546",
        "#0C1764","#4FF562","#7C2B5A","#656D20","#7CE502","#D45725","#3AF9DE","#D9CC94",
        "#47777D","#D87C03","#BB6906","#9C0B91","#5FF60B","#B4A6B4","#C80953","#4C88BA",
        "#4A531B","#850306","#B2610A","#56D3ED","#2ACE0A","#F0C163","#4057FF","#8F4177",
        "#1A2E76","#5D6F06","#2A6346","#862ED6","#6B903F","#5068F8","#B719EF","#AE5917",
        "#425B62","#3FDA4E","#EFBE23","#853FCF","#5BB061","#DC0AB5","#3A4482","#748546",
        "#63AD76","#3E59F5","#3572DC","#9F3D9A","#1734CC","#2A00AD","#D926FC","#686891",
        "#925B1D","#A028D6","#2207B9","#BB0466","#3DF80D","#520321","#0219DE","#C15812",
        "#6783D8","#8092B8","#5D4322","#23777D","#3FF2C8","#0D400D","#38CAA5","#5E9F37",
        "#BDEC12","#A5A87D","#EE950B","#1F33AB","#636B08","#1FE919","#8211D5","#DC5600",
        "#1039AE","#8A3BAA","#E1EB15","#3BE4FC","#ED4FF6","#9FDE29","#91BED9","#12C1F1",
        "#9853A3","#E70DB6","#243DD0","#033410","#0D43DC","#7969C2","#54C1D9","#9900D3",
        "#746FDA","#732E1E","#86FD6B","#3C483E","#66F5E4","#521FF3","#A00B07","#3505E0",
        "#E89CC9","#9981D8","#172287","#97D4BD","#97E79A","#D46681","#F52F9A","#46BC05",
        "#52AF57","#41725F","#67829E","#D8D438","#0EBCB4","#86A11C","#094DB0","#DBFE53",
        "#60CA57","#28EF9A","#8D71DF","#43CBC7","#8A9A0D","#4A12C2","#FADA0A","#CB4AA8",
        "#23AE20","#BFBE19","#E78BE3","#C256D8","#9BBB2C","#292C4C","#350A09","#5A8768",
        "#6C4967","#57EFE0","#2A0FBF","#B29C9D","#5F57B2","#3F12C7","#3D9CDA","#41717D",
        "#2B326A","#D53EC9","#FC14E8","#CB94CC","#17F0DF","#FF9C13","#61E961","#508CCA",
        "#6DC858","#5F2BE5","#BCA6EB","#50ADF2","#E52CE8","#EE18FF","#4F5EDB","#8EA79A",
        "#B0D235","#CE2718","#7361EF","#86241E","#AADC34","#988860","#C985A1","#DC601A",
        "#F7C62E","#991516","#A24282","#A6EC9B","#7D610C","#CBA589","#87B037","#0A373D",
        "#2D8D76","#AF767B","#3FDA6E","#788860","#ACC66A","#127D34","#85024D","#71C60E",
        "#5CBFAC","#53D73C","#57ABCB","#E06F15","#10B215","#515670","#584370","#41A0C7",
        "#51EB07","#76FCC4","#12EE90","#AF3124","#156104","#6123BE","#31DB2D","#B9C7CB",
        "#B438AD","#67CE47","#55E110","#858A04","#401DB7","#053D16","#F5DAC3","#DB9694",
        "#FAE95A","#BCC25D","#25EAF2","#9BC203","#27F33E","#0CB8B8","#198CC7","#1E1B0F",
        "#944747","#6A5F83","#4E515B","#8148AE","#99AD99","#E2DFF4","#55B00F","#511C50",
        "#C73F2F","#68C192","#9E0C2E","#922412","#867C29","#342DBE","#82FE9F","#E06F88",
        "#105E28","#BBA92F","#415434","#DEBAA6","#814A2B","#FC5A9B","#48AF6C","#BF112D",
        "#00AD2B","#6D0CED","#046753","#B50458","#39B657","#843FD0","#45B56E","#B9B68D",
        "#1C9E0C","#140827","#68965D","#6FD4A9","#DC9B91","#31411A","#8E5A6D","#AE1DD9",
        "#0D7B9E","#2ED0E0","#2B86BF","#D14839","#E4CE72","#87B53D","#979342","#883CE2",
        "#DF4771","#F7F3F8","#C491E3","#1E61F3","#63AC5A","#D1E5D2","#18B1D6","#0D9C6F",
        "#D8D0DC","#F1D4A4","#2FA064","#240919","#29F8D1","#663015","#075E25","#7F9F29",
        "#88F9DF","#831925","#BA4DF9","#44419D","#A87FEE","#9F5EEF","#973115","#E82289",
        "#74BFB3","#BC185E","#0D9F7B","#15FB8C","#8894CF","#414253","#0CF8BF","#A8D8BB",
        "#6724F0","#8B73C4","#C3DC3D","#0C47A0","#510BEF","#3BED85","#169ED3","#EF1FF4",
        "#88C23E","#86A7FC","#9EAE1D","#C3E6C2","#B34E2E","#3E25C0","#C55D08","#F384D1",
        "#DE7F8B","#A95053","#97DC3C","#0EA857","#C0C291","#03E275","#6AFC8F","#52F990",
        "#346400","#565C35","#E4EC84","#F54DDD","#A87B5D","#B5026B","#2466E8","#12A3C9",
        "#07111E","#628865","#C6D508","#745C8D","#80A69D","#670232","#D4C9BE","#18062C",
        "#5EC07D","#5D6D76","#1BE89A","#5393DF","#672717","#F50943","#3EAB7D","#0B8E17",
        "#B3796C","#9C4BC3","#C919A5","#54775D","#9C1052","#1A02F5","#E00AC4","#798CC8",
        "#FB46C6","#38935D","#135FB1","#C3ECEF","#8A66CC","#0FF3E8","#D7ACC9","#3D32EE",
        "#542770","#95F5DF","#3C9907","#C179BF","#2899CA","#E01E42","#FA9DCE","#DD41F4",
        "#9F62A9","#A059B5","#D40F89","#954543","#6F4CD4","#E6232F","#E252FF","#4DA9BD",
        "#1A5CB4","#1E6644","#FB4415","#4EE4A3","#53D235","#C3D932","#2EE1C8","#58BE72",
        "#B61B6C","#932348","#42B533","#61FE60","#715319","#D9E40E","#57FAB1","#D5FC47",
        "#88BB7B","#5A0EA1","#E23FEA","#0EC824","#A1B684","#D435CF","#F6EBB4","#1AD21E",
        "#557F29","#1F94E6","#8D251B","#613E75","#74A4E6","#DE2817","#8B830B","#52E816",
        "#A7BD04","#FAC75F","#92E3D5","#33ECE6","#F7D758","#9E02E3","#ABFB3F","#1B206F",
        "#0EE190","#C1C428","#AFB1CF","#4AA9D4","#7A4347","#736ECF","#A1BAF2","#3C854E",
        "#5F1783","#C1E38D","#96E5B9","#8D0EF4","#916B99","#A28170","#313EFF","#FC86CD",
        "#DF0A9B","#9631AB","#04FDF7","#844B41","#0CA402","#D5203A","#46F167","#FE39B2",
        "#4AC538","#F5AFA1","#663FC6","#100877","#335DB1","#25C185","#65649F","#7BDF60",
        "#501D37","#04029C","#1FA298","#FD87ED","#996C42","#050BC2","#9BFFDD","#94D15A",
        "#60EFF6","#11216E","#7B145E","#7958F9","#A0353F","#046125","#0B6908","#B36A09",
        "#CB43F6","#7B5383","#861D56","#F6042C","#88ECA4","#7A9B0F","#70596A","#8BF296",
        "#BBF769","#888678","#8A68E0","#11C167","#C3FE34","#2C3C4A","#9F052A","#99783D",
        "#C67551","#8264D3","#4E1A20","#406729","#F6AEF0","#2519C8","#5E1DC1","#389D41",
        "#2C01F5","#6AE77C","#87242D","#E8BFBE","#826F55","#D2FD90","#27B089","#52A5E0",
        "#57BE58","#3A0F3B","#5E2885","#D110DC","#1E79DB","#A39528","#4745C8","#DC7D54",
        "#1A17BC","#7619AF","#E31C0B","#000D42","#EC53E8","#5C938E","#35D6FD","#CC5BF4"];
        return colors[i];
    }

