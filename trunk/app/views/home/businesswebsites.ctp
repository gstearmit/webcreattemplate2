<?php
				$id = 93;
				$setting =  $this->requestAction( '/comment/noteindex/'.$id );
				
				//pr ( $setting );
				//die();
				
				?>

<?php echo $this->element('creatmenu')?> 
		<div id="page" class="container">
			<div id="header" class="initialPage">
				
				<div id="headerIllustration" class="business">
					<!-- -->
				</div>
				<div id="headerSlogan">
					<h1 id="slogan"><?php __('slogan_business')?></h1>
					<h4 id="sloganNext"><?php __('slogan_businesss')?></h4>
				</div>
			</div>
			<hr class="hidden">
			<div id="content">
			
				<div id="websitesPreview">
				<?php 
				foreach ($setting as $key => $data){
				if($data['Note']['location']==1){
				
	//+++++++check Langue++++++++++++
	if($langue =='vie')
	{
		$titlev = $data['Note']['title'];
		$introductionv = $data['Note']['introduction'];
		$contentv = $data['Note']['content'];

	}
	if($langue =='eng')
	{
		$titlev = $data['Note']['title_eg'];
		$introductionv = $data['Note']['introduction_eg'];
		$contentv = $data['Note']['content_eg'];
	}

	?>

					<h2><?php echo $titlev; ?></h2>
					<div>
						<?php echo $contentv; ?>
					</div>
					<?php }}?>
					<div id="selectGroup"></div>
					<div id="imagesList">
						<div id="imagesPaging"></div>
						<h3 id="imagesGroupName"></h3>
						<div id="imagesArea" class="waitingBlock"></div>
						<div id="imagesListHead">
							<!-- -->
						</div>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
					<div id="websitesPreviewHead">
						<!-- -->
					</div>
				</div>
				<div>
					<div id="AlatcaFeaturesArea">
					<?php 
				foreach ($setting as $key => $data){
				if($data['Note']['location']==2){
								if($langue =='vie')
				{
					$titlev = $data['Note']['title'];
					$contentv = $data['Note']['content'];
				
				}
				if($langue =='eng')
				{
					$titlev = $data['Note']['title_eg'];
					$contentv = $data['Note']['content_eg'];
				}
				?>
						<div id="AlatcaFeatures" class="infoBlock">
							<h4>
								<a href="<?php echo DOMAIN ?>webcreathtml/features-business-websites/"><?php echo $titlev; ?></a>
							</h4>
							<div id="featuresList">
								<?php echo $contentv; ?>
							</div>
							<i id="icon"></i>
						</div>
						<?php }}?>
						<p>
							<a href="<?php echo DOMAIN ?>webcreathtml/features-business-websites/">More
								information...</a>
						</p>
					</div>
					<div id="testimonialsArea" class="quoteBlockArea">
						<div id="testimonials" class="quoteBlock">
							<h4>
								<a href="<?php echo DOMAIN ?>webcreathtml/Alatca-reviews/">User
									Testimonials</a>
							</h4>
							<div id="homepageReviewsContent">
								<div itemscope="" itemtype="http://data-vocabulary.org/Review">
									<blockquote>
										<div class="bqtext">
											<table>
												<tbody>
													<tr>
														<td><p>
																<span itemprop="description">I keep hearing horror
																	stories from other authors about their websites going
																	down, or trouble with their hosting. I'm so glad I
																	chose <span itemprop="itemreviewed">Alatca</span>. I
																	get technical support when I need it&hellip;
																</span><span class="rating" itemprop="rating">4.5</span>
															</p></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="logoArea">
											<table>
												<tbody>
													<tr>
														<td><span class="reviewerHome"><a
																href="<?php echo DOMAIN ?>webcreathtml/Alatca-reviews/detail/terry-lynn-johnson/"><img
																	src="<?php echo DOMAIN ?>webcreathtml/img/media/terry-lynn-johnson.jpg"
																	alt="Terry Johnson" title="Terry Johnson" /></a></span>
														<address>
																<span itemprop="reviewer">Terry Johnson</span>
															</address></td>
													</tr>
												</tbody>
											</table>
										</div>
									</blockquote>
								</div>
								<div class="waitingBlock">
									<!-- / -->
								</div>
							</div>
						</div>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
				</div>
				<div id="firstBlock" class="open">
				<?php 
				foreach ($setting as $key => $data){
				if($data['Note']['location']==3){
				if($langue =='vie')
				{
					$titlev = $data['Note']['title'];
					$contentv = $data['Note']['content'];
				
				}
				if($langue =='eng')
				{
					$titlev = $data['Note']['title_eg'];
					$contentv = $data['Note']['content_eg'];
				}
				?>
					<div id="firstWrapper">
						<h2 id="firstHeader"><?php echo $titlev; ?></h2>
						<div id="firstParagraph">
							<?php echo $contentv; ?>
						</div>
					</div>
					<?php }}?>
				</div>
			</div>
			<hr class="hidden">
			<div id="headerForms">
		<form id="headerSignUp" name="headerSignUp"
			action="<?php echo DOMAIN ?>launch-your-site" method="post"
			enctype="application/x-www-form-urlencoded">
			<!-- onsubmit="return SignUp.onSubmit(this);" -->
			<fieldset class="withoutSeparator">
				<div id="registrantFullNameWrapper">
					<div class="formRow" id="registrantFullNameRow">
						<label for="registrantFullName" id="registrantFullNameLabel"><?php __('Website_name') ?>&nbsp;<b>*</b>
						</label> <span class="inputCase"> <input id="registrantFullName"
							name="storename" type="text" value="" maxlength="32"> <i> <!-- -->
						</i>
						</span>
						<div class="inputHint" id="registrantFullNameHint">
							<h4><?php __('Website_name')?></h4>
							<p><?php __('your_website')?>.</p>
							<i> <!-- -->
							</i>
						</div>
					</div>
				</div>
				<div id="signupUserEMailWrapper">
					<div class="formRow" id="signupUserEMailRow">
						<label for="signupUserEMail" id="signupUserEMailLabel"><?php __('Email_address')?>&nbsp;<b>*</b>
						</label> <span class="inputCase"> <input id="signupUserEMail"
							name="mail" type="email" value="" maxlength="255"> <i> <!-- -->
						</i>
						</span>
						<div class="inputHint" id="signupUserEMailHint">
							<h4><?php __('Email_address')?></h4>
							<p><?php __('your_mail')?></p>
							<i> <!-- -->
							</i>
						</div>
					</div>
				</div>
				<div id="signupUserPwdWrapper">
					<div class="formRow" id="signupUserPwdRow">
						<label for="signupUserPwd" id="signupUserPwdLabel"><?php __('Password')?>&nbsp;<b>*</b>
						</label><span class="inputCase"><input id="signupUserPwd"
							name="pass" type="password" value="" maxlength="255"><i> <!-- -->
						</i></span>
						<div class="inputHint" id="signupUserPwdHint">
							<h4><?php __('Password')?></h4>
							<p><?php __('your_password')?></p>
							<i> <!-- -->
							</i>
						</div>
					</div>
				</div>
				<input type="hidden" name="signup-sent" id="signup-sent" value="1"><input
					type="hidden" name="domain" id="domain" value="Alatca.com">
				<noscript>
					<div id="aa62a6988a6Wrapper">
						<div class="formRow" id="aa62a6988a6Row">
							<label for="aa62a6988a6" id="aa62a6988a6Label">Copy the following
								text into the field:<strong>2f0785f6f9</strong>
							</label><span class="inputCase"><input id="aa62a6988a6"
								name="aa62a6988a6" type="text" value="" maxlength="255"><i> <!-- -->
							</i></span>
						</div>
					</div>
				</noscript>
				<div id="rbcSystemFnc">
					<!-- -->
				</div>
				<div class="cleaner boxSpacer">
					<!-- -->
				</div>
				<div class="cleaner">
					<!-- -->
				</div>
				<span id="headerSignUpButton" class="buttonCase">
					<button type="submit" onclick="return validateData234()">
						<b><?php __('Sing_up')?></b> <span><?php __('your_site')?></span><i> <!-- -->
						</i>
					</button>
				</span>
			</fieldset>
			<div class="cleaner">
				<!-- -->
			</div>
			<div class="formEnd">
				<!-- -->
			</div>
		</form>
				<form id="headerSignIn" action="<?php echo DOMAIN ?>webcreathtml/sign-in/"
					method="post" enctype="application/x-www-form-urlencoded">
					<input type="hidden" name="login" value="1">
					<div class="formRow">
						<label for="signInEmail">Email address</label><span
							class="inputCase"><input id="signInEmail" type="email" name="usr"
							value="" maxlength="255"><i>
								<!-- -->
						</i></span>
					</div>
					<div class="formRow">
						<label for="signInPassword">Password</label><span
							class="inputCase"><input id="signInPassword" type="password"
							name="pwd" value="" maxlength="255"><i>
								<!-- -->
						</i></span>
					</div>
					<div class="cleaner boxSpacer">
						<!-- -->
					</div>
					<a href="<?php echo DOMAIN ?>webcreathtml/new-password/" id="loginFormNewPwd">Forgot
						your password?</a><span class="buttonCase"><button type="submit">
							<b>Login</b><i>
								<!-- -->
							</i>
						</button></span>
					<div id="headerSignInBottom">
						<!--  -->
					</div>
				</form>
			</div>
		</div>
		<hr class="hidden">
		<div id="footer">
	<div class="top">
		<div class="content">
			<div class="column first">
				<h3 class="footer_header portal"><?php __('Company')?></h3>
				<ul class="footer_list portal">
					<li><a href="<?php echo DOMAIN ?>about-us"><?php __('About_us')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/contact/"><?php __('Contact_us')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/our-team/"><?php __('Our_team')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/jobs/"><?php __('Career')?></a></li>
					<li><a href="http://blog.Alatca.com/" target="_blank">Blog</a></li>
				</ul>
			</div>
			<div class="column">
				<h3 class="footer_header about-Alatca">Alatca</h3>
				<ul class="footer_list about-Alatca">
					<li><a
						href="<?php echo DOMAIN ?>webcreathtml/free-website-builder/"><?php __('Features')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/pricing/"><?php __('Pricing')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/faq/" target="_blank"><?php __('FAQ')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/Alatca-reviews/"><?php __('User_Testimonials')?></a></li>
					<li><a
						href="<?php echo DOMAIN ?>webcreathtml/terms-and-conditions/"><?php __('Service')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/privacy-policy/"><?php __('Privacy_Policy')?></a></li>
					<li><a href="http://affiliate.Alatca.com/" target="_blank"><?php __('Affiliate')?></a></li>
				</ul>
			</div>
			<div id="language_list">
				<div class="languages">
					<div class="column first">
						<ul>
							<li><a href="http://www.Alatca.cat/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ca.png"
									alt="" width="16" height="11" />Català</a></li>
							<li><a href="http://de.Alatca.com/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/de.png"
									alt="" width="16" height="11" />Deutsch</a></li>
							<li><a href="http://www.Alatca.at/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/at.png"
									alt="" width="16" height="11" />Deutsch (Österreich)</a></li>
							<li><a href="http://www.Alatca.in/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/en-in.png"
									alt="" width="16" height="11" />English (India)</a></li>
							<li><a href="http://www.Alatca.es/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es.png"
									alt="" width="16" height="11" />Español</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.ar/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-ar.png"
									alt="" width="16" height="11" />Español (Argentina)</a></li>
							<li><a href="http://www.Alatca.cl/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-cl.png"
									alt="" width="16" height="11" />Español (Chile)</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.co/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-co.png"
									alt="" width="16" height="11" />Español (Colombia)</a></li>
							<li><a href="http://www.Alatca.mx/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-mx.png"
									alt="" width="16" height="11" />Español (Mexico)</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.uy/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-uy.png"
									alt="" width="16" height="11" />Español (Uruguay)</a></li>
						</ul>
					</div>
					<div class="column">
						<ul>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.ve/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-ve.png"
									alt="" width="16" height="11" />Español (Venezuela)</a></li>
							<li><a href="http://www.Alatca.fr/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/fr.png"
									alt="" width="16" height="11" />Français</a></li>
							<li><a href="http://www.Alatca.it/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/it.png"
									alt="" width="16" height="11" />Italiano</a></li>
							<li><a href="http://www.Alatca.hu/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/hu.png"
									alt="" width="16" height="11" />Magyar</a></li>
							<li><a href="http://www.Alatca.nl/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/nl.png"
									alt="" width="16" height="11" />Nederlands</a></li>
							<li><a href="http://no.Alatca.com/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/no.png"
									alt="" width="16" height="11" />Norsk</a></li>
							<li><a href="http://pl.Alatca.com/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/pl.png"
									alt="" width="16" height="11" />Polski</a></li>
							<li><a href="http://www.Alatca.pt/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/pt.png"
									alt="" width="16" height="11" />Português</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.br/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/br.png"
									alt="" width="16" height="11" />Português brasileiro</a></li>
							<li><a href="http://www.Alatca.ro/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ro.png"
									alt="" width="16" height="11" />Română</a></li>
						</ul>
					</div>
					<div class="column">
						<ul>
							<li><a href="http://www.Alatca.sk/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/sk.png"
									alt="" width="16" height="11" />Slovenčina
							</a></li>
							<li><a href="http://www.Alatca.fi/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/fi.png"
									alt="" width="16" height="11" />Suomi
							</a></li>
							<li><a href="http://www.Alatca.se/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/sv.png"
									alt="" width="16" height="11" />Svenska
							</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.tr/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/tr.png"
									alt="" width="16" height="11" />Türkçe
							</a></li>
							<li><a href="http://us.Alatca.com/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/us.png"
									alt="" width="16" height="11" />US English
							</a></li>
							<li><a href="http://www.Alatca.vn/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/vi.png"
									alt="" width="16" height="11" />tiếng Việt
							</a></li>
							<li><a href="http://www.Alatca.cz/"> <img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/cz.png"
									alt="" width="16" height="11" />Čeština
							</a></li>
							<li><a href="http://www.Alatca.gr/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/el.png"
									alt="" width="16" height="11" />Ελληνικά</a></li>
							<li><a href="http://www.Alatca.ru/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ru.png"
									alt="" width="16" height="11" />Русский</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml.ua/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/uk.png"
									alt="" width="16" height="11" />Українська</a></li>
						</ul>
					</div>
					<div class="column">
						<ul>
							<li><a href="http://www.Alatca.jp/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ja.png"
									alt="" width="16" height="11" />日本語</a></li>
							<li><a href="http://www.Alatca.tw/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/tw.png"
									alt="" width="16" height="11" />漢語</a></li>
							<li><a href="http://www.Alatca.kr/"><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ko.png"
									alt="" width="16" height="11" />한국어</a></li>
						</ul>
					</div>
				</div>
				<div class="handle">
					<a href="#" id="hideLanguages">Hide language list</a>
				</div>
			</div>
			<div class="column">
				<h3 class="footer_header create-websites"><?php __('alatca')?></h3>
				<ul class="footer_list create-websites">
					<li><a href="<?php echo DOMAIN ?>"><?php __('Creat')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/personal-websites/"><?php __('Make')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/business-websites/"><?php __('Creat_business')?></a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/e-commerce/"><?php __('Create_store')?></a></li>
					<li><a href=""></a></li>
				</ul>
			</div>
			<div class="column">
				<h3>Follow us</h3>
				<ul class="social">
					<li class="facebook"><a href="http://www.facebook.com/Alatca"
						title="Facebook" target="_blank"></a></li>
					<li class="twitter"><a href="http://twitter.com/Alatca"
						title="Twitter" target="_blank"></a></li>
					<li class="googleplus"><a
						href="https://plus.google.com/105974429523197564509"
						rel="publisher" title="Google+" target="_blank"></a></li>
				</ul>
				<h3><?php __('Languages')?></h3>
				<ul class="languages_short">
					<li><a href="<?php echo DOMAIN ?>?language=eng"><img
							src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/en.png"
							alt="English" width="16" height="11" /><span>English</span></a></li>
					<li><a href="<?php echo DOMAIN ?>?language=vie"><img
							src="<?php echo DOMAIN ?>images/vietnam.gif"
							alt="Deutsch" width="16" height="11" /><span>Tiếng Việt</span></a></li>
					<li class="all_languages"><a href="#" id="showLanguages">Show all
							languages</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="content">
			<div class="logo">
				<a href="<?php echo DOMAIN ?>"><img alt="Alatca"
					src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/Alatca_logo_footer.png" /></a>
			</div>
			<div class="credits">
				<p>&copy; 2014 Alatca AG. All rights reserved.</p>
			</div>
		</div>
	</div>
</div>
