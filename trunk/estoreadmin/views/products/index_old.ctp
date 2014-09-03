<?php 
$cat ='Tên bài viết';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$cat ='Title article';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$cat ='Tên bài viết';
		$update='Cập nhật';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
 <?php  $langs= null;
                    $urlcart ="";
                    if(isset($_GET['language'])){
                    $abc=$_GET['language'];
                    if($abc =='vie'){
                    	$langs="?language=vie";
                    }
                    if($abc=='eng'){
						$langs ="?language=eng";
					}
					$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
					$de=DOMAIN.$langs;
					if($url!=$de){
					$url1 = str_replace(DOMAIN, "", $url);
					$url12 = split("[?]", $url1);
					//$urlcart1 = split("[/]", $url12[0]);
					$urlcart = DOMAIN.$url12[0];
					}
					}else{
						$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
						$urlcart=$url;
					}
					
					
					 
                    ?>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'products/search'.$langs,'type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>products/add" class="toolbar">
                                <span class="icon-32-new"></span>
                                 <?php __('Add_new')?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li id="toolbar-help">
                            <a href="#messages" rel="modal" class="toolbar">
                                <span class="icon-32-help"></span>
                                  <?php __('Help')?>
                            </a>
                        </li>
                        <li id="toolbar-unpublish">
                            <a href="<?php echo DOMAINADESTORE?>home" class="toolbar">
                                <span class="icon-32-unpublish"></span>
                                <?php __('Close')?>
                            </a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('product')?></h2></div>
        
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="keyword" class="text-input"></td>

                <td>
                <select style="margin-left:15px;" name="system">
                           <option value="">-- Danh mục --</option>
                            <?php foreach($cat as $Catproduct) {?>
                            <?php if($Catproduct['Catproduct']['parent_id']==11){?>
                             <option value="<?php echo $Catproduct['Catproduct']['id']; ?>"><?php echo $Catproduct['Catproduct']['name']; ?></option>
                             <?php foreach($catcon as $Catproducts) {?>
                             <?php if($Catproducts['Catproduct']['parent_id']==$Catproduct['Catproduct']['id']){?>
                             <option value="<?php echo $Catproducts['Catproduct']['id']; ?>">--<?php echo $Catproducts['Catproduct']['name']; ?></option>
                            <?php }}}}?>
                 </select>
                </td>
                    <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('News_list')?></a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <?php echo $form->end(); ?>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1"> 
            <table>
            <form action="<?php echo DOMAINADESTORE; ?>products/processing" name="form1" method="post">
            	<thead>
                    <tr>
                       <th width="1%"><input class="check-all" type="checkbox" /></th>
                       <th width="7%"><?php __('No.')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                       
                       <th><?php __('Big_category')?></th>
                       <th><?php echo $this->Paginator->sort($update,'modified');?></th>
                       <th><?php __('Tackle')?></th>
                       <th width="3%"><?php __('ID')?></th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                             <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1"><?php __('Select')?></option>
                                    <option value="active"><?php __('Active')?></option>
                                    <option value="notactive"><?php __('Cancel_Active')?></option>
                                    <option value="delete"><?php __('Delete')?></option>
                                </select>
                                <a class="button" href="#" onclick="document.form1.submit();"><?php __('Implement')?></a>
                            </div>
                             <div class="pagination">
                                <a href="#" title="First Page">
                                   <?php
                                        $paginator->options(array('url' => $this->passedArgs));
                                       echo "&laquo "; echo $paginator->prev($back);
							       ?> 
                                </a>
							     <?php 
								   echo $paginator->numbers();
                                   echo $paginator->next($next); echo "&raquo";
                                ?>
                              </div>
                            </div> 
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php 
				   // pr($product);die;
				   foreach ($product as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Product']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a href="<?php echo DOMAINADESTORE?>products/edit/<?php echo $value['Product']['id'] ?>" title="Edit"><?php echo $value['Product']['title']; ?></a></td>
           
                        <td>
                        <?php  //echo $value['Catproduct']['name'];?>
                            <?php if(is_array($value['Catproduct']) and !empty($value['Catproduct'])) { echo $value['Catproduct']['name'];}?>
							<?php if(is_array($value['Catproduct']) and empty($value['Catproduct'])) { echo "Null";}?>
                        </td>
                        <td><?php echo date('d-m-Y', strtotime($value['Product']['created'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINADESTORE?>products/edit/<?php echo $value['Product']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>products/delete/<?php echo $value['Product']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a>
                        <?php 
							if($value['Product']['status']==0)
							{
						?>
                             <a href="<?php echo DOMAINADESTORE?>products/active/<?php echo $value['Product']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        <?php 
							}else 
							{
						?>
                            <a href="<?php echo DOMAINADESTORE?>products/close/<?php echo $value['Product']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        <?php 
							}
						?>
                        </td>
                        <td align="right"><?php echo $value['Product']['id'];?></td>
                    </tr>
                   <?php }?>
                </tbody>
                </form>
            </table>
        </div> <!-- End #tab1 -->
        <!-- End #tab2 -->        
    </div> <!-- End .content-box-content -->
 </div>
