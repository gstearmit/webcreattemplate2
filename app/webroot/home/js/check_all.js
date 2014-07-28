function docheck(form_,opt)
{
	var status=form_.chkall.checked;
	var alen=form_.elements.length;
	alen=(alen>2)?form_.Xoa.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			form_.Xoa[i].checked=status;
	}else
	{
			form_.Xoa.checked=status;
	}
	if(opt>0)
		form_.chkall.checked=status;
}
function checkAll(theForm) {
	for (i=0;i<theForm.elements.length;i++)
	if (theForm.elements[i].name.indexOf('Xoa') !=-1)
	theForm.elements[i].checked = true;
	theForm.chkall.checked = true;
	}
function uncheckAll(theForm) {
	for (i=0;i<theForm.elements.length;i++)
	if (theForm.elements[i].name.indexOf('Xoa') !=-1)
	theForm.elements[i].checked = false;
	theForm.chkall.checked =false;
	}
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}

function check(form_,opt)
{		
		var status=form_.chkall.checked
		var alen=form_.elements.length;
		alen=(alen>2)?form_.Xoa.length:0;
		if (alen>0)
		{
			for(var i=0;i<alen;i++)
				form_.Xoa[i].checked=status;
		}else
		{
				form_.Xoa.checked=status;
		}
		if(opt>0)
			form_.chkall.checked=status;						
					
}
function docheckone(form_)
{
	var alen=form_.elements.length;
	var isChecked=true;
	alen=(alen>2)?form_.Xoa.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			if(form_.Xoa[i].checked==false)
				isChecked=false;
	}else
	{
		if(form_.Xoa.checked==false)
			isChecked=false;
	}				
	form_.chkall.checked=isChecked;
}
function calculatechon(form_)
{			
	var strchon="";
	var alen=form_.elements.length;				
	alen=(alen>2)?form_.Xoa.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			if(form_.Xoa[i].checked==true)
				strchon+=form_.Xoa[i].value+",";
	}else
	{
		if(form_.Xoa.checked==true)
			strchon=form_.Xoa.value+",";
	}
	form_.chon.value=strchon;	
	
}
function checkInput(form_,strSelect,strConfirm)
{
	var alen=form_.elements.length;
	var isChecked=false;
	alen=(alen>2)?form_.Xoa.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			if(form_.Xoa[i].checked==true)
				isChecked=true;
	}else
	{
		if(form_.Xoa.checked==true)
			isChecked=true;
	}
	if (!isChecked)						
		alert(strSelect);
	else
	{
		if(strConfirm!='')
		{
			if (confirm(strConfirm))
			{
				isChecked=true;
				calculatechon(form_);
			}
			else
				isChecked=false;
		}else
		{
			isChecked=true;
			calculatechon(form_);
		}
	}								
return isChecked;
} 		  