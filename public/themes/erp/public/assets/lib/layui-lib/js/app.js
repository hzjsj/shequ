/** k_admin-v1.1.0 MIT License By http://k/zhengjinfan.cn e-mail:zheng_jinfan@126.com */
 ;/**
 * Name:app.js
 * Author:Van
 * E-mail:zheng_jinfan@126.com
 * Website:http://k.zhengjinfan.cn/
 * LICENSE:MIT
 */
var tab;
/*
layui 内置：element form table laytpl
    
 */
layui.define(['element', 'nprogress', 'form', 'table', 'tab', 'navbar', 'laytpl'], function(exports) {
    var $ = layui.jquery,
        element = layui.element,
        layer = layui.layer,
        _win = $(window),
        _doc = $(document),
        form = layui.form,
        table = layui.table,
        navbar = layui.navbar,
        _componentPath = 'components/',
    tab = layui.tab
    var app = {
        hello: function(str) {
            layer.alert('Hello ' + (str || 'test'));
        },
        config: {
            type: 'iframe'
            ,mainUrl:''
        },
        set: function(options) {
            var that = this;
            $.extend(true, that.config, options);
            return that;
        },
        init: function() {
            var that = this,
                _config = that.config;
            
            if (_config.type === 'iframe') {
                tab.set({
                    renderType: _config.type,
                    mainUrl: _config.mainUrl,
                    openWait: false,
                    elem: '#container',
                    onSwitch: function(data) { //选项卡切换时触发

                    },
                    closeBefore: function(data) { //关闭选项卡之前触发
                        return true; //返回true则关闭
                    }
                }).render();
                //navbar加载方式一，直接绑定已有的dom元素事件                
                navbar.bind(function(data) {
                    tab.tabAdd(data);
                });
            }

            // ripple start
            var addRippleEffect = function(e) {
                console.log(e);
                layui.stope(e);//防止冒泡
                var target = e.target;
                if (target.localName !== 'button' && target.localName !== 'a') return false;
                var rect = target.getBoundingClientRect();
                var ripple = target.querySelector('.ripple');
                if (!ripple) {
                    ripple = document.createElement('span');
                    ripple.className = 'ripple'
                    ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px'
                    target.appendChild(ripple);
                }
                ripple.classList.remove('show');
                var top = e.pageY - rect.top - ripple.offsetHeight / 2 - document.body.scrollTop;
                var left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
                ripple.style.top = top + 'px'
                ripple.style.left = left + 'px'
                ripple.classList.add('show');
                return false;
            }
            document.addEventListener('click', addRippleEffect, false);
            // ripple end

            return that;
        }
    };

    //输出test接口
    exports('app', app);
});