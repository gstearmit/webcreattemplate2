$(document).ready(function(){
	// Search
	$('#txtSearch').focus(function() {
		 $(this).val('');
	});	
	$('#txtSearch').blur(function() {
		if($(this).val() == ""){
			$(this).val('Tìm kiếm..');
		}
	});
	// Title
	$('div.leftitemtitle').click(function(){
		$(this).next().slideToggle("slow");
		return false;
	});	
	$('div.rightitemtitle').click(function(){
		$(this).next().slideToggle("slow");
		return false;
	});		
	// Left Menu
	$('#rtmenu div').click(function(){
		if ($(this).next().is(":hidden")) {			
			// Nhung menu dang show se hidden
			$('#rtmenu ul:not(:hidden)').prev().removeClass("menuitemdown").addClass("menuitemup");
			$('#rtmenu ul:not(:hidden)').slideUp("slow");
			// Menu vua chon se show
			$(this).removeClass("upRightMenu").addClass("menuitemdown");
			$(this).next().slideDown("slow");
			return false;			
		}
		else{
			$('#rtmenu ul:not(:hidden)').prev().removeClass("menuitemdown").addClass("menuitemup");
			$('#rtmenu ul:not(:hidden)').slideUp("slow");			
		}
	});
	// Top menu
	$(function() {
		$("#webwidget_menu_glide1").webwidget_menu_glide({menu_width:"100", menu_height:"28", menu_text_size:"12", menu_text_color:"#333333", menu_sprite_color:"#8DAF27", menu_background_color:"#F4F4F4", menu_margin:"0", sprite_speed:"slow", container:"webwidget_menu_glide1" });
	});	
	// Auto Scroll
    $.autoScroll({
        scrollDuration: 2000,
        showDuration: 600,
        hideDuration: 300
    });	
	// Err img
	$('img').error(function() {
		//$(this).remove();
		$(this).attr('src', URL+'/images/no-images.jpg');
	});
	// Slide img top
	$(function() {
		$('#bannerimgslide img:gt(0)').hide();
		setInterval(function(){
			$('#bannerimgslide :first-child').fadeOut().next('img').fadeIn().end().appendTo('#bannerimgslide');
		}, 5000);
	})	
	// Bài viết đổi chỗ
	$(function() {
		setInterval(function(){
			$('#baivietngaunhien div.rightproduct:last').hide().prependTo('#baivietngaunhien');
			$('#baivietngaunhien div.rightproduct:first').slideDown('slow');
		}, 5000);
	});	
	// Bài viết đổi chỗ
	$(function() {
		setInterval(function(){
			$('#baivietmoinhat div.rightproduct:last').hide().prependTo('#baivietmoinhat');
			$('#baivietmoinhat div.rightproduct:first').slideDown('slow');
		}, 5000);
	});	
	// Right menu
	$('div#rtmenu ul li.subselect').parent().css({'display':'block'});
	// Khi form tìm kiếm nhận trạng thái submit
	$('#frmsearch').submit(function(){
		var action=$(this).attr('action');
		var key=$('#txtSearch').val();
		if(key==''){
			alert('Chưa nhập từ khóa !');
		}
		else{
			window.location = action+key+'.html';
		}
		return false;
	});		
	
});

/*-----------------------------------------------------------*/
/*
var contact_bar;
var contact_offset = -11;	
$(window).scroll(function () { 
    move_contact();
});
function move_contact()
{
	if($('#slideads')) {
		if(contact_offset<-1){
			contact_bar = $('#slideads');
			contact_offset = contact_bar.offset().top;
		}
		if( window.XMLHttpRequest ) {
			if ($(document).scrollTop() > contact_offset) {
				if($(document).scrollTop() > ($(document).height()-400)){
					contact_bar.css('position', 'absolute');
					contact_bar.css('top', $(document).height()-400+'px');				
					//alert('a');
				}
				else{
					contact_bar.css('position', 'fixed');
					contact_bar.css('top', '5px');
					//alert('b');
				}
				
			} else if ($(document).scrollTop() < contact_offset) {
				contact_bar.css('position', 'absolute');
				contact_bar.css('top', contact_offset+'px');
				//alert('c');
			}
		}
	}
}
*/