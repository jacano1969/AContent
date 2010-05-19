<?php
/************************************************************************/
/* Transformable                                                        */
/************************************************************************/
/* Copyright (c) 2009                                                   */
/* Adaptive Technology Resource Centre / University of Toronto          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/

if (!defined('TR_INCLUDE_PATH')) { exit; }
/* available header.tmpl.php variables:
 * $this->lang_code			the ISO language code
 * SITE_NAME				the site name from the config file
 * $this->page_title		the name of this page to use in the <title>
 * top_level_pages           array(array('url', 'title'))     the top level pages. Transformable default creates tabs.
 * current_top_level_page    string                           full url to the current top level page in "top_leve_pages"
 * path                      array(array('url', 'title'))     the breadcrumb path to the current page.
 * sub_menus                 array(array('url', 'title'))     the sub level menus.
 * current_page              string                           full url to the current sub level page in the "sub_level_pages"
 * section_title             string                           the name of the current section. either name of the course, administration, my start page, etc.
 * page_title                string                           the title of the current page.
 * user_name                 string                           name of login user
 * $this->lang_charset		the ISO language character set
 * $this->base_path			the absolute path to this Transformable installation
 * $this->theme				the directory name of the current theme
 * $this->custom_head		the custom head script used in <head> section
 * $this->$onload			the html body onload event
 * $this->shortcuts		array of editor tools available title:url:icon
 * $this->content_base_href	the <base href> to use for this page
 * $this->rtl_css			if set, the path to the RTL style sheet
 * $this->icon			the path to a course icon
 * $this->banner_style		-deprecated-
 * $this->base_href			the full url to this Transformable installation
 * $this->onload			javascript onload() calls
 * $this->img				the absolute path to this theme's images/ directory
 * $this->sequence_links	associative array of 'previous', 'next', and/or 'resume' links
 * $this->path				associative array of path to this page: aka bread crumbs
 * $this->rel_url			the relative url from the installation root to this page
 * $this->nav_courses		associative array of this user's enrolled courses
 * $this->section_title		the title of this section (course, public, admin, my start page)
 * $this->top_level_pages	associative array of the top level navigation
 * $this->current_top_level_page	the full path to the current top level page with file name
 * $this->sub_level_pages			associate array of sub level navigation
 * $this->back_to_page				if set, the path and file name to the part of this page (if parent is not a top level nav)
 * $this->current_sub_level_page	the full path to the current sub level page with file name
 * $this->guide				the full path and file name to the guide page
 * $this->user_name			string, the name of the current login user
 * $this->isAuthor			boolean, whether the current login user is the author of the selected course. Only passed in when there is login user and selected course
 * ======================================
 * back_to_page              array('url', 'title')            the link back to the part of the current page, if needed.
 */

include_once(TR_INCLUDE_PATH.'classes/Utility.class.php');
$lang_charset = "UTF-8";

