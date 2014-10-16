//Remove the scores put by cakePHP on dates
var tmp = $("#birthdayDiv").children().clone();
$("#birthdayDiv").html(tmp);

//Initialize tabs 
$('.nav.nav-tabs').click(function(e) {
    e.preventDefault();  
    $(this).tab('show');    
});

$('ul.pagination li').find('a').each(function(){   
   var a = $(this);
   var url = $(this).attr('href');   
   console.log("Je suis dans le lien" + url);
   
   var tab = a.parentsUntil('#infos, #publications, #friends')
              .parent().attr('id');
   console.log(tab);
   url = url.replace(/\/?(infos|publications|friends)?\/?page/g,'/' + tab + '/page');
   console.log(url);
   a.attr("href",url);
});
////Change url when tab is changed (without reloading page)
$('.nav.nav-tabs a').click(function(e) {    
    var url = window.location.href + "";
    var tab = $(this).attr("href");
    tab = tab.substring(1, tab.length);
    url = url.replace(/infos|publications|friends/g,tab);    
    history.pushState({ path: this.path }, '', url);
});

//Allow to have the same bootstrap style for the current page
function updatePagination(selector){
var selPagination = selector + ' ul.pagination';
$(selPagination + ' li.active,' + selPagination + ' li.next,' + selPagination + ' li.prev ')
        .wrapInner('<a></a>').find('a')
        .append('<span class="sr-only">(current)</span>');
}
updatePagination("#content");
updatePagination("#publications-content");