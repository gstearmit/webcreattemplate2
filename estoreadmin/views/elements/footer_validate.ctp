 <footer id='footer'>
            <div class='footer-wrapper'>
              <div class='row'>
                <div class='col-sm-6 text'>
                 Copyright © 2014 Technology Company Alataca
                </div>
              </div>
            </div>
          </footer>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <script>
$(document).ready(function(){
	$("#help").hide();
  $("#show-help").click(function(){
    $("#help").toggle(500);
  });
  $("#close-help").click(function(){
	  $("#help").hide(500);
  });
});
</script>
    <!-- / jquery mobile (for touch events) -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/bootstrap_colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/input_mask/bootstrap-inputmask.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/bootstrap_maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/charCount/charCount.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/autosize/jquery.autosize-min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/bootstrap_switch/bootstrapSwitch.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/naked_password/naked_password-0.2.4.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/mention/mention.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/typeahead/typeahead.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/common/wysihtml5.min.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/common/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/pwstrength/pwstrength.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/common/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="<?php echo DOMAINAD?>html/assets/javascripts/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
     
    <!-- / END - page related files and scripts [optional] -->