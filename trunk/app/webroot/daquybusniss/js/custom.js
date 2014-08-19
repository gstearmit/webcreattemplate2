	function jqueryThuyNga(){
		$(document).ready(function(){
			$('#featured').nivoSlider({
				effect:"random",
				slices:15,
				boxCols:8,
				boxRows:3,
				animSpeed:500,
				pauseTime:3000,
				startSlide:0,
				directionNav:false,
				directionNavHide:false,
				controlNav:false,
				controlNavThumbs:false,
				controlNavThumbsFromRel:false,
				keyboardNav:false,
				pauseOnHover:true,
				manualAdvance:false
			});
		});
		$("#tabs").tabs();		
	}
    function isEmail(s)
    {
        var mail= /^(([a-zA-Z])+(([a-zA-Z0-9])*(\_{1})*([a-zA-Z])+)+\.)*(([a-zA-Z])+(([a-zA-Z0-9])*(\_{1})*([a-zA-Z])+)+)+@(([a-zA-Z])+(([a-zA-Z0-9])*(\-{1})*([a-zA-Z])+)+\.)+[a-zA-Z]{2,}$/
        var result=mail.test(s);
        return result;
    }
    function validationRegmail()
    {
        var regemail=$('#txtregemail').val();
        if(regemail=='')
        {
            alert("Bạn hãy nhập email")
            $('#txtregemail').focus();
            return false;
        
        }
        if(regemail!='')
        {
            if(!isEmail(email))
            {
                alert("Bạn hãy email đúng định dạng")
                $('#txtregemail').focus();
                return false;
            }
        }
        return true;
    }
    function isDate(dtStr)
    {
        var daysInMonth = DaysArray(12)
        var pos1 = dtStr.indexOf(dtCh)
        var pos2 = dtStr.indexOf(dtCh, pos1 + 1)
        var strMonth = dtStr.substring(0, pos1)
        var strDay = dtStr.substring(pos1 + 1, pos2)
        var strYear = dtStr.substring(pos2 + 1)
        strYr = strYear
        if (strDay.charAt(0) == "0" && strDay.length > 1) strDay = strDay.substring(1)
        if (strMonth.charAt(0) == "0" && strMonth.length > 1) strMonth = strMonth.substring(1)
        for (var i = 1; i <= 3; i++) {
            if (strYr.charAt(0) == "0" && strYr.length > 1) strYr = strYr.substring(1)
        }
        month = parseInt(strMonth)
        day = parseInt(strDay)
        year = parseInt(strYr)
        if (strMonth.length < 1 || month < 1 || month > 12) {
            $('#ErrorCode').html('Bạn đã chọn tháng không hợp lệ.');
            return false
        }
        if (strDay.length < 1 || day < 1 || day > 31 || (month == 2 && day > daysInFebruary(year)) || day > daysInMonth[month]) {
            $('#ErrorCode').html('Bạn đã chọn ngày không hợp lệ.');
            return false
        }
        return true
    }
            
    function isEmail(s)
    {
        var mail= /^(([a-zA-Z])+(([a-zA-Z0-9])*(\_{1})*([a-zA-Z])+)+\.)*(([a-zA-Z])+(([a-zA-Z0-9])*(\_{1})*([a-zA-Z])+)+)+@(([a-zA-Z])+(([a-zA-Z0-9])*(\-{1})*([a-zA-Z])+)+\.)+[a-zA-Z]{2,}$/
        var result=mail.test(s);
        return result;
    }
    function isPhoneNumber(s)
    {
        rex=/^0[1-9][0-9]{8,9}/;
        if(!rex.test(s)&& s!="")
        {
            return false;
        }
        return true;
    } 
    function validationDataRegister()
    {
        var username = $('#txtUserName').val();
        var pass =$('#txtUserPassword').val();
        var repass=$('#txtUserRePassword').val();
        var firstname=$('#txtFirstName').val();
        var lastname=$('#txtLastName').val();
        var email=$('#txtEmail').val();
        var address=$('#txtAddress').val();
        //var homephone=$('#txtHomphone').val();
        //var mobile=$('#txtMobile').val();
        var description=$('#txtDescription').val();
        var xacminh = document.forms['form_member'].elements['chkXacminh'].checked;
        
        if (username == ''){
            $('#ErrorCode').html('Tên đăng nhập không được để trống !');
            $('#txtUserName').focus();
            return false;
        }
        if(pass==''){
            $('#ErrorCode').html('Mật khẩu không được để trống !');
            $('#txtUserPassword').focus();
            return false;
        }
        if(repass!=pass){
            $('#ErrorCode').html('Nhập lại mật khẩu không đúng !');
            $('#txtUserRePassword').focus();
            return false;
        }
        if(firstname==''){
            $('#ErrorCode').html('Họ tên không được để trống !');
            $('#txtFirstName').focus();
            return false;
        }
        if(lastname==''){
            $('#ErrorCode').html('Tên không được để trống !');
            $('#txtLastName').focus();
            return false;
        }
        //var day = $('#dd').val();
        //var mon = $('#mm').val();
        //var year = $('#yy').val();
        //var dtCh = "/";            
        var birthDay=$('#mm').val()+"/"+$('#dd').val()+"/"+$('#yy').val();
        
        if(email==''){
            $('#ErrorCode').html('Email không được để trống !')
            $('#txtEmail').focus();
            return false;
            
        }
        if(email!='')
        {
            if(!isEmail(email))
            {
                $('#ErrorCode').html('Email không hợp lệ !')
                $('#txtEmail').focus();
                return false;
            }
        }
        
        if(address==''){
            $('#ErrorCode').html('Địa chỉ không được để trống');
            $('#txtAddress').focus();
            return false;
        }          
        //if(mobile==''){
        //                $('#ErrorCode').html('Số di động không được để trống !');
        //                $('#txtMobile').focus();
        //                return false;
        //            }
        //            if(!isPhoneNumber(mobile)){
        //                $('#ErrorCode').html('Số di động của bạn không đúng !');
        //                $('#txtMobile').focus();
        //                return false;
        //            }
        
        if(xacminh==false){
            $('#ErrorCode').html('Vui long chấp nhận nội quy website đưa ra.');
            return false;
        }
        //alert("Chạy hết javar");
        return true;
    }
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        
        return true;
    }