function validateData234(){
		var registrantFullName = headerSignUp.storename.value;
		var signupUserEMail = headerSignUp.mail.value;
		var pass = headerSignUp.pass.value;
		var check = '';
		
		var res ;
		res = registrantFullName.substring(0,1); // get char one
		   if(isNaN(res)){
				//document.write(res + " is not a number <br/>");
				check = false;
			 }else{
				//document.write(res + " is a number <br/>");
				 check = true;
			 }
		
		   
		if(registrantFullName =='')
		{
			alert('Vui lòng nhập store name');
			document.getElementById("registrantFullName").focus();
			//check = false;
			return false;
		}else if( signupUserEMail =='')
		{
			alert('Vui lòng nhập email');
			document.getElementById("signupUserEMail").focus();//
			//check = false;
			return false;
			
		}else if(pass ==''){
			alert('Vui lòng nhập pass');
			document.getElementById("signupUserPwd").focus();
			//check = false;
			return false;
			
		}else {
			//alert(check);return;
			if(check == true && registrantFullName !=''){
				alert('Không chấp nhận kí tự đầu là số. Vi dụ : 123teststore => False . Sửa lại là teststore123 => True.');
				document.getElementById("registrantFullName").focus();
				return false;
			}else if (check == false && registrantFullName !='')
				{
				 $('#headerSignUp').submit();
				}
		}
		return false;
		
				
	}

//step 2
	function validateStep2()
	{
		//alert("step 2view");return 0;
		
		
		var company_slogan = step1WizardForm.company_slogan.value;
		var languageText = step1WizardForm.languageText.value;
		var check = '';
	   
		if(company_slogan =='')
		{
			alert('Vui lòng nhập company slogan');
			document.getElementById("company_slogan").focus();
			//check = false;
			return false;
		}else if( language =='')
		{
			alert('Vui lòng chọn language');
			document.getElementById("languageText").focus();//
			//check = false;
			return false;
			
		}else {
				 $('#step1WizardForm').submit();
		}
		return false;
		
				
	} 
