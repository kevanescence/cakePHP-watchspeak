/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){        
   $('ul.pagination li.active,ul.pagination li.next, ul.pagination li.prev ')
           .wrapInner('<a></a>').find('a')
           .append('<span class="sr-only">(current)</span>');
});