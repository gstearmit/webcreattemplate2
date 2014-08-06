
<script type="text/javascript">
function showWaitingAnimation()
{
	alert("wattting");
}
function processstep1()
{
	alert("processstep1");
}

function processstep2()
{
	alert("processstep2");
}

function Finish()
{
	alert("processstep2");//return 0;
}

</script>


<?php
$eshop = $this->Session->read ( 'eshop' );
?>
<?php // pr($Langgue);die;?>


<div id="coverPage" class="normal">


	<div id="page">
	<div class="container">
	<div class="row">
		<div id="header" class="col-xs-12 ">
			<span id="logo"><img src="../img/layout3-1/AlatcaLogo2.png"/></span>
			<div id="headerContent" class="fullSize col-xs-6 col-md-4">
				<h1><?php __('registrationWizard') ?></h1>
			</div>
		</div>
		</div>
		</div>
		<hr class="hidden" />
		<div id="content">
			<div id="leftColumn">
				<div id="stepInfo1" class="stepInfo actual">
					<h3><?php __('Step1') ?></h3>
					<div><?php __('Enterprojectdetails') ?></div>
				</div>
				<div id="stepInfo2" class="stepInfo">
					<h3><?php __('Step2') ?></h3>
					<div><?php __('Chooseyourtemplate') ?></div>
				</div>
				<div id="stepInfo3" class="stepInfo last">
					<h3><?php __('Step3') ?></h3>
					<div><?php __('Finishtheregistration') ?></div>
				</div>
			</div>
			<div id="rightContent">
				<div id="stepArea1" class="stepArea selectedStep">
					<div id="modulesSelect3" class="modulesSelect">
						<h3><?php __('Selectawebsitetype') ?></h3>
						<div id="modulesSelectErrorMsg">
							<!-- -->
						</div>
						<div id="moduleAreaweb" class="moduleBlock">
							<i class="unitPng"> <!-- -->
							</i><input type="radio" name="moduleType" class="moduleKey"
								id="moduleKeyweb" value="web" /><label for="moduleKeyweb"><?php __('Personalwebsite') ?></label>
							<div class="cleaner">
								<!-- -->
							</div>
							<p><?php __('Personalwebsite_detail') ?>.</p>
						</div>
						<div id="moduleAreabranch" class="moduleBlock">
							<i class="unitPng"> <!-- -->
							</i>
							<input type="radio" name="moduleType" class="moduleKey"
								id="moduleKeybranch" value="branch" /><label
								for="moduleKeybranch"><?php __('Businesswebsite') ?></label>
							<div class="cleaner">
								<!-- -->
							</div>
							<p><?php __('Businesswebsite_detail') ?></p>
						</div>
						<div id="moduleAreaeshop" class="moduleBlock">
							<i class="unitPng"> <!-- -->
							</i><input type="radio" name="moduleType" class="moduleKey"
								id="moduleKeyeshop" value="eshop" /><label for="moduleKeyeshop"><?php __('Eshop') ?></label>
							<div class="cleaner">
								<!-- -->
							</div>
							<p><?php __('Eshop_detail') ?></p>
						</div>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
					<form id="step1WizardForm" name="step1WizardForm" action="<?php //echo DOMAIN ?>launch-your-site-step2" method="post" onsubmit="Forms.showWaitingAnimation();return Wizard.process();" style="display: none;" enctype="application/x-www-form-urlencoded">
						<input type="hidden" id="action" name="action" value="<?php echo DOMAIN ?>launch-your-site-step2">
						<p class="errorFormList" id="step1WizardFormErrorText" style="display: none;"><?php __('step1WizardFormErrorText');?></p>
						<fieldset id="step1BaseInfo" class=" withoutSeparator">
							<div id="step1BaseInfoBlockContent">
								<div class="formRow" id="project_nameRow">
									<label for="project_name"><strong><?php __('Websitename');?></strong></label><span
										class="inputCase"><input type="text" id="project_name"
										name="project_name"
										value="<?php echo $this->Session->read('eshop.storename'); //if(is_array($eshop) and !empty($eshop)) { echo $eshop['storename'];} ?>"
										_required="required" /><i> <!-- -->
									</i></span>
									<div class="formRowNotice"><?php __('eg_websitename');?>"</div>
									<div class="inputHint" id="project_nameHint">
										<h4><?php __('Websitename');?></h4>
										<p><?php __('Websitename_click');?></p>
										<i class="hintEnd"> <!-- -->
										</i>
									</div>
								</div>
								<div class="formRow" id="company_sloganRow">
									<label for="company_slogan"><?php __('Slogan');?></label> <span
										class="inputCase"> <input type="text" id="company_slogan"
										name="company_slogan" value="" /> <i>
											<!-- -->
									</i>
									</span>
									<div class="inputHint" id="company_sloganHint">
										<h4><?php __('Slogan');?></h4>
										<p><?php __('Slogan_click')?></p>
										<i class="hintEnd"> <!-- -->
										</i>
									</div>
								</div>
								
								<div class="formRow" id="languageRow">
									<label for="language"><strong><?php __('Language');?></strong></label>
									   
											<select class="selectCase hand form-control input-lg " name ="langgueNew" id ="langgueNew">
											<?php foreach ($Langgue as $key =>$langgue) :// pr($langgue['Langgues']);	?>
											<?php  if(is_array($langgue['Langgues']) and !empty($langgue['Langgues'])) : ?>
									          <option  value="<?php echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" ><?php echo $langgue['Langgues']['namecountry'];?></option>
									          <?php    endif;?>
									            <?php    endforeach; ?>
									        </select>
							         
												      <div class="selectCase hand phucrt"> 
														 <?php foreach ($Langgue as $key =>$langgue) : // pr($langgue['Langgues']); ?>
														     <?php  if(is_array($langgue['Langgues']) and !empty($langgue['Langgues'])) : ?>
															<input type="hidden" id="language" name="language" value="<?php echo $langgue['Langgues']['countrycode'] ?>" required="required" _type="text" />
															<input type="text" readonly="readonly" id="languageText" name="languageText"  class="selectText hand" value="<?php //echo $langgue['Langgues']['namecountry'];?>" />
														  <?php    endif;?>
														  <?php   endforeach;?>
															<b> <!-- readonly="readonly"  --></b>
															<i> <!-- --></i>
					 									</div> <!--  class="selectCase  -->
							    
									<div class="inputHint" id="languageHint">
										<h4><?php __('Language');?></h4>
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
										</i><a href="#" id="branch_typeShowAll" class="selectShowAll">View all</a>
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
							<?php 