//Timer
$mtime = microtime(); 
$mtime = explode(' ', $mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$starttime = $mtime; 
//Timer Ends

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo DEFAULT_LANGUAGE_CODE; ?>" lang="<?php echo DEFAULT_LANGUAGE_CODE; ?>"> 

<head>
	<title><?php echo SITE_NAME; ?> : <?php echo $this->page_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->lang_charset; ?>" />
	<meta name="Generator" content="Transformable - Copyright 2009 by ATRC http://atrc.utoronto.ca/" />
	<meta name="keywords" content="Transformable,free, open source, accessibility checker, accessibility reviewer, accessibility evaluator, accessibility evaluation, WCAG evaluation, 508 evaluation, BITV evaluation, evaluate accessibility, test accessibility, review accessibility, ATRC, WCAG 2, STANCA, BITV, Section 508." />
	<meta name="description" content="Transformable is a Web accessibility evalution tool designed to help Web content developers and Web application developers ensure their Web content is accessible to everyone regardless to the technology they may be using, or their abilities or disabilities." />
	<base href="<?php echo $this->content_base_href; ?>" />
	<link rel="shortcut icon" href="<?php echo $this->base_path; ?>/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/forms.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/styles.css" type="text/css" />
	<!--[if IE]>
	  <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/ie_styles.css" type="text/css" />
	<![endif]-->
<?php echo $this->rtl_css; ?>
	<script src="<?php echo $this->base_path; ?>include/jscripts/infusion/InfusionAll.js" type="text/javascript"></script>
	<script src="<?php echo $this->base_path; ?>jscripts/infusion/jquery.autoHeight.js" type="text/javascript"></script>
	<script src="<?php echo $this->base_path; ?>include/jscripts/handleAjaxResponse.js" type="text/javascript"></script>
	<script src="<?php echo $this->base_path; ?>include/jscripts/transformable.js" type="text/javascript"></script>
<?php echo $this->custom_css; ?>
</head>

<body onload="<?php echo $this->onload; ?>">

<div id="liquid-round">
  
  <div class="center-content">
<a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>#content" accesskey="c">
	<img src="<?php echo $this->base_path; ?>images/clr.gif" height="1" width="1" border="0" alt="<?php echo _AT('goto_content'); ?> ALT+c" /></a>		

	<a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>#menu<?php echo $_REQUEST['cid']  ?>"  accesskey="m"><img src="<?php echo $this->base_path; ?>images/clr.gif" height="1" width="1" border="0" alt="<?php echo _AT('goto_menu'); ?> ALT+m" /></a>
	
    <div id="logo">
      <!-- <a href="http://www.atutor.ca/"><img width="100" src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/images/logo.png" height="30" alt="Transformable Logo" style="border:none;" /></a> -->
    </div>
  
  <div id="banner">
    <span id="logininfo">
        <?php
        if (isset($this->user_name))
        {
          echo _AT('welcome'). ' '.$this->user_name;
        ?>
				&nbsp;&nbsp;
				<a href="<?php echo TR_BASE_HREF; ?>logout.php" ><?php echo _AT('logout'); ?></a>
        <?php
        }
        else
        {
        ?>
				<a href="<?php echo TR_BASE_HREF; ?>login.php" ><?php echo _AT('login'); ?></a>
				&nbsp;&nbsp;
				<a href="<?php echo TR_BASE_HREF; ?>register.php" ><?php echo _AT('register'); ?></a>
        <?php
        }
        ?>
    </span>
  </div>

  <div class="topnavlistcontainer">
  <!-- the main navigation. in our case, tabs -->
    <ul class="navigation">
<?php 
foreach ($this->top_level_pages as $page) {
	if ($page['url'] == $this->current_top_level_page) { 
?>
      <li class="navigation"><a href="<?php echo $page['url']; ?>" title="<?php echo $page['title']; ?>" class="active"><?php echo $page['title']; ?></a></li>
<?php } else { ?>
      <li class="navigation"><a href="<?php echo $page['url']; ?>"  title="<?php echo $page['title']; ?>"><?php echo $page['title']; ?></a></li>
<?php } // endif
} //endforeach ?>
    </ul>
  </div>

<!--
  <div class="topnavlistcontainer">
    <ul class="topnavlist">
    <?php foreach ($this->top_level_pages as $page): ?>
    <?php if ($page['url'] == $this->current_top_level_page): ?>
      <li><a href="<?php echo $page['url']; ?>" title="<?php echo $page['title']; ?>" class="active"><?php echo $page['title']; ?></a></li>
    <?php else: ?>
      <li><a href="<?php echo $page['url']; ?>"  title="<?php echo $page['title']; ?>"><?php echo $page['title']; ?></a></li>
    <?php endif; ?>
    <?php endforeach; ?>
    </ul>
  </div>
-->
	<!-- the sub navigation and guide -->
  <div id="sub-menu">
   
      <div class="search_top">
      <form target="_top" action="<?php echo TR_BASE_HREF; ?>home/search.php" method="get">
        <input type="text" name="search_text" id="search_text_at_header" value="<?php if (isset($_GET['search_text'])) echo $_GET['search_text']; ?>" size="16" />
        <input type="submit" name="search" value="<?php echo _AT("search"); ?>" />
      </form>
      </div>
  </div>
<!-- 
<div>
	<div id="breadcrumbs">
		<?php if (is_array($this->path)) {?>
		<?php foreach ($this->path as $page){ ?>
			<a href="<?php echo $page['url']; ?>"><?php echo $page['title']; ?></a> > 
		<?php }} echo $this->page_title; ?>
	</div>

	<?php if (isset($this->guide)) {?>
		<a href="<?php echo $this->guide; ?>" id="guide" onclick="trans.utility.poptastic('<?php echo $this->guide; ?>'); return false;"><em><?php echo $this->page_title; ?></em></a>
	<?php } ?>
</div>
!-->

  <div id="ajax-msg">
  </div>

  <?php if (is_array($this->tool_shortcuts)): ?>
  <div id="shortcuts">
    <ul>
    <?php foreach ($this->tool_shortcuts as $link): ?>
      <li><a href="<?php echo $link['url']; ?>"><img src="<?php echo $link['icon']; ?>" alt="<?php echo $link['title']; ?>"  title="<?php echo $link['title']; ?>" class="shortcut_icon"/><!-- <?php echo $link['title']; ?> --></a></li>
    <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <div id="guide_box">
    <!-- guide -->
    <?php if (isset($this->guide)) {?>
    <!-- <div> -->
      <a href="<?php echo $this->guide; ?>" onclick="trans.utility.poptastic('<?php echo $this->guide; ?>'); return false;" id="guide" target="_new"><em><?php echo $this->page_title; ?></em></a>&nbsp;
    <!-- </div> -->
    <?php }?>

	<?php if (isset($this->course_id) && $this->course_id > 0) {?>
    <!--  <div id="course-tools">-->
      <?php if ($this->isAuthor) { // only for authors ?>
      <a href="<?php echo $this->base_path; ?>home/course/course_property.php?_course_id=<?php echo $this->course_id; ?>">
        <img src="<?php echo $this->base_path. "themes/".$this->theme."/images/course_property.png"; ?>" title="<?php echo _AT('course_property'); ?>" alt="<?php echo _AT('course_property'); ?>" border="0" />
      </a> &nbsp;
      <a href="<?php echo $this->base_path; ?>home/course/del_course.php?_course_id=<?php echo $this->course_id; ?>">
        <img src="<?php echo $this->base_path. "themes/".$this->theme."/images/delete.gif"; ?>" title="<?php echo _AT('del_course'); ?>" alt="<?php echo _AT('del_course'); ?>" border="0" />
      </a> &nbsp;
      <?php }?>
      <a href="<?php echo $this->base_path; ?>home/index.php">
        <img src="<?php echo $this->base_path. "themes/".$this->theme."/images/exit.png"; ?>" title="<?php echo _AT('exit_course'); ?>" alt="<?php echo _AT('exit_course'); ?>" border="0" />
      </a>
    <?php }?>
    </div>
<?php  
//if ($this->course_id > 0) {
?>
  <div id="contentwrapper">
    <?php if ((isset($this->course_id) && $this->course_id > 0)): ?>
    <div id="leftcolumn">
      <script type="text/javascript">
      //<![CDATA[
      var state = trans.utility.getcookie("side-menu");
      if (state && (state == 'none')) {
          document.writeln('<a name="menu"></a><div style="display:none;" id="side-menu">');
      } else {
          document.writeln('<a name="menu"></a><div id="side-menu">');
      }
      //]]>
      </script>

      <?php require(TR_INCLUDE_PATH.'side_menu.inc.php'); ?>

      <script type="text/javascript">
      //<![CDATA[
      document.writeln('</div>');
      //]]>
      </script>
    </div>
	<?php endif; ?>

    <div id="contentcolumn"
    <?php if (isset($this->course_id) && $this->course_id <= 0): ?>
      style="margin-left:0.5em;width:99%;"
    <?php endif; ?>
    >

    <?php if (isset($this->course_id) && $this->course_id > 0): ?>
      <div id="menutoggle">
        <?php if ($this->course_id > 0): ?>
        <script type="text/javascript" language="javascript">
        //<![CDATA[
        var state = trans.utility.getcookie("side-menu");
        if (state && (state == 'none')) {
        	trans.utility.showTocToggle("side-menu", "<?php echo _AT('show'); ?>","<?php echo _AT('hide'); ?>", "", "show");
        } else {
            document.getElementById('contentcolumn').id="contentcolumn_shiftright";
            trans.utility.showTocToggle("side-menu", "<?php echo _AT('show'); ?>","<?php echo _AT('hide'); ?>", "", "hide");
        }
        //]]>
        </script>
        <?php endif; ?>
      </div>

      <div id="sequence-links">
        <?php //if ($_SESSION["prefs"]["PREF_SHOW_NEXT_PREVIOUS_BUTTONS"]) { ?>
          <?php if ($this->sequence_links['resume']): ?>
        <a style="color:white;" href="<?php echo $this->sequence_links['resume']['url']; ?>" accesskey="."><img src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/images/resume.gif" border="0" title="<?php echo _AT('resume').': '.$this->sequence_links['resume']['title']; ?> Alt+." alt="<?php echo $this->sequence_links['resume']['title']; ?> Alt+." class="img-size-ascdesc" /></a>
          <?php else:
          if ($this->sequence_links['previous']): ?>
        <a href="<?php echo $this->sequence_links['previous']['url']; ?>" title="<?php echo _AT('previous_topic').': '. $this->sequence_links['previous']['title']; ?> Alt+," accesskey=","><img src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/images/previous.gif" border="0" alt="<?php echo _AT('previous_topic').': '. $this->sequence_links['previous']['title']; ?> Alt+," class="img-size-ascdesc" /></a>
          <?php endif;
          if ($this->sequence_links['next']): ?>
        <a href="<?php echo $this->sequence_links['next']['url']; ?>" title="<?php echo _AT('next_topic').': '.$this->sequence_links['next']['title']; ?> Alt+." accesskey="."><img src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/images/next.gif" border="0" alt="<?php echo _AT('next_topic').': '.$this->sequence_links['next']['title']; ?> Alt+." class="img-size-ascdesc" /></a>
          <?php endif; ?>
        <?php endif; ?>
		<?php // } ?>
			&nbsp;
      </div>
        <?php endif; ?>

      <!-- the page title -->
      <a name="content" title="<?php echo _AT('content'); ?>"></a>
      <h2 class="page-title"><?php echo $this->page_title; ?></h2>
      <div id="server-msg">
      <?php global $msg; $msg->printAll(); ?>
      </div>

      <?php if (count($this->sub_level_pages) > 0): ?>

<!-- <div id="topnavlistcontainer">
	<ul id="topnavlist">
		<?php $accesscounter = 0; //initialize ?>
		<?php foreach ($this->top_level_pages as $page): ?>
			<?php ++$accesscounter; $accesscounter = ($accesscounter == 10 ? 0 : $accesscounter); ?>
			<?php $accesskey_text = ($accesscounter < 10 ? 'accesskey="'.$accesscounter.'"' : ''); ?>
			<?php $accesskey_title = ($accesscounter < 10 ? ' Alt+'.$accesscounter : ''); ?>
			<?php if ($page['url'] == $this->current_top_level_page): ?>
				<li><a href="<?php echo $page['url']; ?>" <?php echo $accesskey_text; ?> title="<?php echo $page['title'] . $accesskey_title; ?>" class="active"><?php echo $page['title']; ?></a></li>
			<?php else: ?>
				<li><a href="<?php echo $page['url']; ?>" <?php echo $accesskey_text; ?> title="<?php echo $page['title'] . $accesskey_title; ?>"><?php echo $page['title']; ?></a></li>
			<?php endif; ?>
			<?php $accesscounter = ($accesscounter == 0 ? 11 : $accesscounter); ?>
		<?php endforeach; ?>
	</ul>
</div> -->

   
<?php endif; ?>
<!-- the main navigation. in our case, tabs -->

<?php 
//} // end of else
?>
 <!-- the sub navigation -->
<div id="subnavlistcontainer">
    <div id="sub-navigation">

      <?php if (is_array($this->sub_menus) && count($this->sub_menus) > 0): ?>
	  <?php if (isset($this->back_to_page)): ?>
	    <div id="subnavbacktopage">	  
	      <a href="<?php echo $this->back_to_page['url']; ?>" id="back-to"><?php echo '<img src="'.$_base_href.'images/arrowicon.gif"  alt="'._AT('back_to').':'.$this->back_to_page['title'].'" title="'._AT('back_to').':'.$this->back_to_page['title'].'" style="vertical-align:center;">'?></a> 
	    </div>
	  <?php endif; ?>
	<ul id="subnavlist">
      <?php $num_pages = count($this->sub_menus); ?>
      <?php for ($i=0; $i<$num_pages; $i++): ?>
	  <?php list($sub_menu_url, $param) = Utility::separateURLAndParam($this->sub_menus[$i]['url']);
      if ($sub_menu_url == $this->current_page): ?>
	<li><strong><?php echo $this->sub_menus[$i]['title']; ?></strong></li>
      <?php else: ?>
	<li><a href="<?php echo $this->sub_menus[$i]['url']; ?>"><?php echo $this->sub_menus[$i]['title']; ?></a></li>
      <?php endif; ?>
      <?php if ($i < $num_pages-1): ?>
      <?php endif; ?>
      <?php endfor; ?>
      <?php else: ?>
      &nbsp;

      <?php endif; ?>
      <?php if (is_array($this->sub_menus) && count($this->sub_menus) > 0): ?>
      </ul>
      <?php endif; ?>

    </div>
</div>