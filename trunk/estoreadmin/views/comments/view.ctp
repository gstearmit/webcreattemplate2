 <style>
 table{
	 text-align:left !important;
	 border:1px solid #999 !important;
	 }
 table td{
	 border:1px solid #999 !important;
	 padding-left:20px;
	 }
</style>
 <div id="news">
  <div id="title-news"><p>Chi tiết Comments</p></div>
     <div class="list-news">
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
              <tr>
                <td width="250">Tên khách</td>
                <td>                      
                     <?php echo $views['Comments']['name']?>
                </td>
              </tr>
              <tr>
                <td width="250">Email</td>
                <td>                      
                     <?php echo $views['Comments']['email']?>
                </td>
              </tr>
              <tr>
                <td width="250">Nội dung</td>
                <td>                      
                     <?php echo $views['Comments']['content']?>
                </td>
              </tr>
     </table>
  </div>
</div>       