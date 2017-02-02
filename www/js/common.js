//выбранный соловарь
var choose_dictionary;
//выбранная тематика
var choose_view;
//данные по всем словарям
var all_dictionary;
//список выбранных ресурсов
var myresourse = [];
// все данные по ресурсам
var allresource;
// my time range
var timerange = 1;
//получение всех данных лоя графиков по всем временным промежуткам и словарям
var alldate = [];

function clone(one, two){	
	// скопируем в него все свойства user
	for (var key in two) {
		one[key] = two[key];
	}
}
function OnSize(){
	width = $(document).width();
	if (width>769){			
		$('.msrItems').msrItems({
		  	'colums': 3, //columns number
		  	'margin': 15 //right and bottom margin
		  });
	} else
	if (width<481){
		$('.msrItems').msrItems({
		  	'colums': 1, //columns number
		  	'margin': 15 //right and bottom margin
		  });
	} else
	if(width<769){
		$('.msrItems').msrItems({
	  		'colums': 2, //columns number
	  		'margin': 15 //right and bottom margin
	  	});
	}
}
$(document).ready(function(){		
	$( window ).on('resize', function(e) {		
		time = setTimeout(function(){
			$('.msrItems').msrItems('refresh');
		}, 300);
		OnSize();
	})

});

$(function() {	
	//подготовки и получение куков
	startCoockie();
	//начальное заполнение всех полей сайта
	start();
});

function startCoockie(){
	var a = ['KMT','KP','TVR'];	
	var b = a.toString();		
	//deleteCookie('choose_dictionary');
	//deleteCookie('Listsite');
	//deleteCookie('choose_view');
	if (!getCookie('Listsite')) setCookie('Listsite', b, 10);
	if (!getCookie('choose_dictionary') || !getCookie('choose_view')) {
		setCookie('choose_dictionary', '1', 10);
		setCookie('choose_view', 'Спорт', 10);
	}
	choose_dictionary = parseInt(getCookie('choose_dictionary'));
	choose_view = getCookie('choose_view');
	myresourse = getCookie('Listsite').split(',');
}
function Coockie(){
	
}

function start(){		
	getDataResource();
	getDataDictionary();
	getAllData(1);
}

//получение данных о новостных ресурсах и заполнение
function getDataResource(){
	var f = '0';
	$.ajax({ 
		type: 'POST',		
		url:'views/pull-resource-data.php',		
		success: function(data){						
			allresource = JSON.parse(data);			
			fillUsesResource(allresource);
			fillResource(allresource);
			fillResourceAdmin(allresource);
			fillTableRes(allresource);
		}		
	});
}
function getDataDictionary(){
	var f = '0';
	$.ajax({ 
		type: 'POST',		
		url:'views/pull-dictionary-data.php',		
		success: function(data){						
			all_dictionary = JSON.parse(data);
			fillTableVal(all_dictionary);
			fillDescription(all_dictionary);
			fillDictionaryMenu(all_dictionary);
		
			//заполняем все графики + данные из словаря
			getMainGraph();
		}		
	});
}

function fillTableRes(inputdata){
	$.ajax({ 
		type:'POST', 		
		url:'views/fill-table-res.php',
		data:{
			'allresource': inputdata,
			'myres': myresourse.toString()
		},
		success: function(data) {
			$('#table-res').html(data);
		}
	});
}
function fillTableVal(inputdata){
	$.ajax({ 
		type:'POST', 		
		url:'views/fill-table-val.php',
		data:{
			'border':	inputdata[choose_view][choose_dictionary]['border']
		},
		success: function(data) {
			$('#table-val').html(data);
		}
	});
}
function fillDescription(inputdata){
	$.ajax({ 
		type:'POST', 		
		url:'views/fill-subject-description.php',
		data:{
			'description':	inputdata[choose_view][choose_dictionary]
		},
		success: function(data) {
			$('#subject-description').html(data);
		}
	});
}
function SelectBorderDictionary(inputdata){
	var border = inputdata[choose_view][choose_dictionary]['border'].split(',');
	var selectborder = [];
	for(var key in border){						
		selectborder.push(parseFloat(border[key]));
	}
	return selectborder;
}
function fillDictionaryMenu(inputdata){
	$.ajax({ 
		type:'POST', 		
		url:'views/fill-select-subjects.php',
		data:{
			'dictionary': inputdata,
		},
		success: function(data) {
			$('#select-subjects').html(data);
			OnSize();
			SetMarkDictionary();
		}
	});
}
function fillUsesResource(inputdata){
	$.ajax({ 
		type:'POST', 		
		url:'views/used-resource.php',
		data:{
			'allresource': inputdata,
			'myres': myresourse.toString()
		},
		success: function(data) {
			$('#used-resource').html(data);			
		}
	});
}
function SetMarkUsed(){
	$('#list-source-all div').each(
		function() {
			if(myresourse.indexOf($(this).attr('id'))!=-1){	
				$(this).addClass( "choose-site-click");				
			} 
		});
}
function fillResource(inputdata){
	$.ajax({ 
		type:'POST', 
		url:'views/available-resource.php',
		data:{
			'allresource': inputdata
		}, 			
		beforeSend: function() {
			$('#list-source-all').html('check');
		},
		complete: function() {},
		success: function(data) {
			$('#list-source-all').html(data);
			SetMarkUsed();
		}
	});
}
function fillResourceAdmin(inputdata){
	$.ajax({ 
		type:'POST', 
		url:'views/admin-resource.php',
		data:{
			'allresource': inputdata
		}, 			
		beforeSend: function() {
			$('#list-resource').html('');
		},
		complete: function() {},
		success: function(data) {
			$('#list-resource').html(data);
		}
	});
}

