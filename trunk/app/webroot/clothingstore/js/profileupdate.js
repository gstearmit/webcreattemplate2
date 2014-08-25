$('#btn1').on('click',function(){       
$('#OverviewDiv').toggle('slow',function(){
    $('#hourlyRate').val($('#hrate').text().trim());
    $('#overviewText').val($('#overviewDetail').text().trim());
});        
});

$('#overviewForm').submit(function(){
$.post($(this).attr('action'), $(this).serialize(), function(res){
    if(res == 1)
    {
        $('#overviewDetail').html($('#overviewText').val());
        $('#hrate').html($('#hourlyRate').val());
        $('#btn1').trigger('click'); 
    }
    else if(res == 0) alert('Error: some error occur in operation.');
});       
return false;
});

$('#btn2').on('click',function(){       
    $("#addPortfolio input[type=text], #addPortfolio textarea").val("");       
});

$('#btn3').on('click',function(){       
$('#SkillsText').toggle('slow',function(){
    $('#skillTextarea').val($('#SkillsText').text().trim());
});        
});

$('#skillsForm').submit(function(){
$.post($(this).attr('action'), $(this).serialize(), function(res){
    if(res == 1)
    {
        $('#SkillsText').html($('#skillTextarea').val());
        $('#btn3').trigger('click'); 
    }
    else if(res == 0) alert('Error: some error occur in operation.');
});       
return false;
});

$('#btn4').on('click',function(){       
$('#moreDetail').toggle('slow',function(){
    $('#textMoreDetail').val($('#moreDetail').text().trim());
});        
});

$('#moreDetailForm').submit(function(){
$.post($(this).attr('action'), $(this).serialize(), function(res){
    if(res == 1)
    {
        $('#moreDetail').html($('#textMoreDetail').val());
        $('#btn4').trigger('click'); 
    }
    else if(res == 0) alert('Error: some error occur in operation.');
});       
return false;
});

$('#btn5').on('click',function(){
$('.contact_details').toggle('slow',function(){
    $('#pContactDetail').val($('#pcontact').text().trim());
    $('#cContactDetail').val($('#ccontact').text().trim());
});
});

$('#contactDetailForm').submit(function(){
$.post($(this).attr('action'), $(this).serialize(), function(res){
    if(res == 1)
    {
        $('#pcontact').html($('#pContactDetail').val());
        $('#ccontact').html($('#cContactDetail').val());
        $('#btn5').trigger('click');                
    }
    else if(res == 0) alert('Error: some error occur in operation.');
});
return false;      
});

