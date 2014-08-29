
function abcdef(){
var url=document.URL;
var check=url.split("#");
if(check[1]=="step3"){
alert("validate");
}
}


function validateData234(){
$('#test').show();
return false;
		/*
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
			//$('#alert').html('<div class="loi"> Vui lòng nhập store name</div>');
			alert('Vui lòng nhập store name');
			//$('#test').show();
			document.getElementById("registrantFullName").focus();
			//check = false;
			
			return false;
			$('#test').show(200);
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
		*/
				
	}

function showWaitingAnimation()
{
	alert("wattting");
}
function processstep1()
{
	alert("processstep1");
}
function processstep2()
{
	alert("processstep2");
}

//step 2
	function validateStep2()
	{
		//alert("step 2view");return 0;
		
		
		var company_slogan = step1WizardForm.company_slogan.value;
		//var languageText = step1WizardForm.languageText.value;
		var s = document.getElementById('langgueNew');
		var langgueNew = s.options[s.selectedIndex].value;
		
		var action = step1WizardForm.action.value;
		// step 2:
		// step 3 :
		var contact_name = step3WizardForm.contact_name.value;
		var contact_street = step3WizardForm.contact_street.value;
		
		var contact_city = step3WizardForm.contact_city.value;
		var contact_zip = step3WizardForm.contact_zip.value;
		
		//country
		var countryNewid = document.getElementById('countryNew');
		var countryNew = countryNewid.options[countryNewid.selectedIndex].value;
		
		var contact_tel = step3WizardForm.contact_tel.value;
		var contact_email = step3WizardForm.contact_email.value;
		var contact_ic_VAT = step3WizardForm.contact_ic.value;
		
		//currency
		var currencyid = document.getElementById('currency');
		var currency = currencyid.options[currencyid.selectedIndex].value;
		
		//check:
		var taxes = document.getElementsByName('taxes');
		var taxes_value;
		for(var i = 0; i < taxes.length; i++){
		    if(taxes[i].checked){
		    	taxes_value = taxes[i].value;
		    }
		}
		
		
		
		alert("contact_name : "+contact_name );
		alert(" \n contact_street : "+contact_street );
		alert(" \t contact_city : "+contact_city );
		
		alert(" \t contact_zip : "+contact_zip );
		alert(" \t countryNew : "+countryNew );
		alert("contact_tel"+contact_tel );
		alert("contact_email"+contact_email );
		alert("contact_ic_VAT"+contact_ic_VAT );
		alert("currency"+currency);
		alert("VAT payer"+taxes_value);
		
		return 0;
		
		//alert(langgueNew);return 0;
		var check = '';
	   
		if(company_slogan =='')
		{
			alert('Vui lòng nhập company slogan');
			document.getElementById("company_slogan").focus();
			//check = false;
			return false;
		}else if( langgueNew =='')
		{
			alert('Vui lòng chọn language');
			document.getElementById("langgueNew").focus();//
			//check = false;
			return false;
			
		}
		//step 3
		else if( contact_name =='')
		{
			alert('Vui lòng chọn language');
			document.getElementById("contact_name").focus();//
			//check = false;
			return false;
			
		}
		else {
				 $('#step1WizardForm').submit();
		}
		return false;
		
				
	}

	
