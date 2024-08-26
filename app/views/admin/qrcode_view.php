<div class="content-wrapper">            
	<section class="content-header">
		<h1>
		    QR Code
			<small>Management</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url();?>admin/qrcodes/view"> QR Code</a></li>
			<li class="active">View</li>
		</ol>
	</section>
  <section class="content">
    <div class="row">
      <div class="box">
       <div class="box-body">
      	<div class="row">
      		 <div class="col-md-10">&nbsp;</div>
      	  <div class="col-md-2">
      		<a href="<?php echo base_url();?>admin/qrcodes/add" class="btn btn-primary">Add New</a>
      	  </div>
      	</div>
       </div> 

			 <div class="box-body">
			  	<?php if($this->session->flashdata('error'))  {  echo $this->session->flashdata('error');  } ?>
		    	<?php if($this->session->flashdata('success')){  echo $this->session->flashdata('success');} ?>  
				<div class="row">
					<div class="col-md-4">
						 <label>Show: <select class="form-control per" name="per_page" id="per_page">
								<option value="10" <?php if((isset($per_page))&&($per_page == 10)) {?> selected="selected" <?php } ?>>10</option>
								<option value="25" <?php if((isset($per_page))&&($per_page == 25)) {?> selected="selected" <?php } ?>>25</option>
								<option value="50" <?php if((isset($per_page))&&($per_page == 50)) {?> selected="selected" <?php } ?>>50</option>
								<option value="100" <?php if((isset($per_page))&&($per_page == 100)) {?> selected="selected" <?php } ?>>100</option>
							</select>
					   </label>
					</div>
					<div class="col-md-4">&nbsp;</div>
					<div class="col-md-4">
					<form id="search_form" action="<?php echo base_url().'admin/qrcodes/search';?>" method="get">
					 <label>Search: 
					   <input type="text" value="<?php if(isset($search_text) && $search_text!='search_text') { echo $search_text; }?>" name="search_text"  placeholder="Search" id="search_text" class="form-control" style="">
					 </label>
					 </form>
					</div>
				</div>
				<div style="clear: both;margin-top: 20px;"></div>
           <?php if(isset($search_text) && $search_text!='search_text') { $search_txt='/'.$search_text; } else { $search_txt='';}?>
	          <table  id="records" class="table table-bordered table-hover dataTable"> 
	              <thead>
	                  <tr style="background-color:#ccc">
	                      <td width="5">S.No</td>
						  <td>QR</td>
						  <td>URL</td>
						  <td>Created</td>
	                      <td align="center">Action&nbsp;</td>
	                  </tr>                                    
	               </thead>
	               <tbody>
	                  <?php $class='style="background-color:#f5f5f5"'; $j=$offset;  foreach($result as $rec) {  if($j%2==0) { $class='style="background-color:#ddd"'; } else { $class='style="background-color:#fff"';}  ?>
	                  	<tr <?php echo $class;?>>
	                       <td><?php echo $j;?></td>           
								<td>
									 <a href="javascript:void(0)" class="qr_code_view"  data-qrimage= "<?php echo site_url('/assets/files/qrcode/'.$rec->qr_image);?>">	
									 	<img width="100" src="<?php echo site_url('/assets/files/qrcode/'.$rec->qr_image);?>" >
									 </a>
								</td>
								<td><?php echo $rec->url;?></td>
								<td><?php echo date("d-m-Y", strtotime($rec->created_at));?></td>
				                <td align="center"> 
				               		 <a rel="tooltip" class="label label-danger"  onclick="return confirm('Are you sure, You want to delete?')" title="Delete"  href="<?php echo base_url();?>admin/qrcodes/delete/<?php echo base64_encode($rec->id);?>"><i class='fa fa-trash-o'></i> Delete</a>
				                </td>
				             </tr>
	                 	<?php $j++;} ?>
	                  	<?php if(empty($result)) { ?>
	                  	<tr><td colspan="7" align="center">No data found</td></tr>
	                  	<?php } ?>
	              </tbody>
	          </table>  
			  </div>
	      <div style="clear: both;"></div>
         <div id="pagination" style="margin-left: 40%;">
                 <?php echo $pagination; ?>
         </div>
        </div>
      </div>
	</section>
</div>
<!-- Modal -->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     		<h4>Download Barcode</h4>
        </div>
        <div class="modal-body" style="text-align: center;">
        	<div>
	       	  <img id="load_qr_view" src="">
	       	</div>
	       	<div class="scan_btn">
	       	  	<?php $fname=$rec->qr_image; ?>
				<a id="load_qr_view1" class="btn btn-success" href="" download>Download</a>
			</div>
        </div>
       
      </div>
      
    </div>
  </div>
  

	
	<script>

   $("#per_page").change(function () {
       var value = this.value;
       var search_text = $('#search_text').val();
         if(search_text=='') {
           search_text='search_text';
       }
        window.location.href = "<?php echo base_url()?>admin/qrcodes/search/"+search_text+'/'+value;
    });

	$("#search_text").keyup(function(e){ 
    var code = e.which; 
    if(code ==13){
		$('#search_form').submit(); 
     }
	});

	$('.qr_code_view').click(function(){
		var qr_img = $(this).attr('data-qrimage');
		$('#load_qr_view').attr('src', qr_img);
		$('#load_qr_view1').attr('href', qr_img);
		$('#myModal').modal('show');
	});
</script>