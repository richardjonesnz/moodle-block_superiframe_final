<?php
 
require('../../config.php');
require_once('../../lib/moodlelib.php');
 
// Fetch the blockid whose settings we should use and set the URL
// This is done before require login (need to check why?)
$blockid=required_param('blockid', PARAM_INT);
$PAGE->set_url('/blocks/superiframe/view.php', array('blockid'=>$blockid));

require_login();

// Fetch the size of the iFrame from the parameter after view.php
// if it exists (name, default, type)
$size = optional_param('size', 'none', PARAM_TEXT);
 
//get our config
$def_config = get_config('block_superiframe');
$src = $def_config->url;
$cfg_width = $def_config->width;   
$cfg_height = $def_config->height;

 
$usercontext = context_user::instance($USER->id);
$PAGE->set_course($COURSE);
//$PAGE->set_url('/blocks/superiframe/view.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('embedded');
$PAGE->set_title(get_string('pluginname', 'block_superiframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superiframe'));
 
// start output to browser
$renderer = $PAGE->get_renderer('block_superiframe');

  // get the serialized instance data from the plugin instance table for this block
  $configdata = $DB->get_field('block_instances', 'configdata', array('id' => $blockid));
  echo 'config data: ' . $configdata; // you can check it here

  if($configdata){
     $config = unserialize(base64_decode($configdata));
     echo '<br />size: ' . $config->size . ' src: ' . $config->url; // Can show it works here
  }else{
     $config = $def_config; 
  }
  if ($size == 'none') {
    $size = $config->size;
  } 

// Set the iFrame size according to the data from the decoded database entry
//  for this block instance
switch($size) {
  case 'custom' : $width = $cfg_width; $height = $cfg_height; //defaults from block config
  break;
  case 'small' : $width = 250; $height = 180; 
  break;
  case 'medium' : $width = 512; $height = 400; 
  break;
  case 'large' : $width = 800; $height = 500;   
  break;  
}

$renderer->display_view_page($blockid, $config->url, $width, $height);

return;
    