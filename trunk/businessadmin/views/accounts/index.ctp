<?php echo $form->create(null, array( 'url' => DOMAINAD.'accounts/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINAD?>accounts/add" class="toolbar">
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
                            <a href="<?php echo DOMAINAD?>home" class="toolbar">
                                <span class="icon-32-unpublish"></span>
                                <?php __('Close')?>
                            </a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('Account')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="name" class="text-input"></td>


                    <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('List')?></a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th><?php __('No.')?></th>
                       <th><?php __('Username')?></th>
                       <th><?php __('Email')?></th>
                       <th><?php __('Creat_date')?></th>
                       <th><?php __('Tackle')?></th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  foreach ($users as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $value['User']['name'];?></td>
                        <td><?php  echo $value['User']['email'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['User']['created'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINADBUSINISS?>accounts/edit_pass/<?php echo $value['User']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADBUSINISS?>accounts/delete/<?php echo $value['User']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
        </div> <!-- End #tab1 -->
        <!-- End #tab2 -->        
    </div> <!-- End .content-box-content -->
 </div>
<?php echo $form->end(); ?>