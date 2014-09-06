<?php 
$edit = $this->advertisementsedit($id);
if($edit['Estore_advertisements']['display']==0)
{ 
   $display ='Advertisement_running_in_the_left';
}elseif ( $edit['Estore_advertisements']['display']==1)
  { 
  	$display = 'Advertisement_running_in_the_right';
  }elseif ($edit['Estore_advertisements']['display']==2){
      $display = 'Advertisement_in_the_left';
  }elseif ($edit['Estore_advertisements']['display']==3){
		$display = 'Advertisement_in_the_right'; }
				
  if($edit['Estore_advertisements']['status']==1){ $check = 'checked="checked" ';} else { $check ='';}
  
  if($edit['Estore_advertisements']['status']==0){ $check2= 'checked="checked" ';}else {$check2 ='';}
		
$string ='';
$string .='<form action="'.DOMAIN.$shopname.'"/advertisementsedit" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class="form form-horizontal validate-form" style="margin-bottom: 0;">';
$string .='<input type="hidden" name="_method" value="POST" />
					                        <input type="hidden" name="data[Estore_advertisements][id]" value="'. pr($edit['Estore_advertisements']['id']).'" />
					                        <div class="form-group">
					                          <label class="control-label col-sm-3 col-sm-3" for="validation_name">Image_name</label>
					                          <div class="col-sm-4 controls">
					                           <input class="form-control" value="'.pr($edit['Estore_advertisements']['name']).'" data-rule-minlength="2" data-rule-required="true" id="validation_name" name="data[Estore_advertisements][name]" placeholder="Image_name" type="text">
					                          </div>
					                        </div>   
					                        <div class="form-group">
					                          <label class="control-label col-sm-3 col-sm-3" for="validation_name">Website_name</label>
					                          <div class="col-sm-4 controls">
					                            <input class="form-control" value="'. pr($edit['Estore_advertisements']['link']).'" data-rule-minlength="2" data-rule-required="true" id="validation_name1" name="data[Estore_advertisements][link]" placeholder="Website_name" type="text">
					                          </div>
					                        </div> 
					                         <div class="form-group">
					                          <label class="control-label col-sm-3" for="validation_password">Image</label>
					                          <div>
					                        <div class=" input-group col-sm-4 controls" >
					                          <input class="form-control" value="'. pr($edit['Estore_advertisements']['images']).'" readonly="readonly" name="userfile" placeholder="Image" type="text">
					                          <span class="input-group-addon " style="padding:0px">
					                            <span>
					                            <a href="javascript:window.open("'. pr(DOMAINADESTORE).'upslide.php","userfile","width=500,height=300");window.history.go(1)" >
					                            <input class="btn btn-success" style="padding: 5px;"  value="Select_image" type="button">
					                            </a>
					                            </span>
					                          </span>
					                        </div>
					                      </div>
					                        </div> 
					                        <div class="form-group">
					                        <label class="col-sm-3 col-sm-3 control-label">Current_location:</label>
					                        <div class="col-sm-4 controls">
					                          <div class="radio">
					                            <label>'.pr($display).'</label>
					                          </div>                      
					                        </div>
					                      </div>                 
					                         <div class="form-group">
					                        <label class="col-sm-3 col-sm-3 control-label">Alternate_location:</label>
					                        <div class="col-sm-4 controls">
					                          <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="0">
					                              Advertisement_running_in_the_left
					                            </label>
					                          </div>
					                          <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="1">
					                                Advertisement_running_in_the_right
					                            </label>
					                          </div>
					                          <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="2">
					                              Advertisement_in_the_left
					                            </label>
					                          </div>
					                           <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="3">
					                               Advertisement_in_the_right
					                            </label>
					                          </div>
					                        </div>
					                      </div>                 
					                        <div class="form-group">
					                        <label class="control-label col-sm-3" for="validation_select">Status</label>
					                        <div class="col-sm-4 controls">
					                          <label class="radio radio-inline">
					                            <input  name="data[Estore_advertisements][status]" type="radio" value="1"  '. pr($check) .'/>
					                            Actived
					                          </label>
					                          <label class="radio radio-inline">
					                            <input  name="data[Estore_advertisements][status]" type="radio" value="0" '. pr($check2).'/>';
					                 $string .= ' /> Unactive
					                          </label>
					                          </div>
					                      </div>                                      
					                       <div class="form-actions" style="margin-bottom:0">
					                          <div class="row">
					                            <div class="col-sm-9 col-sm-offset-3">
					                              <button class="btn btn-primary" type="submit" value="Save" >
					                                <i class="icon-save"></i>
					                                 Save
					                              </button>
					                               </div>
					                          </div>
					                        </div>
					                        
					                      </form> ';   
					                      
		?>

		
		
		$string ='';
	$string .='<form action="'.DOMAIN.$this->shopname.'"/advertisementsedit" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class="form form-horizontal validate-form" style="margin-bottom: 0;">';
	$string .='<input type="hidden" name="_method" value="POST" />
					                        <input type="hidden" name="data[Estore_advertisements][id]" value="'. $id.'" />
					                        <div class="form-group">
					                          <label class="control-label col-sm-3 col-sm-3" for="validation_name">Image_name</label>
					                          <div class="col-sm-4 controls">
					                           <input class="form-control" value="'.$name.'" data-rule-minlength="2" data-rule-required="true" id="validation_name" name="data[Estore_advertisements][name]" placeholder="Image_name" type="text">
					                          </div>
					                        </div>
					                        <div class="form-group">
					                          <label class="control-label col-sm-3 col-sm-3" for="validation_name">Website_name</label>
					                          <div class="col-sm-4 controls">
					                            <input class="form-control" value="'. $link.'" data-rule-minlength="2" data-rule-required="true" id="validation_name1" name="data[Estore_advertisements][link]" placeholder="Website_name" type="text">
					                          </div>
					                        </div>
					                         <div class="form-group">
					                          <label class="control-label col-sm-3" for="validation_password">Image</label>
					                          <div>
					                        <div class=" input-group col-sm-4 controls" >
					                          <input class="form-control" value="'. $images.'" readonly="readonly" name="userfile" placeholder="Image" type="text">
					                          <span class="input-group-addon " style="padding:0px">
					                            <span>
					            
					                            <a href="javascript:window.open('. $urlupload.',"userfile","width=500,height=300");window.history.go(1);" >
					                            <input class="btn btn-success" style="padding: 5px;"  value="Select_image" type="button">
					                            </a>
					                            </span>
					                          </span>
					                        </div>
					                      </div>
					                        </div>
					                        <div class="form-group">
					                        <label class="col-sm-3 col-sm-3 control-label">Current_location:</label>
					                        <div class="col-sm-4 controls">
					                          <div class="radio">
					                            <label>'.$display.'</label>
					                          </div>
					                        </div>
					                      </div>
					                         <div class="form-group">
					                        <label class="col-sm-3 col-sm-3 control-label">Alternate_location:</label>
					                        <div class="col-sm-4 controls">
					                          <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="0">
					                              Advertisement_running_in_the_left
					                            </label>
					                          </div>
					                          <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="1">
					                                Advertisement_running_in_the_right
					                            </label>
					                          </div>
					                          <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="2">
					                              Advertisement_in_the_left
					                            </label>
					                          </div>
					                           <div class="radio">
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type="radio" value="3">
					                               Advertisement_in_the_right
					                            </label>
					                          </div>
					                        </div>
					                      </div>
					                        <div class="form-group">
					                        <label class="control-label col-sm-3" for="validation_select">Status</label>
					                        <div class="col-sm-4 controls">
					                          <label class="radio radio-inline">
					                            <input  name="data[Estore_advertisements][status]" type="radio" value="1"  '. $check .'/>
					                            Actived
					                          </label>
					                          <label class="radio radio-inline">
					                            <input  name="data[Estore_advertisements][status]" type="radio" value="0" '. $check2.'/>';
	$string .= ' /> Unactive
					                          </label>
					                          </div>
					                      </div>
					                       <div class="form-actions" style="margin-bottom:0">
					                          <div class="row">
					                            <div class="col-sm-9 col-sm-offset-3">
					                              <button class="btn btn-primary" type="submit" value="Save" >
					                                <i class="icon-save"></i>
					                                 Save
					                              </button>
					                               </div>
					                          </div>
					                        </div>
					          
					                      </form> ';