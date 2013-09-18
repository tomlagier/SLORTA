<?php
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

JHTML::_('behavior.framework', true);
// disabled sins joomla 3
//JHTML::_( 'behavior.mootools' );

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

if($task == "edit" || $layout == "form" )
{
$fullWidth = 1;
}
else
{
$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add Stylesheets menu horizontal
$doc->addStyleSheet('templates/'.$this->template.'/css/menu/hor_nav.css');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/responsive_v1.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/tabs_drop.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/template_v1.css');

$doc->addStyleSheet('templates/'.$this->template.'/css/extensions.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/only_j3.css');

// Add JavaScript Tabs
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/lock.js', 'text/javascript');

// Add JavaScript slideshow
//$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery.js', 'text/javascript');
//$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery_no_conflict.js', 'text/javascript');

// Load optional rtl Bootstrap css and Bootstrap bugfixes
JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Extr. left right functions
$mod_left = $this->countModules( 'left' );
$mod_dropdown = $this->countModules( 'dropdown' );
$mod_right = $this->countModules( 'right' );

// Adjusting content width

if ($this->countModules('right') && $this->countModules('left'))
{
$span = "span6";
}
elseif ($this->countModules('right') && !$this->countModules('left'))
{
$span = "span9";
}
elseif (!$this->countModules('right') && $this->countModules('left'))
{
$span = "span9";
}
else
{
$span = "span12";
}

// Adjusting footer width
if ($this->countModules('bottom1 and bottom2 and bottom3 and bottom4'))
{
	$footerspan = "span3";
}
elseif ($this->countModules('bottom1 and bottom2 and bottom3'))
{
	$footerspan = "span4";
}
elseif ($this->countModules('bottom1 and bottom2'))
{
	$footerspan = "span6";
}
else
{
	$footerspan = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
$logo = '<img src="'. JURI::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>';
}
else
{
$logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>';
}

// ################################################################################################################
// ################################################################################################################
// ################################################################################################################

// slideshow
$show_header									= ($this->params->get("showHeader", 1)  == 0)?"false":"true";
$slideshow_use									= ($this->params->get("slideshow_use", 1)  == 0)?"false":"true";
$slideshow_height								= $this->params->get("slideshow_height");

// frontpage
$ict_show_frontpage								= $this->params->get ("xml_ict_frontpage");
$ict_frontpage									= "yes";
$ict_current_page								= "";

if (JRequest::getVar('view') == "featured") {
	$ict_current_page = "frontpage";
}
if (JRequest::getVar('view') != "featured") {
	$ict_current_page = "not_frontpage";
}
if ($ict_show_frontpage == "no" && $ict_current_page == "frontpage") {
	$ict_frontpage = "no";
}

// hor nav
$menu										    = $app->getMenu();
$renderer										= $doc->loadRenderer( 'module' );
$module											= JModuleHelper::getModule( 'mod_menu', "hornav_menu" );
$menu_name										= $this->params->get("hornav_menu", "mainmenu");
$module->params									= "menutype=$menu_name\nshowAllChildren=1\ntag_id=hor_nav";
$top_hornav											= $renderer->render( $module);
$hornav_font_color								= $this->params->get('hornav_font_color');
$hornav_dropdown_bg_color						= $this->params->get('hornav_dropdown_bg_color');
$hornav_border_color							= $this->params->get('hornav_border_color');

// module tile color
$module_title_color								= $this->params->get('module_title_color');
// module background color
$module_bg_color								= $this->params->get('module_bg_color');
// body text color
$body_textcolor									= $this->params->get('body_textcolor');
// body font style
$body_fontstyle									= $this->params->get('body_fontstyle');
$header_fontstyle								= $this->params->get('header_fontstyle');
// body font size
$body_fontsize									= $this->params->get('body_fontsize');
// body background
$body_bg_image_default							= $this->params->get('body_bg_image_default');
$body_bg_image_file					            = $this->params->get('body_bg_image_file');

// template width
$templateWidth					                = $this->params->get('templateWidth');


?>
