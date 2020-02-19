;layui.define(['jquery', 'form'], function (e) {
    "use strict";

    var MOD_NAME = 'moretoolSelect',
        $ = layui.jquery
        ,form = layui.form
        ,BODY = 'body';
    var MoretoolSelect = function () {
        this.v = '1.0.0';
    };

    /**
    * 初始化表格选择器
    */
    MoretoolSelect.prototype.render = function (options) {
        var opts = options,
            // DOM选择器
            elem = opts.elem,
            // 是否开启搜索：true/false
            //search = opts.search == null ? true : opts.search,
            // 点击回调
            //click = opts.click,
            // json数据
            //data = {},
            // 唯一标识
            tmp = new Date().getTime(),
            TITLE = 'layui-select-title',
            TITLE_ID = 'layui-select-title-' + tmp,
            ICON_BODY = 'layui-iconpicker-' + tmp,
            PICKER_BODY = 'layui-iconpicker-body-' + tmp,
            show = 'layui-moretoolSelect-show',
            unselect = 'layui-unselect';
        var a = {
            init: function () {
                a.toggleSelect().stopPropagation();//绑定事件
                common.loadCss();//加载样式
                return a;
            },
            
            
            /**
             * 展开/折叠下拉框
             */
            toggleSelect: function () {
                var item = elem + ' div.layui-moretoolSelect-title';

                a.event('click', item, function (e) {
                    e.stopPropagation();
                    console.log(e);
                    if ($(elem).hasClass(show)) {
                        $(elem).removeClass(show).addClass(unselect);
                    } else {
                        $(elem).addClass(show).removeClass(unselect);
                    }
                });
                return a;
            },
            
            stopPropagation: function () {
                $(document).on('click', function (e) {
                    e.stopPropagation();
                    console.log(e);
                    $(elem).removeClass(show).addClass(unselect);
                })
                var item = elem + ' div.layui-anim';
                a.event('click', item, function (e) {
                    e.stopPropagation();
                });
                return a;
            },
            
            
            event: function (evt, el, fn) {
                $(BODY).on(evt, el, fn);
            }

        };
        var common = {
            /**
             * 加载样式表
             */
            loadCss: function () {
                var css = '';
                $('head').append('<style rel="stylesheet">'+css+'</style>');
            }
        }
        a.init();
        return new MoretoolSelect();
    }

    var moretoolSelect = new MoretoolSelect();

    e(MOD_NAME, moretoolSelect);
})