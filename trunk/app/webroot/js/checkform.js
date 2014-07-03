jQuery(document).ready(function($) {
	
	$("#myform").validate({
		rules: {
			name: {
				required: true,
				minlength:8
			},
			title: {
				required: true,
				minlength:1
			},
			price: {
				required: true,
				minlength:1
			},
			tengianhang: {
				required: true,
				minlength:1
			},
			address: {
				required: true,
				minlength:1
			},
			namecompany: {
				required: true,
				minlength:1
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},	
			
			email: {
				required: true,
				email: true
			},
			security: {
				required: true,
				minlength: 5,
				maxlength:5
			},
			city:{
				required: true
			},
			shopname:{
				required: true
			},
			
			phone: {
				required: true,
				number:true,
				 minlength: 7,
				 maxlength: 15
			},
			mobile: {
				required: true,
				number:true,
				 minlength: 7,
				 maxlength: 15
			},
			cmnd: {
				required: true,
				 minlength: 9,
				 maxlength: 9
			},
			
		},
		messages: {
			name: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập tên!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Họ tên bao gồm nhỏ nhất 8 ký tự!</span>"
			},
			name: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập tên!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Họ tên bao gồm nhỏ nhất 8 ký tự!</span>"
			},
			title: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập tên gian hàng!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Tên gian hàng ít nhất 1 ký tự!</span>"
			},
			price: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lÃ²ng nháº­p vÃ o tiÃªu Ä‘á»�!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>TiÃªu Ä‘á»� bao gá»“m Ã­t nháº¥t 1 kÃ­ tá»±!</span>"
			},
			tengianhang: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập tên gian hàng!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Tên gian hàng ít nhất 1 ký tự!</span>"
					
			},
			address: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập địa chỉ!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Địa chỉ bao gồm ít nhất 1 ký tự!</span>"
			},
			namecompany: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập vào tên công ty!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Tên công ty bao gồm ít nhất 1 ký tự!</span>"
			},
			email: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập vào Email!</span>",
				email: " <br><span style='color:#FF0000; padding-left:148px;'>Email không đúng!</span>"
			},
			password: {
				required: "<br><span style='color:#FF0000;padding-left:148px ' >Xin vui lòng nhập password !</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:140px;' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>"
			},
			security: {
				required: " <br><span style='color:#FF0000;padding-left:148px ' >Xin vui lòng nhập mã bảo vệ</span>",
				minlength: "<br><span style='color:#FF0000;padding-left:148px ' > Mã bảo vệ gồm 5 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000;padding-left:148px ' > MÃ bảo vệ gồm 5 ký tự!</span>"
			},
			confirm_password: {
				required: "<br><span style='color:#FF0000;padding-left:148px ' >Xin vui lòng nhập lại password !</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:140px;' >Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>",
				equalTo: "<br><span style='color:#FF0000; padding-left:148px;' > Password không giống ở trên !</span>"
			},
			
			city: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng chọn thành phố/ tỉnh!</span>"
				
			},
			shopname: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập tên đăng nhập!</span>"
				
			},
			phone: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập số điện thoại!</span>",
				number: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại bao gồm các số từ 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại ít nhất 7 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại nhiều nhất 15 ký tự!</span>"
			},
			mobile: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập số điện thoại!</span>",
				number: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại bao gồm các số từ 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại ít nhất 7 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại nhiều nhất 15 ký tự!</span>"
			},
			cmnd: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lÃ²ng nháº­p sá»‘ CMND!</span>",
				number: "<br><span style='color:#FF0000; padding-left:148px;'>Sá»‘ CMND chá»‰ bao gá»“m cÃ¡c sá»‘ tá»« 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:148px;'>Sá»‘ CMND pháº£i cÃ³ 9 sá»‘!</span>",
				maxlength: "<br><span style='color:#FF0000; padding-left:148px;'>Sá»‘ CMND pháº£i cÃ³ 9 sá»‘!</span>"
			},
			
			
		}
	});	
});
