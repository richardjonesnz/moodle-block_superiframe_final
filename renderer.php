<?php 

class block_superiframe_renderer extends plugin_renderer_base { 
  
  //Here we return all the content that the goes in the block
  function fetch_block_content($blockid){

    global $CFG, $USER;
    
    $content = '';  // local variable to build return value
    $content .= '<br />' . get_string('welcome_user', 'block_superiframe', $USER) . '<br />';
    
    // Link to the iFrame (blockid passed in from block_superiframe.php)
    $link = new moodle_url('/blocks/superiframe/view.php', array('blockid'=>$blockid));
    $content .=  $this->output->action_link($link, get_string('gotosuperiframe','block_superiframe'), new popup_action('click', $link)); 
    return $content;
  }

  //Here we aggregate all the pieces of content of the view page and display them
  // The passed in parameters originate in the admin config settings for the block
  function display_view_page($blockid, $url, $width, $height) {
    global $USER; 
    // start output to browser
    echo $this->output->header();
    
    // Display our page heading
    echo html_writer::empty_tag('br') . $this->output->user_picture($USER) . html_writer::empty_tag('br');
    echo $this->output->heading(get_string('pluginname', 'block_superiframe'),5);
 
    // Add the size buttons
    $view_page = '/blocks/superiframe/view.php';
   
    // Set up the links in an array (so we can use them in a list structure)
    $links = array();

    // Create list of links for ul - week 6 add the required blockid parameter
    // to fix the introduced bug.
    $link = new moodle_url($view_page, array('blockid'=>$blockid, 'size' => 'large'));
    $links[] = html_writer::link($link, get_string('large', 'block_superiframe'));
    
    $link = new moodle_url($view_page, array('blockid'=>$blockid, 'size' => 'medium'));
    $links[] = html_writer::link($link, get_string('medium', 'block_superiframe'));
    
    $link = new moodle_url($view_page, array('blockid'=>$blockid, 'size' => 'small'));
    $links[] = html_writer::link($link, get_string('small', 'block_superiframe'));
    
    $link = new moodle_url($view_page, array('blockid'=>$blockid, 'size' => 'custom'));
    $links[] = html_writer::link($link, get_string('custom', 'block_superiframe'));
    
    // Add a class to the containing div 
    echo html_writer::start_div('block_superiframe_sizes');
      // Add class to style a nav list
      $list_attributes = array('class'=>'block_superiframe_size_links');
      echo html_writer::alist($links, $list_attributes, 'ul');
    echo html_writer::end_div();   
   
    echo html_writer::start_div('block_superiframe_main');
      // Set up the iFrame attributes
      $attributes = array('src' => $url, 
      'height' => $height, 
      'width' => $width, 
      'style' => 'border:0; margin-top:10px');
      
      echo '<br />' . ' my url is: ' . $url;
      echo '<br />' . ' my width is: ' . $width;
      echo ' my height is: ' . $height . '<br />';
      
      // Display the iframe
      echo html_writer::empty_tag('iframe', $attributes);  
      echo $this->output->heading(get_string('pluginname', 'block_superiframe'),5);
    echo html_writer::end_div();   

    //send footer out to browser
    echo $this->output->footer();
  }
}