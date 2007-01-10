<?php
/**
 * Shows the pages and subcategories belonging to a category.
 * 
 * See WikiCategory to understand how the system works.
 * 
 * @package		Actions
 * @version 	$Id$
 * 
 * @input	string $page optional: the category for which you want to display the pages and categories. Default: current page
 * @input	integer $compact optional: produces a columnar layout with a layout table; 1 produces output in the form of an unordered list. Default: 0
 * @input	integer $col optional: number of columns (for compact=0). Default: 1
 * @output	A html table with pages
 * @uses	Wakka::GetPageTag();
 * @uses	Wakka::ListPages()
 * @uses	Wakka::LoadPagesLinkingTo()
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @filesource
 */
 
if ($cattag = $_REQUEST["wakka"])
{
	$str ="";
	if (!isset($col)) $col=1;
	if (!isset($compact)) $compact=0;
	if (!isset($page)) $page=$this->GetPageTag(); 
	if (isset($this->_included_page)) $page = $this->_included_page;
	if (!isset($class)) $class = '';
	if ($page=="/") $page="CategoryCategory"; 

	if (!$page) {$page=$cattag;}

	$results = $this->LoadPagesLinkingTo($page);

	$errmsg = '<em class="error">'.sprintf(ERR_NO_PAGES, $page).'</em>';
	$str = $this->ListPages($results, $errmsg, $class, $col, $compact);
	if ($str != $errmsg)
	{
		printf(PAGES_BELONGING_TO.'<br /><br />', count($results), $page);
	}
	print($str);
}
?>
