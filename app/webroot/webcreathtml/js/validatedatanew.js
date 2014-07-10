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
		//var languageText = step1WizardForm.languageText.value;
		var s = document.getElementById('langgueNew');
		var langgueNew = s.options[s.selectedIndex].value;
		var action = step1WizardForm.action.value;
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
			
		}else {
				 $('#step1WizardForm').submit();
		}
		return false;
		
				
	} 
	
var Languages = {
		af: "Afrikaans",
		"en-us": "American English",
		az: "Azərbaycan",
		id: "Bahasa Indonesia",
		ms: "Bahasa Melayu",
		jv: "Basa Jawa",
		bs: "Bosanski",
		ca: "Català",
		cz: "Čeština",
		da: "Dansk",
		de: "Deutsch",
		et: "Eesti keel",
		en: "English",
		es: "Español",
		eo: "Esperanto",
		eu: "Euskara",
		fr: "Français",
		hr: "Hrvatski",
		it: "Italiano",
		lv: "Latviešu Valoda",
		lt: "Lietuvių kalba",
		hu: "Magyar",
		nl: "Nederlands",
		no: "Norsk",
		pl: "Polski",
		pt: "Português",
		"pt-br": "Português brasileiro",
		ro: "Română",
		sq: "Shqip",
		sk: "Slovenčina",
		sl: "Slovenski",
		sr: "Srpski",
		fi: "Suomi",
		sv: "Svenska",
		vi: "Tiếng Việt",
		tr: "Türkçe",
		el: "Ελληνικά",
		bg: "Български",
		mk: "Македонски јазик",
		ru: "Русский",
		uk: "Українська",
		he: "עִבְרִית",
		ar: "العربية",
		sd: "سنڌي",
		fa: "فارسی",
		ps: "پښتو",
		mr: "मराठी",
		bh: "मैथिली",
		hi: "हिन्दी",
		bn: "বাংলা",
		pu: "ਪੰਜਾਬੀ",
		gu: "ગુજરાતી",
		or: "ଓଡ଼ିଆ",
		ta: "தமிழ்",
		te: "తెలుగు",
		kn: "ಕನ್ನಡ",
		ml: "മലയാളം",
		th: "ภาษาไทย",
		"zh-tw": "中文 (繁體)",
		"zh-cn": "中文（简体）",
		ja: "日本語",
		ko: "한국어"
	};

var name = Languages.id;
//
jQuery("#languageText").click(function(){
	alert("Languages"+name);
	 // $("p").append("<b>Appended text</b>");
	});
