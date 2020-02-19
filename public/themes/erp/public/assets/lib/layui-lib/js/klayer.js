;
layui.define(['layer'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        _win = $(window),
        _doc = $(document),
        _componentPath = 'components/'
    var klayer = {
        hello: function(str) {
            layer.alert('Hello ' + (str || 'test'));
        },
        config: {
            title:'',
            shade:.3,
            area:['500px','400px'],
            url:'',
            resize:false
        },
        set: function(options) {
            var that = this;
            $.extend(true, that.config, options);
            return that;
        },
        init: function() {
            var that = this,
                _config = that.config;
            var area;
            if (_config.area == 'xs') {
                area = ['400px','300px'];
            }else if (_config.area == 'sm') {
                area = ['500px','400px'];
            }else if (_config.area == 'md') {
                area = ['800px','500px'];
            }else if (_config.area == 'lg') {
                area = ['100%','100%'];
            }else{
                area = _config.area;
            }

            layer.open({
              type: 2,
              resize:_config.resize,
              title: _config.title,
              shadeClose: false,
              shade: _config.shade,
              area: area,
              content: _config.url //iframe的url
            }); 
            return that;
        }
    };

    //输出test接口
    exports('klayer', klayer);
});