/*
										       * ?> <div id="wizardButtons"> <div class="buttonToRight"> <span id="nextButtonBlock" class="buttonCase"> <u style="position:absolute;top:0;left:0;width:127px;height:42px;z-index:10;background:#fff;filter: alpha(opacity=0);opacity: 0;"></u> <button id="nextButton" type="submit" onclick="return validateStep2()"><b><cufon class="cufon cufon-canvas" alt="Continue" style="width: 102px; height: 26px;"><canvas width="119" height="31" style="width: 119px; height: 31px; top: -4px; left: -3px;"></canvas><cufontext>Continue</cufontext></cufon></b></button> <cufon class="cufon cufon-canvas" alt=" " style="width: 3px; height: 12px;"><canvas width="16" height="14" style="width: 16px; height: 14px; top: -1px; left: -1px;"></canvas><cufontext> </cufontext></cufon> <i><!-- --></i> </span> </div> <div class="cleaner"> <!-- --> </div> </div>
										       */
							?>				
						</form>
					<div class="cleaner">
						<!-- -->
					</div>
				</div>
				<div id="stepArea2" class="stepArea">
				<form id="step2WizardForm" action="" name"step2WizardForm" method="post" onsubmit="return processstep2();" enctype="application/x-www-form-urlencoded"><!-- step2WizardForm.showWaitingAnimation(); -->
					<div id="layoutArea">
						<h2><?php __('Selectyourwebsitetemplate')?></h2>
						<div id="layoutsTools">
							<!-- -->
						</div>
						<div class="cleaner">
							<!-- -->
						</div>
						<div id="layoutsErrorMsg">
							<!-- -->
						</div>
                        <?php /* ?>
                        
						<div id="layoutsListtow"><!--  -->
							<span class="layoutItem" id="layoutItem9999">
							<i
								class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50015010-a9cfaaa4c8-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout9999"
								name="layout" type="radio" value="9999" title="Select template"><label
								for="layout9999">Bega Theme</label></span>
						   <span
								class="layoutItem" id="layoutItem50000998"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50024577-6e6f56e74d-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50000998"
								name="layout" type="radio" value="50000998" title="Select template"><label
								for="layout50000998">Select template</label></span>
							<span
								class="layoutItem" id="layoutItem50001035"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50024687-e3e2ae3e81-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50001035"
								name="layout" type="radio" value="50001035" title="Select template"><label
								for="layout50001035">Select template</label></span><span
								class="layoutItem" id="layoutItem50001003"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50024602-0101101061-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50001003"
								name="layout" type="radio" value="50001003" title="Select template"><label
								for="layout50001003">Select template</label></span><span
								class="layoutItem" id="layoutItem50000545"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50019077-9aea59b673-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50000545"
								name="layout" type="radio" value="50000545" title="Select template"><label
								for="layout50000545">Select template</label></span><span
								class="layoutItem" id="layoutItem50001016"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50025021-35c2635c76-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50001016"
								name="layout" type="radio" value="50001016" title="Select template"><label
								for="layout50001016">Select template</label></span><span
								class="layoutItem" id="layoutItem50000113"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50014920-4736247b30-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50000113"
								name="layout" type="radio" value="50000113" title="Select template"><label
								for="layout50000113">Select template</label></span><span
								class="layoutItem" id="layoutItem50001120"><i class="lid">
									<!-- -->
							</i><img
								src="http://static-cdn4.webnode.com/_system/_filesystem/_skins/50024757-405d44062b-rubicus.jpg"
								height="134" width="149" alt="" border="0"><input id="layout50001120"
								name="layout" type="radio" value="50001120" title="Select template"><label
								for="layout50001120">Select template</label></span>
						</div><!-- end id="layoutsListtow" -->
						*/?>
						
						<?php ?>
						<div id="layoutsList">
							<!-- -->
						</div>
						<?php ?>
						
						<div id="layoutAreaEnd">
							<!-- -->
						</div>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
				</form>
				</div>
				<div id="stepArea3" class="stepArea">
					<form id="step3WizardForm" action="" method="post" name ="step3WizardForm"
						<?php //onsubmit="Forms.showWaitingAnimation();return Wizard.process();" ?>
						enctype="application/x-www-form-urlencoded">
						<p class="errorFormList" id="step3WizardFormErrorText" style="display: none;"><?php __('step1WizardFormErrorText')?></p>
						<fieldset id="step3Description">
							<h2>
								<!-- -->
							</h2>
							<div class="formGroupDesc">
								<!-- -->
							</div>
							<div id="step3DescriptionBlockContent"></div>
						</fieldset>
						<fieldset id="step3PagesInfo" class=" withoutSeparator">
							<div id="step3PagesInfoBlockContent"></div>
						</fieldset>
						<fieldset id="step3ContactForm" class=" withoutSeparator">
							<div id="step3ContactFormBlockContent">
								<div class="formRow" id="contact_nameRow">
									<label for="contact_name"><strong><?php __('Companyname');?></strong></label><span
										class="inputCase"><input type="text" id="contact_name"
										name="contact_name" value="" _required="required" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_streetRow">
									<label for="contact_street"><?php __('Address');?></label><span
										class="inputCase"><input type="text" id="contact_street"
										name="contact_street" value="" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_cityRow">
									<label for="contact_city"><?php __('City')?></label><span class="inputCase"><input
										type="text" id="contact_city" name="contact_city" value="" /><i>
											<!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_zipRow">
									<label for="contact_zip"><?php __('ZIP');?></label><span class="inputCase"><input
										type="text" id="contact_zip" name="contact_zip" value="" /><i>
											<!-- -->
									</i></span>
								</div>
								
								<div class="formRow" id="contact_countryRow">
									<label for="contact_country"><?php __('Country');?></label>
										<select class="selectCase hand form-control input-lg " name ="countryNew" id ="countryNew">
											<?php foreach ($Langgue as $key =>$langgue) :// pr($langgue['Langgues']);	?>
											<?php  if(is_array($langgue['Langgues']) and !empty($langgue['Langgues'])) : ?>
									          <option  value="<?php echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" ><?php echo $langgue['Langgues']['namecountry'];?></option>
									          <?php    endif;?>
									            <?php    endforeach; ?>
									    </select>
									
									<div class="selectCase hand phucrt ">
										<input type="hidden" id="contact_country"
											name="contact_country" value="vn" _type="text" /><input
											readonly="readonly" type="text" id="contact_countryText"
											class="selectText" value="" /><b> <!-- -->
										</b><i> <!-- -->
										</i>
									</div>
									
									
									
								</div>
								
								
								<div class="formRow" id="contact_stateRow" style="display: none;">
									<label for="contact_state">Select a state</label>
									<div class="selectCase">
										<input type="hidden" id="contact_state" name="contact_state"
											value="" _type="text" /><input readonly="readonly"
											type="text" id="contact_stateText" class="selectText"
											value="" /><b> <!-- -->
										</b><i> <!-- -->
										</i>
									</div>
								</div>
								<div class="formRow" id="contact_telRow">
									<label for="contact_tel"><?php __('Phone');?></label><span class="inputCase"><input
										type="text" id="contact_tel" name="contact_tel" value="" /><i>
											<!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_emailRow">
									<label for="contact_email">Email</label><span class="inputCase">
									<input type="text" id="contact_email" name="contact_email" value="" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_icRow">
									<label for="contact_ic"><?php __('VAT_number');?></label><span
										class="inputCase"><input type="text" id="contact_ic"
										name="contact_ic" value="" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="currency_idRow" style="display: none;">
									<label for="currency_id"><?php __('Currency');?></label>
									<select class="selectCase hand form-control input-lg " name ="currency" id ="currency">
											<?php //foreach ($Langgue as $key =>$langgue) :// pr($langgue['Langgues']);	?>
											<?php  //if(is_array($langgue['Langgues']) and !empty($langgue['Langgues'])) : ?>
									          <option  value="VI DONG<?php //echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" >VI DONG<?php //echo $langgue['Langgues']['namecountry'];?></option>
									          <option  value="NND<?php //echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" >NND<?php //echo $langgue['Langgues']['namecountry'];?></option>
									          <option  value="$VN<?php //echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" >SSJSJSJ<?php //echo $langgue['Langgues']['namecountry'];?></option>
									         
									          <?php    //endif;?>
									            <?php    //endforeach; ?>
									</select>
									    
									<div class="selectCase hand phucrt ">
										<input type="hidden" id="currency_id" name="currency_id"
											value="" _type="text" /><input readonly="readonly"
											type="text" id="currency_idText" class="selectText" value="" /><b>
											<!-- -->
										</b><i> <!-- -->
										</i>
									</div>
									
									
									
								</div>
								<div class="formRow" id="taxesRow" style="display: none;">
									<label for="taxes"><?php __('VAT_payer');?></label>
									<div class="radioSet">
										<span id="taxesRadio1Wrapper" class="radioWrapper">
										<input type="radio" id="taxes" name="taxes" value="yes" id="taxesRadio1" checked="checked" />&nbsp;
										<label for="taxesRadio1" class="radioLabel">Yes</label>
										</span>
										<span id="taxesRadio2Wrapper" class="radioWrapper"> &nbsp;
										 <input type="radio" id="taxes" name="taxes" value="no" id="taxesRadio2" />&nbsp;
										 <label for="taxesRadio2" class="radioLabel">No</label>
										 </span>
									</div>
									<div class="cleaner">
										<!-- -->
									</div>
								</div>
							</div>
						</fieldset>
						<div class="cleaner">
							<!-- -->
						</div>
						<div class="formEnd">
							<!-- -->
						</div>
					</form>
					<div class="cleaner">
						<!-- -->
					</div>
				</div>
				<div id="wizardButtons">
					<div class="buttonToRight">
						<span id="nextButtonBlock" class="buttonCase">
							<button id="nextButton" type="submit" ><!-- onclick="return Finish()"  -->
								<b><?php __('Continue') ?></b>
							</button> <i> <!-- -->
						</i>
						</span>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
				</div>
				<!-- id="wizardButtons" -->
			</div>
			<div class="cleaner">
				<!-- -->
			</div>
		</div>
	</div>
	<!--  -->


	<hr class="hidden" />
	<div id="coverFooter">
		<div id="footer">
			<p id="footerCopyrights"><?php __('Allrightsreserved');?></p>
		</div>
	</div>
</div>
<!-- id="coverPage" class="normal -->



