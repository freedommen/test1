
//客流实时监控

function baiduApi() {


    //客流实时监控

    var kljkChart = echarts.init(document.getElementById('kljk') , 'westeros');

    // 百度地图API功能
    var map = new BMap.Map("kljk",{minZoom:12,maxZoom:16});  // 创建Map实例
    map.centerAndZoom(new BMap.Point(107.936832,34.396305),13);
//        map.centerAndZoom(new BMap.Point(107.899017,34.337006),11);
    map.enableScrollWheelZoom(true);
    // map.disableDragging();     //禁止拖拽
    var b = new BMap.Bounds(new BMap.Point(107.710982,33.991224),new BMap.Point(108.070304,34.633836));
    // var b = new BMap.Bounds(new BMap.Point(107.751226,34.149235),new BMap.Point(108.077778,34.622311));
    try {
        BMapLib.AreaRestriction.setBounds(map, b);
    } catch (e) {
        alert(e);
    }

    // var bs = map.getBounds();   //获取可视区域
    // var bssw = bs.getSouthWest();   //可视区域左下角
    // var bsne = bs.getNorthEast();   //可视区域右上角

    // 创建地图实例
    map.setMapStyle({style:'midnight'});

    map.centerAndZoom("扶风县",13);      // 初始化地图,用城市名设置地图中心点
    var point = new BMap.Point(107.899017, 34.337006);

    // map.centerAndZoom(point, 11);             // 初始化地图，设置中心点坐标和地图级别

    // var bs = map.getBounds();   //获取可视区域


    map.enableScrollWheelZoom(); // 允许滚轮缩放


    //行政划分
    /*function getBoundary(){
        var bdary = new BMap.Boundary();
        bdary.get("陕西省宝鸡市扶风县", function(rs){       //获取行政区域
            map.clearOverlays();        //清除地图覆盖物
            var count = rs.boundaries.length; //行政区域的点有多少个
            if (count === 0) {
                alert('未能获取当前输入行政区域');
                return ;
            }
            var pointArray = [];
            for (var i = 0; i < count; i++) {
                var ply = new BMap.Polygon(rs.boundaries[i], {strokeWeight: 2, strokeColor: "#00d2ff"}); //建立多边形覆盖物
                map.addOverlay(ply);  //添加覆盖物
                pointArray = pointArray.concat(ply.getPath());
            }
            map.setViewport(pointArray);    //调整视野
            addlabel();
        });
    }

    setTimeout(function(){
        getBoundary();
    }, 0);*/

    //
    var points = [];
    $.get('getDataReal',function (res) {

         points = res.data.position;


    // var points =[
    //     {"lng":107.909292,"lat":34.441056,"count":338},
    //     {"lng":107.906237,"lat":34.445909,"count":421},
    //     {"lng":107.909974,"lat":34.445968,"count":596},
    //     {"lng":107.910693,"lat":34.444718,"count":412},
    //     {"lng":107.908142,"lat":34.442247,"count":338},
    //     {"lng":107.907172,"lat":34.443944,"count":638},
    //     {"lng":107.908537,"lat":34.438823,"count":438},
    //     {"lng":107.910334,"lat":34.432392,"count":177},
    //     {"lng":107.909687,"lat":34.442634,"count":138},
    //     {"lng":107.908932,"lat":34.436442,"count":442},
    //     {"lng":107.909292,"lat":34.434357,"count":523},
    //     {"lng":107.909974,"lat":34.432243,"count":700},
    //     {"lng":107.91134,"lat":34.431797,"count":140},
    //     {"lng":107.908465,"lat":34.43138,"count":490},
    //     //关中风情园
    //     {"lng":107.911807,"lat":34.38477,"count":340},
    //     {"lng":107.912813,"lat":34.385157,"count":300},
    //     {"lng":107.913675,"lat":34.384919,"count":230},
    //     {"lng":107.913783,"lat":34.384412,"count":430},
    //     {"lng":107.912633,"lat":34.385396,"count":300},
    //     {"lng":107.913136,"lat":34.384532,"count":200},
    //     //西府古镇
    //     {"lng":107.910244,"lat":34.385433,"count":300},
    //     {"lng":107.910172,"lat":34.386029,"count":200},
    //     {"lng":107.910639,"lat":34.386386,"count":300},
    //     //行政中心广场
    //     {"lng":107.905968,"lat":34.383854,"count":200},
    //     {"lng":107.905968,"lat":34.383735,"count":390},
    //     {"lng":107.905177,"lat":34.383407,"count":470},
    //     //汽车站
    //     {"lng":107.895871,"lat":34.378402,"count":460},
    //     {"lng":107.895727,"lat":34.378044,"count":460},
    //     {"lng":107.894506,"lat":34.378759,"count":468},
    //
    //     //七星
    //     {"lng":107.886529,"lat":34.37146,"count":130},
    //     {"lng":107.886529,"lat":34.370745,"count":340},
    //     {"lng":107.888541,"lat":34.373247,"count":333},
    //     {"lng":107.887822,"lat":34.371877,"count":231},
    //     {"lng":107.884444,"lat":34.372651,"count":410},
    //     {"lng":107.885529,"lat":34.37346,"count":230},
    //     {"lng":107.886529,"lat":34.37146,"count":100},
    //     {"lng":107.884013,"lat":34.373128,"count":312},
    //     {"lng":107.882073,"lat":34.37289,"count":270},
    //     {"lng":107.886241,"lat":34.371281,"count":474},
    //
    // ];

    if(!isSupportCanvas()){
        alert('热力图目前只支持有canvas支持的浏览器,您所使用的浏览器不能使用热力图功能~')
    }
    //详细的参数,可以查看heatmap.js的文档 https://github.com/pa7/heatmap.js/blob/master/README.md
    //参数说明如下:
    /* visible 热力图是否显示,默认为true
     * opacity 热力的透明度,1-100
     * radius 势力图的每个点的半径大小
     * gradient  {JSON} 热力图的渐变区间 . gradient如下所示
     *	{
            .2:'rgb(0, 255, 255)',
            .5:'rgb(0, 110, 255)',
            .8:'rgb(100, 0, 255)'
        }
        其中 key 表示插值的位置, 0~1.
            value 为颜色值.
     */
    heatmapOverlay = new BMapLib.HeatmapOverlay({"radius":30});
    map.addOverlay(heatmapOverlay);
    heatmapOverlay.setDataSet({data:points,max:1000});
    });

    function setGradient(){
        /*格式如下所示:
       {
             0:'rgb(102, 255, 0)',
             .5:'rgb(255, 170, 0)',
             1:'rgb(255, 0, 0)'
       }*/
        var gradient = {};
        var colors = document.querySelectorAll("input[type='color']");
        colors = [].slice.call(colors,0);
        colors.forEach(function(ele){
            gradient[ele.getAttribute("data-key")] = ele.value;
        });
        heatmapOverlay.setOptions({"gradient":gradient});
    }
    //判断浏览区是否支持canvas
    function isSupportCanvas(){
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    }


    /* if (!app.inNode) {
         // 添加百度地图插件
         var bmap = myChart.getModel().getComponent('bmap').getBMap();
         bmap.addControl(new BMap.MapTypeControl());
     }
 */


//        kljkChart.setOption(option);

}
