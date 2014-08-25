
$(function() {
    $('.userlike').live('click',function(e) {    
        e.stopPropagation();
        e.preventDefault();  
        var userid = $(this).attr('data-userid');
        var classposition = $(this);
        $.ajax({
            type: 'POST',
            data: {'userid': userid},
            url: base_url + 'ajaxcalls/developerslike',
            dataType: 'json',
            success: function(response)
            {
                if (response.success == true)
                {
                    $(classposition).parent().find('.likecount').remove();
                    $(classposition).parent().append(response.count);
                    $( classposition ).replaceWith(response.html);
                    
                }
                else
                {
                    if(response.redirect)
                        {
                            window.location = base_url+ response.redirect;
                        }                    
                }
            }


        });
    });
    
    $('.userdislike').live('click',function(e) {
        e.stopPropagation();
        e.preventDefault();        
        var userid = $(this).attr('data-userid');
        var classposition = $(this);
        $.ajax({
            type: 'POST',
            data: {'userid': userid},
            url: base_url + 'ajaxcalls/developersdislike',
            dataType: 'json',
            success: function(response)
            {
                if (response.success == true)
                {
                    $(classposition).parent().find('.likecount').remove();
                    $(classposition).parent().append(response.count);
                    $(classposition).replaceWith(response.html);
                    
                }
                else
                {
                    
                }
            }


        });
    });

 
    

    $('.userlink').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        var user_id = $(this).attr('data-userid');
        
        $('#myModalLabel').html('User link info');
        $('#developers-actions .modal-body').html( base_url + "users/profile/" + user_id);
        $('#developers-actions').modal('show');
       
        
    });

     $('#form1').validate({
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                subject: {
                    required: "Subject is required"
                },
                message: {
                    required: "Message is required"
                }
            }
        });

        $('.user-email-dev').click(function(e) {

            e.preventDefault();
            e.stopPropagation();
            var user_id = $(this).attr('data-userid');
            $('form#form1 .userid').val(user_id);
            $("#mail").modal('show');



        });
    
  
    
});
