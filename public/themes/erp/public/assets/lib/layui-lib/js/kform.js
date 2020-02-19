;
layui.define(['form'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form,
        _win = $(window),
        _doc = $(document),
        _componentPath = 'components/'
    var kform = {
        hello: function(str) {
            layer.alert('Hello ' + (str || 'test'));
        },
        config: {
            submitBtn: 'submit',
            url:'',
            start:function(data){},
            success:function(r){},
            error:function(){}
        },
        set: function(options) {
            var that = this;
            $.extend(true, that.config, options);
            return that;
        },
        init: function() {
            var that = this,
                _config = that.config;

            form.on('submit('+_config.submitBtn+')', function(data){
                _config.start(data);
                var url ;
                if (_config.url) {
                    url = _config.url;
                } else {
                    var form_action = $(data.elem).parents('form').attr('action');
                    url = form_action;
                }
                var load = layer.load(2);
                $.ajax({
                    url:url,
                    type:"post",
                    data:data.field,
                    dataType:"json",
                    success:function(r){
                        layer.close(load);
                        if (r.code == 1) {
                            layer.msg(r.msg,{icon: 1,time:1000},function(){
                                _config.success(r);
                            });
                        }else{
                            layer.msg(r.msg,{icon: 2,time:2000});
                        }
                    },
                    error:function(){
                        _config.error();
                        layer.close(load);
                        layer.msg('网络错误！',{icon: 2});//错误提示
                    }
                });
                    
                return false;
            });

            return that;
        }
    };

    //输出test接口
    exports('kform', kform);
});