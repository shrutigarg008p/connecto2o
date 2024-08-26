<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view('layout/_elements/admin_header');
 $this->load->view('layout/_elements/admin_left_menu');
?>
<?php echo $the_view_content; ?>
<?php  $this->load->view('layout/_elements/admin_footer');?>