<style>
.modal {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
z-index: 1040;
display: none;
overflow: auto;
overflow-y: scroll;
}
.fade {
opacity: 0;
-webkit-transition: opacity 0.15s linear;
transition: opacity 0.15s linear;
}
</style>

<script type="text/javascript">
function clickviewpopup()
{
	// var s2 = document.getElementsByClassName('fade').remove();
	 var s3= document.getElementsByClassName('modal fade selectWindow');
	 var   assignedTabName = document.getElementById("myModal").className='selectWindow';
	 // alert(assignedTabName);
}

function closepopup()
{  
	 var s34= document.getElementsByClassName('selectWindow');
	 var   assignedTabName23 = document.getElementById("myModal").className='modal fade selectWindow';
	 //alert(assignedTabName23);
}
function reply_click(clicked_id,clicked_innertext)
{
	//branch_typeText
	 var   assignedTabName23 = document.getElementById("myModal").className='modal fade selectWindow';
	 var   branch_typeText = document.getElementById("branch_typeText").value= clicked_innertext;
	
}
</script>
<style>
input#layoutdemo {margin-top: 10%;}
label#layoutdemolayout {margin-top: 9%;font-weight: bold;margin-left: 0%;}
.layoutItem label{top:152px;left:37px}

</style>

<?php
$eshop = $this->Session->read ( 'Eshop' );
if($shop_id !='')
{

$eshop = $this->requestAction ( 'comment/get_eshopView/' . $shop_id );
foreach ( $eshop as $key) {
	$shop_id = $key['Shop']['id'];
	$estorename  = $key['Shop']['name'];
	$userpass  = $key['Shop']['userpass'];
	$email  = $key['Shop']['email'];
}


}
?>
<?php // pr($Langgue);die;?>


