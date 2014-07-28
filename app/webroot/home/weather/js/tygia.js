if (location.host !=='vnexpress.net')
{
	document.write('<div class="demo"><table class="bor_ctd" border="0"  cellpadding="0" cellspacing="0" width="95%" bgcolor="#ffffff">');
	try
	{
		for(t in vForexs)
		{
			if (typeof vForexs[t] != "undefined")
			{
		    	document.write('<tr><td class="ctd" bgcolor="#ffffff">&nbsp;&nbsp;' + vForexs[t] + '</td><td class="ctd" bgcolor="#ffffff">&nbsp;' + vCosts[t] + '</td></tr>');
			}
	    }
	}
	catch (error)
	{
	    document.write('<tr><td colspan="2" class="source">Đang cập nhật</td></tr>');
	}
	document.write('</table></div>');
}