//функции по работе с графиками
function refillfraph(data){
	var needdata = {};
	clone(needdata, selectresource(data));
	if(needdata){
		Re(FormatDataToGraph(needdata),
			FormatDataToCircle(needdata),
			FormatDataToStat(needdata));
	}
	else{
		console.log('ничего нет');
	}
}
function selectresource(newdata){
	var dd = {};
	clone(dd, newdata);
	for(var key in newdata){						
		if(myresourse.indexOf(key)==-1){
			delete dd[key];
		} 
	}	
	return dd;
}
function getMainGraph(){
	var datecode = 2;
	$.ajax({ 
		type: 'POST',		
		url:'views/pull-graph-data.php',	
		data:{
			'datecode': datecode
		}, 	
		beforeSend: function() {
			$('#ided').html('check');
		},
		complete: function() {},
		success: function(data){						
			//заполнение графиков выбранными данными	
			var predata = JSON.parse(data)[choose_dictionary];
			if(predata!=null){
				refillfraph(predata)				
			} else {
				console.log('ничего нет');
			}
		}		
	});
}
function FormatDataToGraph(arg){		
	var returnresult = [];
	for(var key in arg){		
		var toarr = new Object();		
		var helpdata = [];
		toarr.name = key;		
		for (var dat in arg[key]){
			var p = arg[key][dat];			
			var t = [Date.UTC(p.year, p.month - 1, p.day), p.rating];
			helpdata.push(t);
		}

		toarr.data = MinimazeDataGraph(helpdata);
		returnresult.push(toarr);				
	}
	return returnresult;
}
function MinimazeDataGraph(data){
	return data;
}
//формат данных для всех 3-х графиков
function FormatDataToCircle(arg){
	var returnresult = [];
	for(var key in arg){
		var tocircle = new Object();		
		var datay = 0;		
		tocircle.name = key;		
		for (var dat in arg[key]){
			var p = arg[key][dat];
			datay = datay + p.rating;
		}
		datay = datay - 1;
		tocircle.y = datay;
		returnresult.push(tocircle);				
	}	
	var size = returnresult.length-1;
	var newlastobject = returnresult[size];
	newlastobject.sliced = true;
	newlastobject.selected = true;
	returnresult.splice(size, 1 , newlastobject);
	return returnresult;	
}
function FormatDataToStat(arg){
	var returnresult = [];
	for(var key in arg){	
		var tostat = new Object();
		var helpdata = [];		
		tostat.name = key;
		for (var dat in arg[key]){		
			var p = arg[key][dat];	
			helpdata.push(p.rating);			
		}
		tostat.data = FromatStat(helpdata);
		returnresult.push(tostat);				
	}		
	return returnresult;	
}
function FromatStat(data){
	var border = [];
	border = SelectBorderDictionary(all_dictionary);
	var def = [0,0,0,0,0];
	for (key in data){
		var per = data[key];
		if (per <= border[0]){
			var newres = def[0] + per;
			def[0]= newres;
		} else if(per > border[0]  && per <= border[1]){
			var newres = def[1] + per;
			def[1]= newres;
		} else if(per > border[1]  && per <= border[2]){
			var newres = def[2] + per;
			def[2]= newres;
		} else if(per > border[2]  && per <= border[3]){
			var newres = def[3] + per;
			def[3]= newres;
		} else if(per > border[3]){
			var newres = def[4] + per;
			def[4]= newres;
		} 
	}	
	return def;
}

