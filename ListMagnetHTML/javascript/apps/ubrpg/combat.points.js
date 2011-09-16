

var tactics = {list:[{'name':'Directed Attack'
					,'cost':10
					,'is_melee':true,'is_defence':false,'is_missle':true,'description':'After an succesful attack, the attacker chooses hit location'}
,{'name':'Second Attack','cost':5,'is_melee':true,'is_defence':false,'is_missle':false,'description':'Allows attacker to make an addtional attack.'}
,{'name':'Counter Strike','cost':5,'is_melee':true,'is_defence':false,'is_missle':false,'description':'Allows defender to attack a split second before being attacked.'}
,{'name':'All Out Defence','cost':1,'is_melee':false,'is_defence':true,'is_missle':true,'description':'Gain +1 defence bonus per level purchased'}
,{'name':'Arc','cost':1,'is_melee':true,'is_defence':false,'is_missle':false,'description':'Strike 3 adjacent opponents with -2 attack penelty'}
,{'name':'Back Step','cost':1,'is_melee':false,'is_defence':true,'is_missle':false,'description':'+1 to dodge per level purchased'}
]};



function showTactics(){
	
	var atkGrp = '';
	var defGrp = '';
	var misGrp = '';
	$.each(tactics.list,function(i,tactic){
		atkGrp = atkGrp + addlistItem(tactic,i);
	});
	$('ul#melee-tactics').append(atkGrp);
	
};

function addlistItem(tactic,i){
	
	item= '<li role="option"  tabindex="'+i+'" class="combat-tactic" cost="'+tactic.cost+'" selected="false"><h3 class="ui-li-heading" ><a href="#" class="ui-link-inherit pick-tactic">'+tactic.name+'</a></h3><span class="" level="0">'+tactic.cost+'</span></li>';
	return item;	
};

function selectTactic($li){
	isSelected =$li.attr('selected'); 
	if(isSelected == 'true'){
		lp=parseInt($li.find('span.ui-li-count').attr('level'))+1;
		pc = parseInt($li.attr('cost'))*lp;
		$li.find('span.ui-li-count').attr('level',lp);
		$li.find('span.ui-li-count').text(pc);
	} else {
		$li.attr('selected','true');
		$li.html('<h3 class="ui-li-heading" ><a href="#" class="ui-link-inherit pick-tactic">'+$li.find('h3.ui-li-heading>a').text()+'</a><span class="ui-li-count" level="1">'+$li.attr('cost')+'</span></h3><a href="#" class="clear-tactic"></a>')
		$li.attr('class', 'combat-tactic');		
		$li.attr('data-theme','e');
	}
	
}

function refreshItems($list){
	$list.find('li[selected*="false"]').each(function(){
		$(this).attr('data-theme','c');
	});
	$list.listview("refresh");
}

function clearTactic($li){
		$li.attr('selected','false');
		$li.html('<h3 class="ui-li-heading" ><a href="#" class="ui-link-inherit pick-tactic">'+$li.find('h3.ui-li-heading>a').text()+'</a><span class="" level="1">'+$li.attr('cost')+'</span></h3>')
		$li.removeAttr('data-theme');
		$li.attr('class', 'combat-tactic');
		$('ul').listview("refresh");
}

$(document).ready(function() {
	
showTactics();
 
 
 
});
$(document).bind("mobileinit", function(){
  		$.mobile.ajaxFormsEnabled = false ;
  		$('a.pick-tactic').live('click',function(e){
		 	e.preventDefault();
		 	e.stopPropagation();
		 	$link= $(e.target);
		 	$listItem = $link.parents('li:first');
		 	selectTactic($listItem);
		 	$('ul#melee-tactics').listview("refresh");
		 });
		 
		 $('a.clear-tactic').live('click',function(e){
		 	e.preventDefault();
		 	e.stopPropagation();
		 	$link= $(e.target);
		 	$listItem = $link.parents('li:first');
		 	clearTactic($listItem);
		 	$('ul#melee-tactics').listview("refresh");
		 });
		 
	});