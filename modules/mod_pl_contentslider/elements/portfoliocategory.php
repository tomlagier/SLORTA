<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * PortfolioCategory Form Field class for the pl_portfolio component
 */
class JFormFieldPortfolioCategory extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'PortfolioCategory';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{	
		if(is_file(JPATH_ADMINISTRATOR.'/components/com_pl_portfolio/helpers/helper.php')){
		JLoader::register('Bt_portfolioHelper', JPATH_ADMINISTRATOR.'/components/com_pl_portfolio/helpers/helper.php');
		$options = Bt_portfolioHelper::getCategoryOptions();
		$options = array_merge(parent::getOptions(), $options);
		return $options;
		}
		else{
		return array();
		}
	}
	
}