function getAllData(i){	
	if (i > 6) return true;
	else {		
		var datecode = i;
		$.ajax({ 
			type: 'POST',		
			url:'views/pull-graph-data.php',	
			data:{
				'datecode': datecode
			}, 			
			success: function(data){			
				var arg = JSON.parse(data);				
				alldate.push(arg);
				getAllData(i + 1);
			}		
		});		
	}	
}




//основные клики на кнопки
$(function(){	
	//вход на сайт с старница приветствия
	function GetStarted(){
		$("body").css({			
			'background-image':'url("../img/w.jpg")'	
		})
		$(".my-flex").css({
			'display':'none'		
		})
		$(".main").css({
			'display':'block'		
		})
	}
	//клик по кнопке перейти на сайт
	$('.get-started-button').click(function(){
		GetStarted();
	}); 

	//переключение по панели редактирования списка ресурсов
	//var e = new Boolean(true);
	$('#used-resource').on('click', '#edit',function(){		
		$(".source-all").css({			
			'height':'auto'	
		})			
		HideSite();		
	});

	$('#used-resource').on('click', '#apply-used-resource',function(){
		$(".source-all").css({			
			'height':'0px'	
		})
		VisibleSite();
	});
	function HideSite(){
		//скрытие всех текущих выбранных ресурсов
		//отображение кнопки выбора
		$('#used-resource').html('');
		$.get('views/available-resource-apply.php', function(result) {
			$('#used-resource').append(result);
		});		
	}
	function VisibleSite(){
		if( myresourse.length < 1) {
			myresourse = ['KMT','KP','TVR'];
		}
		SetMarkUsed();		
		setCookie('Listsite', myresourse.toString(), 10);
		fillUsesResource(allresource);		
		fillTableRes(allresource);
		refillfraph(alldate[timerange][choose_dictionary]);
	}

	$('#admin-btn').click(function(){		
		$(".admin-panel").css({			
			'display':'block'	
		})	
	});
	$('#close-admin-panel').click(function(){		
		$(".admin-panel").css({			
			'display':'none'	
		})	
	});

});

var check_e = new Boolean(true);
//var mass = [];
//выбор ресурсов из списка
$('#list-source-all').on('click', '.choose-site',function(){
	if (check_e){
		toggleArrayItem(myresourse, $(this).attr('id'));
		$(this).toggleClass( "choose-site-click");
		check_e = !check_e;
	}
	else {
		toggleArrayItem(myresourse, $(this).attr('id'));
		$(this).toggleClass("choose-site-click");
		check_e = !check_e;
	}
});
function toggleArrayItem(a, v) {
	var i = a.indexOf(v);
	if (i === -1)
		a.push(v);
	else
		a.splice(i,1);
}

//выбор словаря из списка
$('#select-subjects').on('click', '.msrItem .d',function(){
	$('body,html').animate({scrollTop:0},800);
	choose_dictionary = $(this).attr('id');
	choose_view = $(this).parent('.msrItem').children('.head-sub').attr('id');
	setCookie('choose_dictionary', $(this).attr('id'), 10);
	setCookie('choose_view', choose_view, 10);
	//перезаполнение графиков и описнаия темаы словаря
	fillTableVal(all_dictionary);
	fillDescription(all_dictionary);
	refillfraph(alldate[timerange][choose_dictionary]);
	//выделение выбранного словаря	
	SetMarkDictionary();
	
});

function SetMarkDictionary(){	
	$('#select-subjects .msrItem .d').each(
		function() {			
			if($(this).attr('id') != choose_dictionary){	
				$(this).addClass("l-sub");
				$(this).removeClass("s-l-sub");					
			} else {
				$(this).removeClass("l-sub");
				$(this).addClass("s-l-sub");				
			}
		});	
}


$('#testclick').click(function(){		
	$.ajax({ 
		type:'POST', 		
		url:'views/test.php',
		data:{
			'dictionary': '12',
		},
		beforeSend: function() {
			$('#testfield').html('started');
		},		
		
		success: function(data) {
			console.log(JSON.parse(data));
			//JSON.parse(data)			
		}
	});
});
