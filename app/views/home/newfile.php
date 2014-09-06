 <!-- 
									      <script type="text/javascript">
                                                jQuery(document).ready(function()
									                    { 
                                                	$('.viewedit').click(function(event) 
    									                    alert("cxcxcxcxc");           
    									                              
    									                                      $.ajax({
    									                                              url:"<?php bloginfo('url');?>/prosessing_add_nguoid_bt_admin",
    									                                              type:"POST",
    									                                              data: {data_user_ngdung:data_user_ngdung},
    									                                              success: function(data)
    									                                              {
    									                                                //alert(data);
    									
    									                                                  $('#phanquyennguoidungadmin').html(data);
    									                                                  $('#phanquyennguoidungadmin').show()
    									                                                   window.disablePopup_adminbt();
    									                                                   var data_user_ngdung=[];
    									                                                  // window.location.reload();
    									                                                  
    									                                              }
    									                                        }); 
									                    });                  
									                    })
									                    
									                </script>  	
									     -->	