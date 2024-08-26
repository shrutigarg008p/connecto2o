<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view('layout/_elements/header');
?>
<?php echo $the_view_content; ?>
<?php  $this->load->view('layout/_elements/footer');?>