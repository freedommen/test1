
//日历js
$(document).ready(function() {

    // $("#enddate").datetimepicker({
    //     language : 'zh-CN',
    //     format : "yyyy-mm-dd",
    //     sideBySide: true,
    //     // autoclose : true,
    //     // todayBtn : true,
    //     // pickerPosition : "bottom-left",
    //     minView : 2			//最精准的时间选择为日期0-分 1-时 2-日 3-月
    // });
    //
    // $("#enddate").datetimepicker({
    //     language : 'zh-CN',
    //     format : "yyyy-mm-dd",
    //     autoclose : true,
    //     todayBtn : true,
    //     pickerPosition : "bottom-left",
    //     minView : 2
    // });

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
            //----图形开始 tuxing-------
            var start_time = start.format('YYYYMMDD');
            var end_time = end.format('YYYYMMDD');
            console.log(end_time);
            $(function(){
//游客分析－客源地分析
                //外省与本省客源统计分析
                var touristProvinceAnalysisChart = echarts.init(document.getElementById('touristProvinceAnalysis'),'walden');
                var provinceVs_url = "getProvinceVs";//"{:U('getProvinceVs',array('t'=>time()))}";//'getProvinceVs'
                $.get(provinceVs_url,{start_time:start_time,end_time:end_time},function (result) {
                    var province_vs = result;
//               var province_vs = $.parseJSON(result);
                    option = {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a}{b} <br/>客流数： {c} <br/>占比： {d}%"
                        },
                        legend: {
                            orient: 'vertical',
                            x: 'right',
                            y: 'bottom',
                            data:['外省','本省']
                        },
                        series: [
                            {
                                type:'pie',
                                radius: ['50%', '70%'],
                                center: ['40%', '50%'],
                                avoidLabelOverlap: true,
                                label: {
                                    emphasis: {
                                        show: true,
                                        textStyle: {
                                            fontSize: '30',
                                            fontWeight: 'bold'
                                        }
                                    }
                                },
                                labelLine: {
                                    normal: {
                                        show: true
                                    }
                                },
                                data:[
                                    {value:province_vs.province_num, name:'外省'},
                                    {value:province_vs.local_province_num, name:'本省'}
                                ]
                            }
                        ]
                    };
                    touristProvinceAnalysisChart.setOption(option);
                });
                //外省客源地统计TOP10（省份）
                var touristProvinceChart = echarts.init(document.getElementById('touristProvince'));
                // var getProvinceTop10_url = "{:U('getProvinceTop10',array('t'=>time()))}";//'getProvinceVs'
                $.get('getProvinceTop10',{start_time:start_time,end_time:end_time},function (result) {
                    var province_data = result;
//                alert(result.user_num);
//                var province_data = $.parseJSON(result);
                    // 指定图表的配置项和数据
                    option = {
                        color: ['#3398DB'],
                        legend: {
                            x: 'right',
                            y: 'top',
                            data:['客流量']
                        },
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis : [
                            {
                                type : 'category',
                                // data : [start_time, end_time],
                                data : province_data.province_name,
                                axisTick: {
                                    alignWithLabel: true
                                },
                                axisLabel: {rotate: 50, interval: 0}
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'客流量',
                                type:'bar',
                                barWidth: '40%',
                                data: province_data.user_num, //[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                            },
                            {
                                name:'占比',
                                type:'bar',
                                barWidth: '0.01%',
                                data: province_data.user_percentage,
                            }
                        ]
                    };
                    touristProvinceChart.setOption(option);
                });

                //外省客源地统计TOP10（城市）
                var touristProvinceCityChart = echarts.init(document.getElementById('touristProvinceCity'));
                // var getCityTop10_url = "{:U('getCityTop10',array('t'=>time()))}";
                $.get('getCityTop10',{start_time:start_time,end_time:end_time},function (result) {
                    var city_data = result;
                    // 指定图表的配置项和数据
                    option = {
                        color: ['#3398DB'],
                        legend: {
                            x: 'right',
                            y: 'top',
                            data:['客流量']
                        },
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis : [
                            {
                                type : 'category',
                                data : city_data.city_name,//['城市一', '城市二', '城市三', '城市四', '城市五', '城市六', '城市七', '城市八', '城市九', '城市十'],
                                axisTick: {
                                    alignWithLabel: true
                                },
                                axisLabel: {rotate: 50, interval: 0}
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'客流量',
                                type:'bar',
                                barWidth: '40%',
                                data: city_data.user_num //[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                            }
                        ]
                    };
                    touristProvinceCityChart.setOption(option);
                });
                //本省客源地统计TOP10（城市）
                var touristThisProvinceCityChart = echarts.init(document.getElementById('touristThisProvinceCity'));
                // var getLocalCityTop10 = "{:U('getLocalCityTop10',array('t'=>time()))}";
                $.get('getLocalCityTop10',{start_time:start_time,end_time:end_time},function (res) {
                    var local_city_data = res;
                    // 指定图表的配置项和数据
                    option = {
                        color: ['#3398DB'],
                        legend: {
                            x: 'right',
                            y: 'top',
                            data:['客流量']
                        },
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        grid: {
                            left: '3',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis : [
                            {
                                type : 'category',
                                data : local_city_data.city_name,
                                axisTick: {
                                    alignWithLabel: true
                                },
                                axisLabel: {rotate: 50, interval: 0}
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'客流量',
                                type:'bar',
                                barWidth: '40%',
                                data: local_city_data.user_num//[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                            }
                        ]
                    };
                    touristThisProvinceCityChart.setOption(option);
                });
                //游客来源同比升幅TOP5（省份）
                var provinceComparChart = echarts.init(document.getElementById('provinceCompar') , 'walden');
                // var getProvinceTop5 = "{:U('getProvinceTop5',array('t'=>time()))}";
                $.get('getProvinceTop5',{start_time:start_time,end_time:end_time},function (res) {

                    option = {
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            x: 'right',
                            y: 'top',
                            data: ['本期', '同期']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        yAxis: {
                            type: 'value',
                            name: '万人次',
                            boundaryGap: [0, 0.01]
                        },
                        xAxis: {
                            type: 'category',
                            splitLine: {           // 分隔线
                                show: false
                            },
                            data: res.province_name //['广东省','广东省','广东省','广东省','广东省']
                        },
                        series: [
                            {
                                name: '本期',
                                type: 'bar',
                                barWidth: '12%',
                                data: res.user_num//[823, 489, 1034, 970, 744]
                            },
                            {
                                name: '同期',
                                type: 'bar',
                                barWidth: '12%',
                                label: {
                                    normal: {
                                        show: true,
                                        position: 'top'
                                    }
                                },
                                data: res.history_user_num//[203, 489, 934, 970, 744]
                            }
                        ]
                    };
                    provinceComparChart.setOption(option);
                });
                //游客来源同比升幅TOP5（城市）
                var cityComparChart = echarts.init(document.getElementById('cityCompar') , 'walden');
                // var getCityTop5 = "{:U('getCityTop5',array('t'=>time()))}";
                $.get('getCityTop5',{start_time:start_time,end_time:end_time},function (res) {

                    option = {
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            x: 'right',
                            y: 'top',
                            data: ['本期', '同期']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        yAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01],
                            name: '万人次'
                        },
                        xAxis: {
                            type: 'category',
                            splitLine: {           // 分隔线
                                show: false
                            },
                            data:res.city_name, //['广东省','广东省','广东省','广东省','广东省']
                        },
                        series: [
                            {
                                name: '本期',
                                type: 'bar',
                                barWidth: '12%',
                                data: res.user_num,
                            },
                            {
                                name: '同期',
                                type: 'bar',
                                barWidth: '12%',
                                label: {
                                    normal: {
                                        show: true,
                                        position: 'top'
                                    }
                                },
                                data: res.history_user_num,
                            }
                        ]
                    };
                    cityComparChart.setOption(option);
                });
            });
            //=======jies======
        });
    });
