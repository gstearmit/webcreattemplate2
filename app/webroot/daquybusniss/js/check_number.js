function CalcKeyCode(aChar)
{
	var character = aChar.substring(0,1);
	var code = aChar.charCodeAt(0);
	return code;
}

function checkNumber(val) 
{
	var strPass = val.value;
	var strLength = strPass.length;
	var lchar = val.value.charAt((strLength) - 1);
	var cCode = CalcKeyCode(lchar);
	if (strLength == 1 && cCode == 48)
	{
		val.value = 1;
	}
	if (cCode < 48 || cCode > 57 || cCode == 20) 
	{
		var myNumber = val.value.substring(0, (strLength) - 1);
		val.value = myNumber;
	}
	
	return false;
}

function checkProductService(val) 
{
	var strPass = val.value;
	var strLength = strPass.length;
	var lchar = val.value.charAt((strLength) - 1);
	var cCode = CalcKeyCode(lchar);
	
	if(strLength > 18 || cCode == 44 || cCode == 34 || cCode == 39 || cCode == 46 || cCode == 47 || cCode == 58 || cCode == 59 || cCode == 63 || cCode == 64 || cCode == 92 || cCode == 96)
	{
		var myNumber = val.value.substring(0, (strLength) - 1);
		val.value = myNumber;
	}
	
	return false;
}