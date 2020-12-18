$(function(){
	//位置三级联动
	var city = document.getElementById('city');
	var prov_citi = document.getElementById('prov_citi');
	var citi_name = document.getElementById('citi_name');
	var changeNum;
	var arr = [
		{
			name:'河北',
			citylist:[
				{
					name:'直辖市',
					arealist:['石家庄','保定市','涿州市','廊坊市']
				},
				{
					name:'县',
					arealist:['涞水县','雄安县']
				}
			]
		},{
			name:'北京',
			citylist:[
				{
					name:'直辖市',
					arealist:['丰台区','海淀区','朝阳区','石景山区','通州区','大兴区']
				},
				{
					name:'县',
					arealist:['通县','延庆县']
				}
			]
		},{
			name:'天津',
			citylist:[
				{
					name:'直辖市',
					arealist:['和平区','河东区','河西区','南开区','河北区']
				},
				{
					name:'县',
					arealist:['蓟县','宁海县']
				}
			]
		}
	]

	//设置市
	function setCity(setName,obj,isName){
		for(var i=0;i<obj.length;i++){
			var _option = document.createElement('option');
			if(!isName){
				_option.value = obj[i].name;
				_option.innerHTML = obj[i].name;
			}else{
				_option.value = obj[i];
				_option.innerHTML = obj[i];
			}
			setName.appendChild(_option);
		}	
	}
	setCity(city,arr);
	//获取市的index值，去改变区县
	function findCity(obj,findEle){
		for(var i=0;i<obj.length;i++){
			obj[i].index = i;
			if(obj[i].name.indexOf(findEle) != -1){
				return obj[i].index;
			}
		}
		return false;
	}
	//设置区县
	function setprov_citi(num){
		prov_citi.innerHTML = '<option>请选择市</option>';
		citi_name.innerHTML = '<option>请选择区</option>';
		setCity(prov_citi,arr[num].citylist);
	}
	city.onchange = function(){
		changeNum = findCity(arr,this.value);
		setprov_citi(changeNum);
	}
	function setciti_name(num){
		citi_name.innerHTML = '<option>请选择区</option>';
		setCity(citi_name,arr[changeNum].citylist[num].arealist,true);
	}
	prov_citi.onchange = function(){
		setciti_name(findCity(arr[changeNum].citylist,this.value));
	}
})