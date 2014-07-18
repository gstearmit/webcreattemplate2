<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<link href="//fuelcdn.com/fuelux/2.3.1/css/fuelux.css" type="text/css" rel="stylesheet">
<link href="//fuelcdn.com/fuelux/2.3/css/fuelux-responsive.css">
<script type="text/javascript">
$('#MyWizard').on('change', function(e, data) {
	  console.log('change');
	  if(data.step===3 && data.direction==='next') {
	    // return e.preventDefault();
	  }
	});
	$('#MyWizard').on('changed', function(e, data) {
	  console.log('changed');
	});
	$('#MyWizard').on('finished', function(e, data) {
	  console.log('finished');
	});
	$('#btnWizardPrev').on('click', function() {
	  $('#MyWizard').wizard('previous');
	});
	$('#btnWizardNext').on('click', function() {
	  alert("klich nuet");
	  $('#MyWizard').wizard('next','foo');
	});
	$('#btnWizardStep').on('click', function() {
	  var item = $('#MyWizard').wizard('selectedItem');
	  console.log(item.step);
	});
	$('#MyWizard').on('stepclick', function(e, data) {
	  console.log('step' + data.step + ' clicked');
	  if(data.step===1) {
	    // return e.preventDefault();
	  }
	});

	// optionally navigate back to 2nd step
	$('#btnStep2').on('click', function(e, data) {
	  $('[data-target=#step2]').trigger("click");
	});



</script>


<?php
// echo "view Eshopvccvcv";
$eshop = $this->Session->read ( 'eshop' );
// pr($eshop);
// die;

?>
<?php // pr($Langgue);die;?>