<div id="coverPage" class="normal">


	<div id="page">
	
		<div id="header" class="col-xs-12 ">
			<a href="<?php echo DOMAIN ?>"><span id="logo"><img src="<?php echo DOMAIN ?>/webcreathtml/img/layout3-1/AlatcaLogo2.png" width="220"/></span></a>
			<div id="headerContent" >
				<h1><?php __('registrationWizard') ?></h1>
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
						<div id="moduleAreabranch" class="moduleBlock selected">
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
					<form id="step1WizardForm" name="step1WizardForm" action="" method="post" onsubmit="Forms.showWaitingAnimation();return Wizard.process();" style="display: none;" enctype="application/x-www-form-urlencoded">
						<input type="hidden" id="action" name="action" value="<?php echo DOMAIN ?>launch-your-site-step2">
						<p class="errorFormList" id="step1WizardFormErrorText" style="display: none;"><?php __('step1WizardFormErrorText');?></p>
						<fieldset id="step1BaseInfo" class=" withoutSeparator">
							<div id="step1BaseInfoBlockContent">
								<div class="formRow" id="project_nameRow">
								<label for="project_name"><strong><?php __('Websitename');?></strong></label><span
										class="inputCase"><input type="text" id="project_name"
										name="project_name"
										value="<?php echo $this->Session->read('Eshop.storename'); //if(is_array($eshop) and !empty($eshop)) { echo $eshop['storename'];} ?>"
										_required="required" /><i> <!-- -->
									</i></span>
								<?php 
								/*
									<label for="project_name"><strong><?php __('Websitename');?></strong></label>
									<span class="inputCase"> <input type="text" id="project_name" name="project_name" value="<?php echo $estorename; ?>"_required="required" /><i> <!-- --></i></span>
										<input type="hidden" id="userpass" name="userpass" value="<?php echo $userpass; ?>" />
									    <input type="hidden" id="shop_id" name="shop_id" value="<?php echo $shop_id; ?>" />
									     <input type="hidden" id="email" name="email" value="<?php echo $email; ?>" />
								*/ ?>	
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
								
							<div class="formRow" id="branch_typeRow">
							<label for="branch_type"><strong>Ngành nghề kinh doanh</strong></label>
							<div class="selectCase">
							<input type="hidden" id="branch_type" name="branch_type" value="" _required="required" _type="text">
							<input type="text" id="branch_typeText" class="selectText" value="">
							<i><!-- --></i>
							 
							<a href="#businissregister" id="showmenu" class="selectShowAll" data-toggle="modal" style="visibility: visible; right: -85px;" onclick="clickviewpopup()" >Xem tất cả</a>
							<div class="selectBox" style="width: 0px; display: none;">
							<a id="branch_typeSBILAW_OFFICE_NOTARY" href="#">Advokátní kancelář / Notář</a>
							<a id="branch_typeSBIARCHITECTURAL_FIRM" href="#">Architekt</a>
							<a id="branch_typeSBIAUTO_CAR_BODY_REPAIR_SHOP" href="#">Autoservis</a>
							<a id="branch_typeSBIDRIVING_SCHOOL" href="#">Autoškola</a>
							<a id="branch_typeSBIFASHION_CLOTHING_STORE" href="#">Butik / Obchod s oděvy</a>
							<a id="branch_typeSBIHOME_DECOR_ACCESSORIES" href="#">Bytové doplňky / domácí potřeby</a>
							<a id="branch_typeSBICATERING_SERVICES" href="#">Catering</a>
							<a id="branch_typeSBITRAVEL" href="#">Cestovní kancelář</a>
							<a id="branch_typeSBICHIROPRACTOR_OSTEOPATH" href="#">Chiropraktik / Osteopat</a>
							<a id="branch_typeSBIBREEDER" href="#">Chovatelská stanice / Chovatel</a><a id="branch_typeSBIBICYCLE_SHOP" href="#">Cykloservis / Prodej jízdních kol</a><a id="branch_typeSBIFAITH_BASED_ORGANIZATIONS" href="#">Církevní organizace</a><a id="branch_typeSBIACCOUNTANT_TAX_SERVICES" href="#">Daňové poradenství</a><a id="branch_typeSBIINTERIOR_DESIGN_RENOVATIONS" href="#">Design a renovace interiérů</a><a id="branch_typeSBIDEVELOPER_CONSTRUCTION_COMPANY" href="#">Developer</a><a id="branch_typeSBIRETIREMENT_HOMES" href="#">Domov důchodců</a><a id="branch_typeSBICHILDCARE" href="#">Dětský lékař</a><a id="branch_typeSBIELECTRICIAN_ELECTRICAL_CONTRACTORS" href="#">Elektrikář</a><a id="branch_typeSBIEVENT_PLANNING" href="#">Event agentura (Svatby / Party / Firemní večírky)</a><a id="branch_typeSBIINVESTMENT_ADVISER" href="#">Finanční poradce</a><a id="branch_typeSBIGENERIC_BUSINESS_TYPE" href="#">Firma</a><a id="branch_typeSBIGYM_FITNESS_SPORTS_CENTERS" href="#">Fitness klub / Rekreační sportovní centrum</a><a id="branch_typeSBIPHOTOGRAPHY" href="#">Fotografické studio</a><a id="branch_typeSBIPHYSIOTHERAPIST_MASSEUSE" href="#">Fyzioterapeut / Masážní salón</a><a id="branch_typeSBIBABYSITTING" href="#">Hlídání dětí</a><a id="branch_typeSBIHOTEL" href="#">Hotel / Hostel / Ubytování v soukromí</a><a id="branch_typeSBIBAND_CHOIR_MUSIC_CLUB" href="#">Hudební skupina / Pěvecký sbor / Hudební klub</a><a id="branch_typeSBIPLUMBER" href="#">Instalatér</a><a id="branch_typeSBIBEAUTY_HAIR_SALONS" href="#">Kadeřnictví</a><a id="branch_typeSBICAFE_BAR" href="#">Kavárna / Bar</a><a id="branch_typeSBIJEWELER" href="#">Klenotnictví / Zlatnictví</a><a id="branch_typeSBICLUBS_ASSOCIATIONS" href="#">Kluby / Asociace</a><a id="branch_typeSBIBOOKSTORE" href="#">Knihkupectví</a><a id="branch_typeSBILIBRARY" href="#">Knihovna</a><a id="branch_typeSBICONSULTING_GROUP" href="#">Konzultační služby / Poradentství pro firmy</a><a id="branch_typeSBIIT_CONSULTING_SERVICES" href="#">Konzultační služby v oblasti IT</a><a id="branch_typeSBITAILORING" href="#">Krejčovství</a><a id="branch_typeSBICOURIER_SERVICES" href="#">Kurýrní služby</a><a id="branch_typeSBIFLORIST_FLOWER_SHOP" href="#">Květinářství</a><a id="branch_typeSBISPA_BEAUTY" href="#">Lázně</a><a id="branch_typeSBIDOCTOR" href="#">Lékař</a><a id="branch_typeSBIPHARMACY" href="#">Lékárna</a><a id="branch_typeSBIPAINTER_PAPERHANGER" href="#">Malířství a tapetářství</a><a id="branch_typeSBIKINDERGARTEN" href="#">Mateřská školka</a><a id="branch_typeSBIGLASS_AND_GLAZING_CONTRACTORS" href="#">Montáže oken a dveří/ Sklenářství</a><a id="branch_typeSBINON_PROFIT_ORGANIZATIONS" href="#">Nezisková organizace</a><a id="branch_typeSBINIGHTCLUB_DISCO" href="#">Nightklub / Diskotéka</a><a id="branch_typeSBIOPTICIAN" href="#">Optika</a><a id="branch_typeSBIOTHER_BUSINESS_SERVICES" href="#">Ostatní firemní služby</a><a id="branch_typeSBIOTHER_EDUCATIONAL_SERVICES" href="#">Ostatní vzdělávací služby</a><a id="branch_typeSBISTATIONERY" href="#">Papírnictví</a><a id="branch_typeSBIBAKERY_PASTRY_SHOP" href="#">Pekařství / Cukrárna</a><a id="branch_typeSBIHUMAN_RESOURCES" href="#">Personální agentura/HR služby </a><a id="branch_typeSBIFUNERAL_HOMES" href="#">Pohřební služba</a><a id="branch_typeSBIINSURANCE_SERVICES" href="#">Pojišťovnictví</a><a id="branch_typeSBIGROCER_GROCERY" href="#">Potraviny</a><a id="branch_typeSBIHARDWARE_STORES" href="#">Potřeby pro řemeslníky / Železářství</a><a id="branch_typeSBIPR_MARKETING" href="#">PR / Marketingová / Komunikační agentura</a><a id="branch_typeSBIAUTO_CAR_DEALERSHIP" href="#">Prodej automobilů</a><a id="branch_typeSBIELECTRONICS_ELECTRICAL_APPLIANCES" href="#">Prodej elektrosoučástek</a><a id="branch_typeSBIFURNITURE_STORE" href="#">Prodej nábytku</a><a id="branch_typeSBIANTIQUES_STORE" href="#">Prodej starožitností</a><a id="branch_typeSBITOY_STORE" href="#">Prodejna hraček</a><a id="branch_typeSBIMOTORCYCLE_SHOP" href="#">Prodejna motocyklů</a><a id="branch_typeSBISHOE_STORE" href="#">Prodejna obuvi</a><a id="branch_typeSBICOMPUTER_STORE" href="#">Prodejna počítačů a elektroniky</a><a id="branch_typeSBISPORTS_OUTDOOR" href="#">Prodejna sportovních potřeb</a><a id="branch_typeSBIREAL_ESTATE" href="#">Realitní kancelář</a><a id="branch_typeSBIADVERTISING_AGENCY" href="#">Reklamní agentura</a><a id="branch_typeSBIRESTAURANT" href="#">Restaurace</a><a id="branch_typeSBIBEAUTY_NAIL_SALONS" href="#">Salón krásy a manikúra</a><a id="branch_typeSBIPET_CARE" href="#">Služby pro domácí mazlíčky</a><a id="branch_typeSBIFARMERS_MARKETS" href="#">Soukromý zemědělec / Farma</a><a id="branch_typeSBIGOODS_TRANSPORTION_HAULING" href="#">Spedice</a><a id="branch_typeSBIAMUSEMENT_RECREATION" href="#">Sportovní centrum (Bowling/Billiard/Šipky)</a><a id="branch_typeSBISPORTS_CLUBS" href="#">Sportovní klub / Sportovní asociace</a><a id="branch_typeSBIHOME_IMPROVEMENT_BUILDING_SUPPLIES" href="#">Stavebniny</a><a id="branch_typeSBICONTRACTORS" href="#">Stavební společnost</a><a id="branch_typeSBIMOVING_STORAGE_SERVICES" href="#">Stěhovací služby / Skladování</a><a id="branch_typeSBIROOFER" href="#">Střešní pokrývač</a><a id="branch_typeSBITAXI_LIMO" href="#">Taxislužba</a><a id="branch_typeSBICARPENTER_FRAMING_CONTRACTORS" href="#">Tesařství / Pokrývačství</a><a id="branch_typeSBIPRINTING_SERVICES" href="#">Tiskárna / Copycentrum</a><a id="branch_typeSBIARTIST_DESIGNER" href="#">Umělec / Designer</a><a id="branch_typeSBIVETERINARIANS" href="#">Veterinář</a><a id="branch_typeSBILAUNDRY_CLEANING_IRONING_SERVICES" href="#">Veřejná prádelna / Čistírna</a><a id="branch_typeSBIHOMEOWNERS_ASSOCIATION" href="#">Vlastníci bytových jednotek</a><a id="branch_typeSBIHVAC_SERVICES" href="#">Vzduchotechnika</a><a id="branch_typeSBISCHOOL_COLLEGE" href="#">Vzdělávání / Škola</a><a id="branch_typeSBIWEB_DESIGN" href="#">Webdesign</a><a id="branch_typeSBIWEB_DEVELOPMENT" href="#">Webové aplikace</a><a id="branch_typeSBIGARDENING_LANDSCAPING" href="#">Zahradnické služby</a><a id="branch_typeSBIDENTIST" href="#">Zubařská ordinace / Stomatologie</a><a id="branch_typeSBILOCKSMITH" href="#">Zámečník</a><a id="branch_typeSBICLEANING_SERVICES" href="#">Úklidové služby</a></div>
							
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
				<div id="stepArea2" class="stepArea">
				<form id="step2WizardForm" action="" name="step2WizardForm" method="post" onsubmit="return processstep2();" enctype="application/x-www-form-urlencoded"><!-- step2WizardForm.showWaitingAnimation(); -->
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
									<?php /* <input type="text" id="contact_email" name="contact_email" value="<?php echo $email; ?>" /><i> <!-- --> 
									</i></span>
									*/ ?>
									<input type="text" id="contact_email" name="contact_email" value="<?php echo $this->Session->read('Eshop.email');?>" /><i> <!-- --> 
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
									          <option  value="VNĐ<?php //echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" >VNĐ<?php //echo $langgue['Langgues']['namecountry'];?></option>
									          <option  value="USD<?php //echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" >USD<?php //echo $langgue['Langgues']['namecountry'];?></option>
									          <option  value="#<?php //echo $langgue['Langgues']['countrycode'] ?>"  class="selectText hand" >#<?php //echo $langgue['Langgues']['namecountry'];?></option>
									         
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
				 
				<div id="wizardButtons" class="col-xs-12 col-sm-6 col-md-8">
					<div class="buttonToRight">
						<span id="nextButtonBlock" class="buttonCase">
							<button id="nextButton" type="submit" onclick="abcdef();"><!-- onclick="return Finish()" --> 
								<b><?php __('Continue') ?></b>
							</button> <i> 
						</i>
						</span>
					</div>
					<div class="cleaner">
						
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
		<div id="footer" >
			<p id="footerCopyrights"><?php __('Allrightsreserved');?></p>
		</div>
	</div>
