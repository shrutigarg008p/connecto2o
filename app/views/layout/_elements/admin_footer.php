
</div>
<footer>
  <p class="footer">
			<p class="text-center">Copyright © 2018 Template by <a target="_blank" href="http://newaapp">newapp</a>.</p>
   </p>
</footer>

<?php
 echo admin_theme_script('validate.js');
 echo admin_theme_script('validator.min.js');

 echo admin_theme_script('app.min.js');
 echo admin_theme_script('admin_skin.js');
?>
 <script type="text/javascript">
$(document).ready(function(){
	$('[rel="tooltip"]').tooltip();   
});
$(function(){
  function stripTrailingSlash(str) {
    if(str.substr(-1) == '/') {
      return str.substr(0, str.length - 1);
    }
    return str;
  }

  var url = window.location.href;
  var url = url.substring(url.indexOf("#") + 1);
  var activePage = stripTrailingSlash(url);
  
  $('.sidebar-menu li a').each(function(){  
    var currentPage = stripTrailingSlash($(this).attr('href'));
    if (activePage == currentPage) {
         $(this).addClass('active'); 
		 $(this).parent().addClass('active'); 
		 $(this).parent().parent().addClass('active'); 
		 $(this).parent().parent().parent().addClass('active'); 
    } 
  });

  $('.delete-item').on('click', function(e){
       e.preventDefault();
    var el = $(this);

    var box = bootbox.dialog({
        show: false,
        backdrop: true,
        animate: true,
        title: "Are you sure?",
        message: 'Are you sure? You wants to delete.',
        buttons: {
          cancel: {
            label: 'Cancel',
            className: 'btn-default'
          },
          save: {
            label: 'Ok',
            className: 'btn-success',
            callback: function () {
              window.location = el.attr('href');
            }
          }
        }
      });
    box.modal('show');  
  });
  
});

</script>
</body>
 
</html>