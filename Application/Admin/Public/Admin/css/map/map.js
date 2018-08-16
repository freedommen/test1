function init(width, height=230){
	//计算全屏幕显示地图
	var canvas = document.getElementById("map");
	//canvas.width = document.documentElement.clientWidth;
	canvas.width = width;
	canvas.height = document.documentElement.clientHeight - height;
	showLoading();
	GHConstants.IMAGE_PRE = "/Uploads/Map/";//POI图片放置的位置
	//GHConstants.FLOOR_HEIGHT = 20;
}

function showLoading(){
	var canvas = document.getElementById('map');
	var image = document.getElementById("loadingImg");
	var left = (canvas.width - image.width)/2;
	var top = (canvas.height - image.height)/2;
	image.style.left = left+"px";
	image.style.top = top+"px";
	image.style.position = "absolute";
	image.style.display = "";
	document.getElementById("maskDiv").style.display = "";
}

function hideLoading(){
	document.getElementById("maskDiv").style.display = "none";
}

function createMap(mapLoadCallBack) {
	//承载元素，初始化地图的编号，key， 回调函数，及初始化配置
	var map = new GHMap("map","110013","f3b7e9d6-0691-4ad4-921b-d9b5783ac600", mapLoadCallBack, {
	});
	return map;
}

var map;
var selectedMark = '';
var markType = 'scenic';
var addedMark = null; 

function loadMap(){
	_loadMap();

}

function mapLoadCallBack(map){
	hideLoading();
	_mapLoadCallBack(map);
}

//所有楼层信息
function getFloors() {
	var floors = map.getFloors();
	var html = "";
	for(var i = 0; i < floors.length; i++) {
		var floor = floors[i];
		html = html + floor.name + " " + floor.num + "\r\n";
	}
}
//缩小
function zoomOut() {
	map.zoomOut();
}
//放大
function zoomIn() {
	map.zoomIn();
}
//切换2D
function switch2D() {
	map.switch2D();
}
//切换3D
function switch3D() {
	map.switch3D();
}
//旋转
function rotate() {
	var r = map.getRotate();
	map.setRotate(r + 15);
}
//倾斜
function pitch() {
	var r = map.getPitch();
	map.setPitch(r - 5);
}


