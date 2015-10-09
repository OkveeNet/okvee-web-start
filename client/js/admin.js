/* 
 * @author mr.v
 * @copyright http://okvee.net
 */

function checkAll(pForm, boxName, parent) {
	for (i = 0; i < pForm.elements.length; i++)
		if (pForm.elements[i].name == boxName)
			pForm.elements[i].checked = parent;
}

// jquery document.ready
$(document).ready(function() {
	$("ul.sf-menu").supersubs({
		minWidth:    12,   // minimum width of sub-menus in em units
		maxWidth:    27,   // maximum width of sub-menus in em units
		extraWidth:  1     // extra width can ensure lines don't sometimes turn over
	}).superfish({
		delay:         300
	});
});// jquery document.ready