<?php
// echo "view Eshopvccvcv";
$eshop = $this->Session->read ( 'eshop' );
// pr($eshop);
// die;

?>
<?php  pr($Langgue);die;?>


<div id="coverPage" class="normal">


	<div id="page">
		<div id="header">
			<span id="logo"></span>
			<div id="headerContent" class="fullSize">
				<h1>Registration Wizard</h1>
			</div>
		</div>
		<hr class="hidden" />
		<div id="content">
			<div id="leftColumn">
				<div id="stepInfo1" class="stepInfo actual">
					<h3>Step 1</h3>
					<div>Enter project details</div>
				</div>
				<div id="stepInfo2" class="stepInfo">
					<h3>Step 2</h3>
					<div>Choose your template</div>
				</div>
				<div id="stepInfo3" class="stepInfo last">
					<h3>Step 3</h3>
					<div>Finish the registration</div>
				</div>
			</div>
			<div id="rightContent">
				<div id="stepArea1" class="stepArea selectedStep">
					<div id="modulesSelect3" class="modulesSelect">
						<h3>Select a website type</h3>
						<div id="modulesSelectErrorMsg">
							<!-- -->
						</div>
						<div id="moduleAreaweb" class="moduleBlock">
							<i class="unitPng"> <!-- -->
							</i><input type="radio" name="moduleType" class="moduleKey"
								id="moduleKeyweb" value="web" /><label for="moduleKeyweb">Personal website</label>
							<div class="cleaner">
								<!-- -->
							</div>
							<p>Suitable for personal websites, blogs and photo sharing etc.</p>
						</div>
						<div id="moduleAreabranch" class="moduleBlock">
							<i class="unitPng"> <!-- -->
							</i><input type="radio" name="moduleType" class="moduleKey"
								id="moduleKeybranch" value="branch" /><label
								for="moduleKeybranch">Business website</label>
							<div class="cleaner">
								<!-- -->
							</div>
							<p>Ideal for business large or small, hundreds of professional designs.</p>
						</div>
						<div id="moduleAreaeshop" class="moduleBlock">
							<i class="unitPng"> <!-- -->
							</i><input type="radio" name="moduleType" class="moduleKey"
								id="moduleKeyeshop" value="eshop" /><label for="moduleKeyeshop">E-shop</label>
							<div class="cleaner">
								<!-- -->
							</div>
							<p>Get ahead by selling and managing your products and services
								on-line.</p>
						</div>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
					<form id="step1WizardForm" name="step1WizardForm" action="<?php echo DOMAIN ?>launch-your-site-step2" method="post"
						<?php //onsubmit="Forms.showWaitingAnimation();return Wizard.process();" ?>
						style="display: none;" enctype="application/x-www-form-urlencoded">
						<input type="hidden" id="action" name="action" value="<?php echo DOMAIN ?>launch-your-site-step2">
						<p class="errorFormList" id="step1WizardFormErrorText"
							style="display: none;">The form contains errors. Please alter the
							highlighted fields and send the form again.</p>
						<fieldset id="step1BaseInfo" class=" withoutSeparator">
							<div id="step1BaseInfoBlockContent">
								<div class="formRow" id="project_nameRow">
									<label for="project_name"><strong>Website name</strong></label><span
										class="inputCase"><input type="text" id="project_name"
										name="project_name"
										value="<?php echo $this->Session->read('eshop.storename'); //if(is_array($eshop) and !empty($eshop)) { echo $eshop['storename'];} ?>"
										_required="required" /><i> <!-- -->
									</i></span>
									<div class="formRowNotice">E.g. "Anna's Hairdressing"</div>
									<div class="inputHint" id="project_nameHint">
										<h4>Website name</h4>
										<p>This form entry should contain the name of your website.</p>
										<i class="hintEnd"> <!-- -->
										</i>
									</div>
								</div>
								<div class="formRow" id="company_sloganRow">
									<label for="company_slogan">Slogan</label> <span
										class="inputCase"> <input type="text" id="company_slogan"
										name="company_slogan" value="" /> <i>
											<!-- -->
									</i>
									</span>
									<div class="inputHint" id="company_sloganHint">
										<h4>Slogan</h4>
										<p>You can create a catchphrase for your website.</p>
										<i class="hintEnd"> <!-- -->
										</i>
									</div>
								</div>
								
								<div class="formRow" id="languageRow">
									<label for="language"><strong>Language</strong></label>
									<div class="selectCase"> 
										<input type="hidden" id="language" name="language" value="" required="required" _type="text" />
										<input type="text" id="languageText" name="languageText"  class="selectText" value="" />
										<b> <!-- readonly="readonly"  --></b>
										<i> <!-- --></i>
 									</div> <!--  class="selectCase  -->
									<div class="inputHint" id="languageHint">
										<h4>Language</h4>
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
					<div class="cleaner">
						<!-- -->
					</div>
				</div>
				<div id="stepArea2" class="stepArea">
				<form id="step2WizardForm" action="" method="post"
						<?php //onsubmit="Forms.showWaitingAnimation();return Wizard.process();" ?>
						enctype="application/x-www-form-urlencoded">
					<div id="layoutArea">
						<h2>Select your website template</h2>
						<div id="layoutsTools">
							<!-- -->
						</div>
						<div class="cleaner">
							<!-- -->
						</div>
						<div id="layoutsErrorMsg">
							<!-- -->
						</div>
						<div id="layoutsList">
							<!-- -->
						</div>
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
					<form id="step3WizardForm" action="" method="post"
						<?php //onsubmit="Forms.showWaitingAnimation();return Wizard.process();" ?>
						enctype="application/x-www-form-urlencoded">
						<p class="errorFormList" id="step3WizardFormErrorText"
							style="display: none;">The form contains errors. Please alter the
							highlighted fields and send the form again.</p>
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
									<label for="contact_name"><strong>Company name</strong></label><span
										class="inputCase"><input type="text" id="contact_name"
										name="contact_name" value="" _required="required" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_streetRow">
									<label for="contact_street">Address</label><span
										class="inputCase"><input type="text" id="contact_street"
										name="contact_street" value="" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_cityRow">
									<label for="contact_city">City</label><span class="inputCase"><input
										type="text" id="contact_city" name="contact_city" value="" /><i>
											<!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_zipRow">
									<label for="contact_zip">ZIP</label><span class="inputCase"><input
										type="text" id="contact_zip" name="contact_zip" value="" /><i>
											<!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_countryRow">
									<label for="contact_country">Country</label>
									<div class="selectCase">
										<input type="hidden" id="contact_country"
											name="contact_country" value="vn" _type="text" /><input
											readonly="readonly" type="text" id="contact_countryText"
											class="selectText" value="" /><b> <!-- -->
										</b><i> <!-- -->
										</i>
									</div>
								</div>
								<div class="formRow" id="contact_stateRow"
									style="display: none;">
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
									<label for="contact_tel">Phone</label><span class="inputCase"><input
										type="text" id="contact_tel" name="contact_tel" value="" /><i>
											<!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_emailRow">
									<label for="contact_email">Email</label><span class="inputCase"><input
										type="text" id="contact_email" name="contact_email"
										value="gstearmit@gmail.com" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="contact_icRow">
									<label for="contact_ic">VAT number</label><span
										class="inputCase"><input type="text" id="contact_ic"
										name="contact_ic" value="" /><i> <!-- -->
									</i></span>
								</div>
								<div class="formRow" id="currency_idRow" style="display: none;">
									<label for="currency_id">Currency</label>
									<div class="selectCase">
										<input type="hidden" id="currency_id" name="currency_id"
											value="" _type="text" /><input readonly="readonly"
											type="text" id="currency_idText" class="selectText" value="" /><b>
											<!-- -->
										</b><i> <!-- -->
										</i>
									</div>
								</div>
								<div class="formRow" id="taxesRow" style="display: none;">
									<label for="taxes">VAT payer</label>
									<div class="radioSet">
										<span id="taxesRadio1Wrapper" class="radioWrapper"><input
											type="radio" name="taxes" value="yes" id="taxesRadio1"
											checked="checked" />&nbsp;<label for="taxesRadio1"
											class="radioLabel">Yes</label></span><span
											id="taxesRadio2Wrapper" class="radioWrapper"> &nbsp; <input
											type="radio" name="taxes" value="no" id="taxesRadio2" />&nbsp;<label
											for="taxesRadio2" class="radioLabel">No</label></span>
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
							<button id="nextButton" type="submit"
								onclick="return validateStep2()">
								<b>Continue</b>
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
			<p id="footerCopyrights">&copy; 2014 alatca. All rights reserved.</p>
		</div>
	</div>
</div>
<!-- id="coverPage" class="normal -->


