function AddGoldPrice(type,Currency, Rate)
{
   document.writeln('<tr><td class="ctd"  bgcolor="#ffffff">&nbsp;', type , ' : ',Currency, '</td><td class="ctd" bgcolor="#ffffff">', Rate, '&nbsp;</td></tr>');
}
if (typeof(vGoldSjcBuy) !='undefined') AddGoldPrice('SJC','Mua vào', vGoldSjcBuy);
if (typeof(vGoldSjcSell)!='undefined') AddGoldPrice('SJC','Bán ra', vGoldSjcSell);

if (typeof(vGoldSbjBuy) !='undefined') AddGoldPrice('SBJ','Mua vào', vGoldSbjBuy);
if (typeof(vGoldSbjSell)!='undefined') AddGoldPrice('SBJ','Bán ra', vGoldSbjSell);
