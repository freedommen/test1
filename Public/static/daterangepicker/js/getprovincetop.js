
//日历js
$(document).ready(function() {

    $('#adddate').daterangepicker({
            startDate: moment().startOf('day'),
            endDate: moment(),
            minDate: '2016-01-01',    //最小时间  =====>>格式要跟格式化的样式一致
            endDate : moment(), //最大时间
            //dateLimit : {days : 30}, //起止时间的最大间隔
            showDropdowns : true,
            showWeekNumbers : false, //是否显示第几周
            timePicker : false, //是否显示小时和分钟
            timePickerIncrement : 60, //时间的增量，单位为分钟
            timePicker12Hour : false, //是否使用12小时制来显示时间
            ranges : {
                '昨日' : [
                    moment().subtract('days', 1).startOf('day'),
                    moment().subtract('days', 1).endOf('day') ],
                '今日' : [ moment(), moment() ],
                '上周' : [ moment().startOf('week').day(-6).format('MM-DD-YYYY'),moment().endOf('week').day(0).format('MM-DD-YYYY') ],
                '本周' : [ moment().isoWeekday(1).format('MM-DD-YYYY'), moment().isoWeekday(7).format('MM-DD-YYYY') ],
                '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '本月': [moment().startOf('month'), moment().endOf('month')],
                '去年': [moment().subtract(1, "years").startOf('year'), moment().subtract(1, "years").endOf('year').format('MM-DD-YYYY') ],
                '本年': [moment().startOf('year').format('MM-DD-YYYY'), moment().endOf('year').format('MM-DD-YYYY')],
                '最近7日' : [ moment().subtract('days', 6),
                    moment() ],
                '最近30日' : [ moment().subtract('days', 29),
                    moment() ],
            },
            opens : 'right', //日期选择框的弹出位置
            buttonClasses : [ 'btn btn-default' ],
            applyClass : 'btn-small btn-primary blue',
            cancelClass : 'btn-small',
            format : 'YYYY-MM-DD', //控件中from和to 显示的日期格式
            separator : ' 至 ',
            locale : {
                applyLabel : '确定',
                cancelLabel : '取消',
                fromLabel : '起始时间',
                toLabel : '结束时间',
                customRangeLabel : '自定义',
                daysOfWeek : [ '日', '一', '二', '三', '四', '五','六' ],
                monthNames : [ '一月', '二月', '三月', '四月', '五月',
                    '六月', '七月', '八月', '九月', '十月', '十一月',
                    '十二月' ],
                firstDay : 1
            },
        },
        function(start, end, label) {//格式化日期显示框
            var start_time = start.format('YYYY-MM-DD');
            var end_time = end.format('YYYY-MM-DD');
            if(start.format('MM-DD-YYYY') == moment().subtract('days', 1).startOf('day').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract('days', 1).endOf('day').format('MM-DD-YYYY') ){
                var someday = '昨日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val(' 今天12昨日');
            }else if(start.format('MM-DD-YYYY') == moment().subtract('days', 6).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                var someday = '最近7日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('最近7日');
            }else if(start.format('MM-DD-YYYY') == moment().subtract('days', 29).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                var someday  = '最近30日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('最近30日');
            }else if(start.format('MM-DD-YYYY') == moment().isoWeekday(1).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().isoWeekday(7).format('MM-DD-YYYY') ){
                var someday = '本周';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('本周');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('week').day(-6).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().startOf('week').format('MM-DD-YYYY') ){
                var someday = '上周';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('上周');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('month').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().endOf('month').format('MM-DD-YYYY') ){
                var someday = '本月';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('本月');
            }else if(start.format('MM-DD-YYYY') == moment().subtract(1, 'month').startOf('month').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract(1, 'month').endOf('month').format('MM-DD-YYYY') ){
                var someday = '上月';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('上月');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('year').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().endOf('year').format('MM-DD-YYYY') ){
                var someday = '本年';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('本年');
            }else if(start.format('MM-DD-YYYY') == moment().subtract(1, "years").startOf('year').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract(1, "years").endOf('year').format('MM-DD-YYYY') ){
                var someday = '去年';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('去年');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('day').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                var someday = '今日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('今日');
            }else{
                var someday = '自定义'
                $("#alarm").html(someday);
                $("input[name='alarm']").val('自定义');
            }
            $(".date-search").html(start_time + ' 至 ' + end_time+' | ' + someday);
            //$('#adddate span').html(start.format('MM-DD-YYYY') + ' - '+ end.format('YYYY-MM-DD'));
            var start_time = start.format('YYYYMMDD');
            var end_time = end.format('YYYYMMDD');
            var httpurl = 'getProvinceTop?start_time='+start_time+'&end_time='+end_time;

            //get---kais
            layui.use('table', function(){
                var table = layui.table;
                var httpurl = 'getProvinceTop?start_time='+start_time+'&end_time='+end_time;
                table.render({
                    elem: '#test'
                    ,url: httpurl //'getProvinceTop'
                    ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,groups: 1 //只显示 1 个连续页码
                        ,first: true //false //不显示首页
                        ,last: true//false //不显示尾页

                    }
                    ,cols: [[
                        {field:'rank', width:220, title: '排行', sort: true}
                        ,{field:'province_name', width:280, title: '省份'}
                        ,{field:'user_num', width:280, title: '客流', sort: true}
                        ,{field:'percentage', width:280, title: '占比',sort: true}
                    ]]
                    ,done: function(res, curr, count){
                        //如果是异步请求数据方式，res即为你接口返回的信息。
                        //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                        // console.log(res);
                        //得到当前页码
                        // console.log(curr);
                        //得到数据总量
                        // console.log(count);
                    }
                    ,id: 'testReload'
                    ,page: true
                    ,height: 500
                });

                //外地城市
                var httpurl = 'getCityTop?start_time='+start_time+'&end_time='+end_time;
                table.render({
                    elem: '#city_table'
                    ,url: httpurl //'getProvinceTop'
                    ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,groups: 1 //只显示 1 个连续页码
                        ,first: true //false //不显示首页
                        ,last: true//false //不显示尾页

                    }
                    ,cols: [[
                        {field:'rank', width:220, title: '排行', sort: true}
                        ,{field:'city_name', width:280, title: '城市'}
                        ,{field:'user_num', width:280, title: '客流', sort: true}
                        ,{field:'percentage', width:280, title: '占比',sort: true}
                    ]]
                    ,done: function(res, curr, count){
                        //如果是异步请求数据方式，res即为你接口返回的信息。
                        //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                        // console.log(res);
                        //得到当前页码
                        // console.log(curr);
                        //得到数据总量
                        // console.log(count);
                    }
                    ,id: 'testReload'
                    ,page: true
                    ,height: 500
                });

                //本地 城市
                var httpurl = 'getLocalCityTop?start_time='+start_time+'&end_time='+end_time;
                table.render({
                    elem: '#local_city_table'
                    ,url: httpurl //'getProvinceTop'
                    ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,groups: 1 //只显示 1 个连续页码
                        ,first: true //false //不显示首页
                        ,last: true//false //不显示尾页

                    }
                    ,cols: [[
                        {field:'rank', width:220, title: '排行', sort: true}
                        ,{field:'city_name', width:280, title: '城市'}
                        ,{field:'user_num', width:280, title: '客流', sort: true}
                        ,{field:'percentage', width:280, title: '占比',sort: true}
                    ]]
                    ,done: function(res, curr, count){
                        //如果是异步请求数据方式，res即为你接口返回的信息。
                        //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                        // console.log(res);
                        //得到当前页码
                        // console.log(curr);
                        //得到数据总量
                        // console.log(count);
                    }
                    ,id: 'testReload'
                    ,page: true
                    ,height: 500
                });

                //省份占比
                var httpurl = 'getVsProvinceTop?start_time='+start_time+'&end_time='+end_time;
                table.render({
                    elem: '#vs_procince_top'
                    ,url: httpurl
                    ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,groups: 1 //只显示 1 个连续页码
                        ,first: true//false //不显示首页
                        ,last: true//false //不显示尾页
                    }
                    ,cols: [[
                        {field:'rank', width:180, title: '排行', sort: true}
                        ,{field:'province_name', width:220, title: '省份'}
                        ,{field:'user_num', width:220, title: '本期客流', sort: true}
                        ,{field:'history_user_num', width:220, title: '同期客流', sort: true}
                        ,{field:'increase', width:220, title: '占比',sort: true}
                    ]]
                    ,done: function(res, curr, count){
                        //如果是异步请求数据方式，res即为你接口返回的信息。
                        //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
//                console.log(res);

                        //得到当前页码
//                console.log(curr);

                        //得到数据总量
//                console.log(count);
                    }
                    ,id: 'testReload'
                    ,page: true
                    ,height: 500
                });

                //城市占比
                var httpurl = 'getVsCityTop?start_time='+start_time+'&end_time='+end_time;
                table.render({
                    elem: '#vs_city_top'
                    ,url: httpurl
                    ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,groups: 1 //只显示 1 个连续页码
                        ,first: true//false //不显示首页
                        ,last: true//false //不显示尾页
                    }
                    ,cols: [[
                        {field:'rank', width:180, title: '排行', sort: true}
                        ,{field:'city_name', width:220, title: '省份'}
                        ,{field:'user_num', width:220, title: '本期客流', sort: true}
                        ,{field:'history_user_num', width:220, title: '同期客流', sort: true}
                        ,{field:'increase', width:220, title: '占比',sort: true}
                    ]]
                    ,done: function(res, curr, count){
                        //如果是异步请求数据方式，res即为你接口返回的信息。
                        //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
//                console.log(res);

                        //得到当前页码
//                console.log(curr);

                        //得到数据总量
//                console.log(count);
                    }
                    ,id: 'testReload'
                    ,page: true
                    ,height: 500
                });
                var $ = layui.$, active = {
                    reload: function(){
                        var demoReload = $('#demoReload');
                        //执行重载
                        table.reload('testReload', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                key: {
                                    id: demoReload.val()
                                }
                            }
                        });
                    }
                };
                $('.demoTable .layui-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });

                var $ = layui.$, active = {
                    reload: function(){
                        var demoReload = $('#demoReload');

                        //执行重载
                        table.reload('testReload', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                key: {
                                    id: demoReload.val()
                                }
                            }
                        });
                    }
                };

                $('.demoTable .layui-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });
            });
            //get--jies
        });
});