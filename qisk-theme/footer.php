<?php
   /*footer template 
   edited by karthik*/
   global $base_url;
   ?>
<footer class="footer">
   Copyright © <?php echo date("Y"); ?>.Smartcard App.
</footer>
<script src="<?= $base_url;?>/assets/js/jquery.app.js"></script>
<script>
$(document).ready( function () {
    $('#datatable').DataTable();
});
</script>
<?php /* popup div bx dataset */ ?>
</div>
<div id="cdn-ld-frm">
   <div id="pop-innr-bx">
      <div id="ldr-fsn-mn2" style="display: none;">
      </div>
      <div id="popup-blk">
      </div>
      <div class="popup-mdl-bg" style="display: block; cursor: pointer;">
         <div id="ldr_bx_cntr" style="display: none;">
            <div class="preloader-wrapper active">
               <div class="spinner-layer spinner-red-only">
                  <div class="circle-clipper left">
                     <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                     <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                     <div class="circle"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="loader" style="display: none;">
   <div class="_loder_div">
      <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
         <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30">
         </circle>
      </svg>
   </div>
</div>
<div id="preloader">
   <div class="preloader-position">
      <div class="preloader-wrapper big active">
         <div class="spinner-layer spinner-teal">
            <div class="circle-clipper left">
               <div class="circle"></div>
            </div>
            <div class="gap-patch">
               <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
               <div class="circle"></div>
            </div>
         </div>
      </div>
   </div>
</div> 
</body>
</html>