</div>
<!-- id="coverPage" class="normal -->
<script type="text/javascript">/*<![CDATA[*/Languages.run();BranchTypes.run();CountriesWithUS.run();UnitedStates.run();Currencies.run();Wizard.setPortalWizard(1)/*]]>*/</script>
<!--  <div id="businissregister" class="modal hide fade selectWindow" tabindex="-1" > -->
<div class="modal fade selectWindow" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-header">
      
            <div class="hgroup title">
				<h2>Chọn ngành nghề:</h2>
				<button type="button" class="close selectWindowClose" data-dismiss="modal" aria-hidden="true" onclick="closepopup()">×</button>
				<div class="selectWindowItems">
				<div class="swItemsCol" style="height: 839px;">
				<a id="branch_typeSBIWBAND_CHOIR_MUSIC_CLUB" href="#" class="firstAlpha" onClick="reply_click(this.id,this.innerHTML)">Ban nhạc/ Đội hợp ca/ Câu lạc bộ âm nhạc</a>
				<a id="branch_typeSBIWDOCTOR" href="#" onClick="reply_click(this.id,this.innerHTML)">Bác sĩ</a>
				<a id="branch_typeSBIWCHIROPRACTOR_OSTEOPATH" href="#" onClick="reply_click(this.id,this.innerHTML)">Bác sĩ Chiropractor (trị liệu thần kinh cột sống) / Xương - Khớp</a>
				<a id="branch_typeSBIWVETERINARIANS" href="#" onClick="reply_click(this.id,this.innerHTML)">Bác sĩ thú y</a>
				<a id="branch_typeSBIWINSURANCE_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Bảo hiểm</a>
				<a id="branch_typeSBIWBREEDER" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Chăn nuôi</a>
				<a id="branch_typeSBIWOTHER_EDUCATIONAL_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Các dịch vụ giáo dục</a>
				<a id="branch_typeSBIWOTHER_BUSINESS_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Các ngành nghề, dịch vụ khác</a>
				<a id="branch_typeSBIWFAITH_BASED_ORGANIZATIONS" href="#" onClick="reply_click(this.id,this.innerHTML)">Các tổ chức tín ngưỡng</a>
				<a id="branch_typeSBIWSPORTS_CLUBS" href="#" onClick="reply_click(this.id,this.innerHTML)">Câu lạc bộ đêm/ Hiệp hội/ Liên đoàn thể thao</a>
				<a id="branch_typeSBIWCLUBS_ASSOCIATIONS" href="#" onClick="reply_click(this.id,this.innerHTML)">Câu lạc bộ/ Hiệp hội</a>
				<a id="branch_typeSBIWGENERIC_BUSINESS_TYPE" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty</a>
				<a id="branch_typeSBIWTRAVEL" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty du lịch</a>
				<a id="branch_typeSBIWARCHITECTURAL_FIRM" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty kiến trúc</a>
				<a id="branch_typeSBIWHUMAN_RESOURCES" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty nhân sự/ Tuyển dụng</a>
				<a id="branch_typeSBIWWEB_DEVELOPMENT" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty phát triển mạng</a>
				<a id="branch_typeSBIWADVERTISING_AGENCY" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty quảng cáo</a>
				<a id="branch_typeSBIWCONTRACTORS" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty xây dựng</a>
				<a id="branch_typeSBIWDEVELOPER_CONSTRUCTION_COMPANY" href="#" onClick="reply_click(this.id,this.innerHTML)">Công ty xây dựng và phát triển đô thị</a>
				<a id="branch_typeSBIWGARDENING_LANDSCAPING" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng bán dụng cụ sân vườn</a><a id="branch_typeSBIWSPORTS_OUTDOOR" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng bán quần áo và dụng cụ thể thao</a><a id="branch_typeSBIWGLASS_AND_GLAZING_CONTRACTORS" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng bán và sửa chữa cửa sổ, cửa ra vào</a><a id="branch_typeSBIWMOTORCYCLE_SHOP" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng bán xe máy</a><a id="branch_typeSBIWBICYCLE_SHOP" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng bán xe đạp</a><a id="branch_typeSBIWSHOE_STORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng giày dép</a><a id="branch_typeSBIWLAUNDRY_CLEANING_IRONING_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng giặt là</a><a id="branch_typeSBIWFLORIST_FLOWER_SHOP" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng hoa</a><a id="branch_typeSBIWOPTICIAN" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng kính mắt</a><a id="branch_typeSBIWTAILORING" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng may mặc</a><a id="branch_typeSBIWCOMPUTER_STORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng máy tính và linh kiện điện tử</a><a id="branch_typeSBIWGROCER_GROCERY" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng thực phẩm</a><a id="branch_typeSBIWJEWELER" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng vàng bạc đá quý</a></div><div class="swItemsCol" style="height: 839px;"><a id="branch_typeSBIWHARDWARE_STORES" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng vật liệu gia dụng</a><a id="branch_typeSBIWTOY_STORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng đồ chơi</a><a id="branch_typeSBIWANTIQUES_STORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng đồ cổ</a><a id="branch_typeSBIWFURNITURE_STORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng đồ gỗ</a><a id="branch_typeSBIWCARPENTER_FRAMING_CONTRACTORS" href="#" onClick="reply_click(this.id,this.innerHTML)">Cửa hàng đồ gỗ/ Cửa hàng đóng khung tranh</a><a id="branch_typeSBIWPET_CARE" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Dịch vụ cho thú cưng</a><a id="branch_typeSBIWMOVING_STORAGE_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ chuyển nhà/ Kho bãi</a><a id="branch_typeSBIWCOURIER_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ chuyển phát</a><a id="branch_typeSBIWPRINTING_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ in ấn/ Sao chép</a><a id="branch_typeSBIWREAL_ESTATE" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ môi giới nhà đất/ Bất động sản</a><a id="branch_typeSBIWFUNERAL_HOMES" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ tang lễ</a><a id="branch_typeSBIWCONSULTING_GROUP" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ tư vấn</a><a id="branch_typeSBIWCLEANING_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ vệ sinh</a><a id="branch_typeSBIWCHILDCARE" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ y tế</a><a id="branch_typeSBIWCATERING_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Dịch vụ ăn uống</a><a id="branch_typeSBIWGOODS_TRANSPORTION_HAULING" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Giao thông vận tải/ Vận chuyển hàng hóa</a><a id="branch_typeSBIWSCHOOL_COLLEGE" href="#" onClick="reply_click(this.id,this.innerHTML)">Giáo dục/ Trường học/ Đại học</a><a id="branch_typeSBIWHOMEOWNERS_ASSOCIATION" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Hiệp hội Người sở hữu chung cư</a><a id="branch_typeSBIWNIGHTCLUB_DISCO" href="#" onClick="reply_click(this.id,this.innerHTML)">Hộp đêm/ Vũ trường</a><a id="branch_typeSBIWHOTEL" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Khách sạn/ Nhà nghỉ/ Nhà trọ</a><a id="branch_typeSBIWACCOUNTANT_TAX_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Kế toán / Dịch vụ tư vấn thuế</a><a id="branch_typeSBIWHVAC_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Lắp đặt điều hòa/ Sưởi</a><a id="branch_typeSBIWARTIST_DESIGNER" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Nghệ sĩ/ Thiết kế</a><a id="branch_typeSBIWRESTAURANT" href="#" onClick="reply_click(this.id,this.innerHTML)">Nhà hàng</a><a id="branch_typeSBIWFARMERS_MARKETS" href="#" onClick="reply_click(this.id,this.innerHTML)">Nhà nông/ Trang trại</a><a id="branch_typeSBIWPHARMACY" href="#" onClick="reply_click(this.id,this.innerHTML)">Nhà thuốc</a><a id="branch_typeSBIWKINDERGARTEN" href="#" onClick="reply_click(this.id,this.innerHTML)">Nhà trẻ</a><a id="branch_typeSBIWPHOTOGRAPHY" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Photo studio</a><a id="branch_typeSBIWDENTIST" href="#" onClick="reply_click(this.id,this.innerHTML)">Phòng khám nha khoa</a><a id="branch_typeSBIWGYM_FITNESS_SPORTS_CENTERS" href="#" onClick="reply_click(this.id,this.innerHTML)">Phòng tập thể hình/ Trung tâm thể dục thể thao</a><a id="branch_typeSBIWPR_MARKETING" href="#" onClick="reply_click(this.id,this.innerHTML)">PR/ Marketing/ Truyền thông</a><a id="branch_typeSBIWSPA_BEAUTY" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Spa/ Thẩm mỹ viện</a></div><div class="swItemsCol last" style="height: 839px;"><a id="branch_typeSBIWPAINTER_PAPERHANGER" href="#" onClick="reply_click(this.id,this.innerHTML)">Sơn tường/ Giấy dán tường</a><a id="branch_typeSBIWTAXI_LIMO" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Taxi, dịch vụ giao thông vận tải</a><a id="branch_typeSBIWWEB_DESIGN" href="#" onClick="reply_click(this.id,this.innerHTML)">Thiết kế trang web</a><a id="branch_typeSBIWINTERIOR_DESIGN_RENOVATIONS" href="#" onClick="reply_click(this.id,this.innerHTML)">Thiết kế và sửa chữa nội thất</a><a id="branch_typeSBIWLIBRARY" href="#" onClick="reply_click(this.id,this.innerHTML)">Thư viện</a><a id="branch_typeSBIWBEAUTY_HAIR_SALONS" href="#" onClick="reply_click(this.id,this.innerHTML)">Thẩm mỹ viện/ Salon tóc &amp; Hớt tóc nam</a><a id="branch_typeSBIWBEAUTY_NAIL_SALONS" href="#" onClick="reply_click(this.id,this.innerHTML)">Thẩm mỹ viện/ Tiệm nails</a><a id="branch_typeSBIWFASHION_CLOTHING_STORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Thời trang/ Cửa hàng quần áo, giày dép</a><a id="branch_typeSBIWROOFER" href="#" onClick="reply_click(this.id,this.innerHTML)">Thợ lợp ngói</a><a id="branch_typeSBIWPLUMBER" href="#" onClick="reply_click(this.id,this.innerHTML)">Thợ sửa chữa ống nước</a><a id="branch_typeSBIWLOCKSMITH" href="#" onClick="reply_click(this.id,this.innerHTML)">Thợ sửa khóa</a><a id="branch_typeSBIWELECTRICIAN_ELECTRICAL_CONTRACTORS" href="#" onClick="reply_click(this.id,this.innerHTML)">Thợ điện/ Công ty điện</a><a id="branch_typeSBIWBAKERY_PASTRY_SHOP" href="#" onClick="reply_click(this.id,this.innerHTML)">Tiệm bánh mỳ/ Quán kem</a><a id="branch_typeSBIWCAFE_BAR" href="#" onClick="reply_click(this.id,this.innerHTML)">Tiệm cà phê/ Quán Bar</a><a id="branch_typeSBIWBOOKSTORE" href="#" onClick="reply_click(this.id,this.innerHTML)">Tiệm sách</a><a id="branch_typeSBIWHOME_DECOR_ACCESSORIES" href="#" onClick="reply_click(this.id,this.innerHTML)">Trang trí nội thất/ đồ dùng gia dụng</a><a id="branch_typeSBIWAMUSEMENT_RECREATION" href="#" onClick="reply_click(this.id,this.innerHTML)">Trung tâm giải trí/ thể dục thể thao (Bowling/Bi-da/Bắn phi tiêu)</a><a id="branch_typeSBIWAUTO_CAR_BODY_REPAIR_SHOP" href="#" onClick="reply_click(this.id,this.innerHTML)">Trung tâm sửa chữa xe ô tô</a><a id="branch_typeSBIWBABYSITTING" href="#" onClick="reply_click(this.id,this.innerHTML)">Trông trẻ</a><a id="branch_typeSBIWDRIVING_SCHOOL" href="#" onClick="reply_click(this.id,this.innerHTML)">Trường dạy lái xe</a><a id="branch_typeSBIWINVESTMENT_ADVISER" href="#" onClick="reply_click(this.id,this.innerHTML)">Tư vấn tài chính</a><a id="branch_typeSBIWIT_CONSULTING_SERVICES" href="#" onClick="reply_click(this.id,this.innerHTML)">Tư vấn và dịch vụ IT</a><a id="branch_typeSBIWNON_PROFIT_ORGANIZATIONS" href="#" onClick="reply_click(this.id,this.innerHTML)">Tổ chức phi lợi nhuận</a><a id="branch_typeSBIWEVENT_PLANNING" href="#" onClick="reply_click(this.id,this.innerHTML)">Tổ chức sự kiện (Đám cưới/ Tiệc tùng/ Liên hoan công ty)</a><a id="branch_typeSBIWRETIREMENT_HOMES" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Viện dưỡng lão</a><a id="branch_typeSBIWLAW_OFFICE_NOTARY" href="#" onClick="reply_click(this.id,this.innerHTML)">Văn phòng luật/ Công chứng</a><a id="branch_typeSBIWSTATIONERY" href="#" onClick="reply_click(this.id,this.innerHTML)">Văn phòng phẩm</a><a id="branch_typeSBIWPHYSIOTHERAPIST_MASSEUSE" href="#" onClick="reply_click(this.id,this.innerHTML)">Vật lý trị liệu/ Salon massage</a>
				<a id="branch_typeSBIWHOME_IMPROVEMENT_BUILDING_SUPPLIES" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Xây dựng</a>
				<a id="branch_typeSBIWELECTRONICS_ELECTRICAL_APPLIANCES" href="#" onClick="reply_click(this.id,this.innerHTML)" class="firstAlpha">Điện tử/ Điện gia dụng</a>
				<a id="branch_typeSBIWAUTO_CAR_DEALERSHIP" href="#" onClick="reply_click(this.id,this.innerHTML)" onClick="reply_click(this.id,this.innerHTML)">Đại lý xe ô tô</a>
				<div class="cleaner">
				</div></div>
				</div>
		  </div>
	</div>			
				
</div>