<div id="coverPage" class="normal">

	<div id="page">
		<div id="header">
			<span id="logo"></span>
			<div id="headerContent" class="fullSize">
				<h1><?php __('registrationWizard') ?></h1>
			</div>
		</div>
		<?php //contend ?>
		<div class="well wizard-example">
		  <div id="MyWizard" class="wizard">
		    <ul class="steps">
		      <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Step 1<span class="chevron"></span></li>
		      <li data-target="#step2"><span class="badge">2</span>Step 2<span class="chevron"></span></li>
		      <li data-target="#step3"><span class="badge">3</span>Step 3<span class="chevron"></span></li>
		      <li data-target="#step4"><span class="badge">4</span>Step 4<span class="chevron"></span></li>
		      <li data-target="#step5"><span class="badge">5</span>Step 5<span class="chevron"></span></li>
		    </ul>
		    <div class="actions">
		      <button class="btn btn-mini btn-prev"> <i class="icon-arrow-left"></i>Prev</button>
		      <button class="btn btn-mini btn-next" data-last="Finish">Next<i class="icon-arrow-right"></i></button>
		    </div>
		  </div>
		  <div class="step-content">
		    <div class="step-pane active" id="step1">
		              <form id="step1WizardForm" name="step1WizardForm" action="<?php   //echo DOMAIN ?>launch-your-site-step2" method="post"
								onsubmit="return processstep1();"
								style="display: block;" enctype="application/x-www-form-urlencoded">
								<input type="hidden" id="action" name="action" value="<?php   echo DOMAIN ?>launch-your-site-step2">
								<p class="errorFormList" id="step1WizardFormErrorText" style="display: none;"><?php   __('step1WizardFormErrorText');?></p>
								<fieldset id="step1BaseInfo" class=" withoutSeparator">
									<div id="step1BaseInfoBlockContent">
										<div class="formRow" id="project_nameRow">
											<label for="project_name"><strong><?php   __('Websitename');?></strong></label><span
												class="inputCase"><input type="text" id="project_name"
												name="project_name"
												value="<?php   echo $this->Session->read('eshop.storename'); //if(is_array($eshop) and !empty($eshop)) { echo $eshop['storename'];} ?>"
												_required="required" /><i> <!-- -->
											</i></span>
											<div class="formRowNotice"><?php   __('eg_websitename');?>"</div>
											<div class="inputHint" id="project_nameHint">
												<h4><?php   __('Websitename');?></h4>
												<p><?php   __('Websitename_click');?></p>
												<i class="hintEnd"> <!-- -->
												</i>
											</div>
										</div>
										<div class="formRow" id="company_sloganRow">
											<label for="company_slogan"><?php   __('Slogan');?></label> <span
												class="inputCase"> <input type="text" id="company_slogan"
												name="company_slogan" value="" /> <i>
													<!-- -->
											</i>
											</span>
											<div class="inputHint" id="company_sloganHint">
												<h4><?php   __('Slogan');?></h4>
												<p><?php   __('Slogan_click')?></p>
												<i class="hintEnd"> <!-- -->
												</i>
											</div>
										</div>
										
										<div class="formRow" id="languageRow">
											<label for="language"><strong><?php   __('Language');?></strong></label>
											   
													<select class="selectCase hand form-control input-lg " name ="langgueNew" id ="langgueNew">
													<?php   foreach ($Langgue as $key =>$langgue) :// pr($langgue['Langgues']);	?>
													<?php    if(is_array($langgue['Langgues']) and !empty($langgue['Langgues'])) : ?>
											          <option  value="<?php   echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" ><?php   echo $langgue['Langgues']['namecountry'];?></option>
											          <?php      endif;?>
											            <?php      endforeach; ?>
											        </select>
									         
														      <div class="selectCase hand phucrt"> 
																 <?php   foreach ($Langgue as $key =>$langgue) : // pr($langgue['Langgues']); ?>
																     <?php    if(is_array($langgue['Langgues']) and !empty($langgue['Langgues'])) : ?>
																	<input type="hidden" id="language" name="language" value="<?php   echo $langgue['Langgues']['countrycode'] ?>" required="required" _type="text" />
																	<input type="text" readonly="readonly" id="languageText" name="languageText"  class="selectText hand" value="<?php   //echo $langgue['Langgues']['namecountry'];?>" />
																  <?php      endif;?>
																  <?php     endforeach;?>
																	<b> <!-- readonly="readonly"  --></b>
																	<i> <!-- --></i>
							 									</div> <!--  class="selectCase  -->
									    
											<div class="inputHint" id="languageHint">
												<h4><?php   __('Language');?></h4>
												<p>
													This is the website language that the public will view. If
													your language is not on the list, select Other and you can do
													a translation later. <strong>Required item.</strong>
												</p>
												<i class="hintEnd"> <!-- -->
												</i>
											</div>
										</div>
										<div class="formRow" id="branch_typeRow" style="display: none;">
											<label for="branch_type"><strong>Business category</strong></label>
											<div class="selectCase">
												<input type="hidden" id="branch_type" name="branch_type"
													value="" _required="required" _type="text" /><input
													readonly="readonly" type="text" id="branch_typeText"
													class="selectText" value="" /><i> <!-- -->
												</i><a href="#" id="branch_typeShowAll" class="selectShowAll">View
													all</a>
											</div>
											<div class="formRowNotice">E.g.: &quot;Hair Salon&quot; or
												&quot;Tax services&quot;</div>
										</div>
									</div>
								</fieldset>
								<div class="cleaner">
									<!-- -->
								</div>
								<div class="formEnd">
									<!-- -->
								</div>
								<button id="nextButtonRT" type="submit" style="display: none;"></button> 
								
									<?php   
		/*
												       * ?> <div id="wizardButtons"> <div class="buttonToRight"> <span id="nextButtonBlock" class="buttonCase"> <u style="position:absolute;top:0;left:0;width:127px;height:42px;z-index:10;background:#fff;filter: alpha(opacity=0);opacity: 0;"></u> <button id="nextButton" type="submit" onclick="return validateStep2()"><b><cufon class="cufon cufon-canvas" alt="Continue" style="width: 102px; height: 26px;"><canvas width="119" height="31" style="width: 119px; height: 31px; top: -4px; left: -3px;"></canvas><cufontext>Continue</cufontext></cufon></b></button> <cufon class="cufon cufon-canvas" alt=" " style="width: 3px; height: 12px;"><canvas width="16" height="14" style="width: 16px; height: 14px; top: -1px; left: -1px;"></canvas><cufontext> </cufontext></cufon> <i><!-- --></i> </span> </div> <div class="cleaner"> <!-- --> </div> </div>
												       */
									?>				
								</form>					
		    </div>
		    <div class="step-pane" id="step2"><h2>Step 2]</h2>Now you are at the 2nd step of this wizard example.<br></div>
		    <div class="step-pane" id="step3"><h2>Okay</h2>Now you are at the 3rd step of this wizard example.<br></div>
		    <div class="step-pane" id="step4"><h2>Almost Done.</h2>Now you are at the 4th step of this wizard example. Click 'Next' to finish up.</div>
		    <div class="step-pane" id="step5"><h2>Done!</h2>The wizard is complete. Pretty exciting stuff, eh?. <a href="#" id="btnStep2">Go back to step 2.</a></div>
		  </div>
		  <br>
		  <input type="button" class="btn" id="btnWizardPrev" value="Back">
		  <input type="button" class="btn btn-primary" id="btnWizardNext" value="Next">
		
		</div>
		<!-- /well -->
		
		<hr>
				

   </div>
	<hr class="hidden" />
	<div id="coverFooter">
		<div id="footer">
			<p id="footerCopyrights"><?php __('Allrightsreserved');?></p>
		</div>
	</div>
</div>
<!-- id="coverPage" class="normal -->



