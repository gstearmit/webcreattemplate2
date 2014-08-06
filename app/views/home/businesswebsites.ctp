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
					<h1 id="slogan">Create a website for your business easily!</h1>
					<h4 id="sloganNext">More than 15,000,000 users already trust us</h4>
				</div>
			</div>
			<hr class="hidden">
			<div id="content">
			
				<div id="websitesPreview">
				<?php 
				foreach ($setting as $key => $data){
				if($data['Note']['location']==1){

				?>
					<h2><?php echo $data['Note']['title']?></h2>
					<div>
						<?php echo $data['Note']['content']?>
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

				?>
						<div id="AlatcaFeatures" class="infoBlock">
							<h4>
								<a href="<?php echo DOMAIN ?>webcreathtml/features-business-websites/"><?php echo $data['Note']['title']?></a>
							</h4>
							<div id="featuresList">
								<?php echo $data['Note']['content']?>
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

				?>
					<div id="firstWrapper">
						<h2 id="firstHeader"><?php echo $data['Note']['title']?></h2>
						<div id="firstParagraph">
							<?php echo $data['Note']['content']?>
						</div>
					</div>
					<?php }}?>
				</div>
			</div>
			<hr class="hidden">
			<div id="headerForms">
				<form id="headerSignUp"
					action="<?php echo DOMAIN ?>webcreathtml/business-websites/" method="post"
					onsubmit="return SignUp.onSubmit(this);"
					enctype="application/x-www-form-urlencoded">
					<fieldset class="withoutSeparator">
						<div id="registrantFullNameWrapper">
							<div class="formRow" id="registrantFullNameRow">
								<label for="registrantFullName" id="registrantFullNameLabel">Website
									name&nbsp;<b>*</b>
								</label><span class="inputCase"><input id="registrantFullName"
									name="fullname" type="text" value="" maxlength="32"><i>
										<!-- -->
								</i></span>
								<div class="inputHint" id="registrantFullNameHint">
									<h4>Website name</h4>
									<p>This form entry should contain the name of your website.</p>
									<i>
										<!-- -->
									</i>
								</div>
							</div>
						</div>
						<div id="signupUserEMailWrapper">
							<div class="formRow" id="signupUserEMailRow">
								<label for="signupUserEMail" id="signupUserEMailLabel">Email
									address&nbsp;<b>*</b>
								</label><span class="inputCase"><input id="signupUserEMail"
									name="mail" type="email" value="" maxlength="255"><i>
										<!-- -->
								</i></span>
								<div class="inputHint" id="signupUserEMailHint">
									<h4>Email address</h4>
									<p>Your email address will be used as your login. Don't worry,
										we don't spam.</p>
									<i>
										<!-- -->
									</i>
								</div>
							</div>
						</div>
						<div id="signupUserPwdWrapper">
							<div class="formRow" id="signupUserPwdRow">
								<label for="signupUserPwd" id="signupUserPwdLabel">Password&nbsp;<b>*</b>
								</label><span class="inputCase"><input id="signupUserPwd"
									name="pass" type="password" value="" maxlength="255"><i>
										<!-- -->
								</i></span>
								<div class="inputHint" id="signupUserPwdHint">
									<h4>Password</h4>
									<p>The password must have at least six characters. We recommend
										a combination of letters and numbers.</p>
									<i>
										<!-- -->
									</i>
								</div>
							</div>
						</div>
						<input type="hidden" name="signup-sent" id="signup-sent" value="1"><input
							type="hidden" name="domain" id="domain" value="Alatca.com"><input
							type="hidden" name="module_id" id="module_id" value="3">
						<noscript>
							<div id="a3408248d62Wrapper">
								<div class="formRow" id="a3408248d62Row">
									<label for="a3408248d62" id="a3408248d62Label">Copy the
										following text into the field:<strong>09884cc03e</strong>
									</label><span class="inputCase"><input id="a3408248d62"
										name="a3408248d62" type="text" value="" maxlength="255"><i>
											<!-- -->
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
						<span id="headerSignUpButton" class="buttonCase"><button
								type="submit">
								<b>Sign up</b> <span>and launch your site</span><i>
									<!-- -->
								</i>
							</button></span>
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
						<h3 class="footer_header portal">Company</h3>
						<ul class="footer_list portal">
							<li><a href="<?php echo DOMAIN ?>webcreathtml/about-us/">About us</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/contact/">Contact us</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/our-team/">Our team</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/jobs/">Career</a></li>
							<li><a href="http://blog.Alatca.com/" target="_blank">Blog</a></li>
						</ul>
					</div>
					<div class="column">
						<h3 class="footer_header about-Alatca">Alatca</h3>
						<ul class="footer_list about-Alatca">
							<li><a href="<?php echo DOMAIN ?>webcreathtml/free-website-builder/">Features</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/pricing/">Pricing</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/faq/" target="_blank">FAQ</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/Alatca-reviews/">User
									Testimonials</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/terms-and-conditions/">Terms
									of Service</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/privacy-policy/">Privacy
									Policy</a></li>
							<li><a href="http://affiliate.Alatca.com/" target="_blank">Affiliate</a></li>
						</ul>
					</div>
					<div id="language_list">
						<div class="languages">
							<div class="column first">
								<ul>
									<li><a href="http://www.Alatca.cat/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ca.png"
											alt="" width="16" height="11" />CatalÃ </a></li>
									<li><a href="http://de.Alatca.com/gewerbliche-homepage/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/de.png"
											alt="" width="16" height="11" />Deutsch</a></li>
									<li><a href="http://www.Alatca.at/gewerbliche-homepage/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/at.png"
											alt="" width="16" height="11" />Deutsch (Ã–sterreich)</a></li>
									<li><a href="http://www.Alatca.in/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/en-in.png"
											alt="" width="16" height="11" />English (India)</a></li>
									<li><a href="http://www.Alatca.es/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es.png"
											alt="" width="16" height="11" />EspaÃ±ol</a></li>
									<li><a href="<?php echo DOMAIN ?>.ar/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-ar.png"
											alt="" width="16" height="11" />EspaÃ±ol (Argentina)</a></li>
									<li><a href="http://www.Alatca.cl/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-cl.png"
											alt="" width="16" height="11" />EspaÃ±ol (Chile)</a></li>
									<li><a href="<?php echo DOMAIN ?>.co/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-co.png"
											alt="" width="16" height="11" />EspaÃ±ol (Colombia)</a></li>
									<li><a href="http://www.Alatca.mx/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-mx.png"
											alt="" width="16" height="11" />EspaÃ±ol (Mexico)</a></li>
									<li><a href="<?php echo DOMAIN ?>.uy/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-uy.png"
											alt="" width="16" height="11" />EspaÃ±ol (Uruguay)</a></li>
								</ul>
							</div>
							<div class="column">
								<ul>
									<li><a href="<?php echo DOMAIN ?>.ve/website-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-ve.png"
											alt="" width="16" height="11" />EspaÃ±ol (Venezuela)</a></li>
									<li><a href="http://www.Alatca.fr/site-commercial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/fr.png"
											alt="" width="16" height="11" />FranÃ§ais</a></li>
									<li><a href="http://www.Alatca.it/sito-aziendale/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/it.png"
											alt="" width="16" height="11" />Italiano</a></li>
									<li><a href="http://www.Alatca.hu/uzleti-weboldal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/hu.png"
											alt="" width="16" height="11" />Magyar</a></li>
									<li><a href="http://www.Alatca.nl/bedrijfswebsites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/nl.png"
											alt="" width="16" height="11" />Nederlands</a></li>
									<li><a href="http://no.Alatca.com/firmahjemmeside/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/no.png"
											alt="" width="16" height="11" />Norsk</a></li>
									<li><a href="http://pl.Alatca.com/business-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/pl.png"
											alt="" width="16" height="11" />Polski</a></li>
									<li><a href="http://www.Alatca.pt/site-negocios/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/pt.png"
											alt="" width="16" height="11" />PortuguÃªs</a></li>
									<li><a href="<?php echo DOMAIN ?>.br/site-empresarial/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/br.png"
											alt="" width="16" height="11" />PortuguÃªs brasileiro</a></li>
									<li><a href="http://www.Alatca.ro/site-pentru-afaceri/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ro.png"
											alt="" width="16" height="11" />RomÃ¢nÄƒ</a></li>
								</ul>
							</div>
							<div class="column">
								<ul>
									<li><a href="http://www.Alatca.sk/firemna-prezentacia/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/sk.png"
											alt="" width="16" height="11" />SlovenÄ�ina</a></li>
									<li><a href="http://www.Alatca.fi/yrityksen-sivut/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/fi.png"
											alt="" width="16" height="11" />Suomi</a></li>
									<li><a href="http://www.Alatca.se/foretagssida/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/sv.png"
											alt="" width="16" height="11" />Svenska</a></li>
									<li><a href="<?php echo DOMAIN ?>.tr/kurumsal-web-site/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/tr.png"
											alt="" width="16" height="11" />TÃ¼rkÃ§e </a></li>
									<li><a href="http://us.Alatca.com/business-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/us.png"
											alt="" width="16" height="11" />US English</a></li>
									<li><a href="http://www.Alatca.vn/website-kinh-doanh/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/vi.png"
											alt="" width="16" height="11" />tiáº¿ng Viá»‡t</a></li>
									<li><a href="http://www.Alatca.cz/firemni-prezentace/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/cz.png"
											alt="" width="16" height="11" />ÄŒeÅ¡tina</a></li>
									<li><a
										href="http://www.Alatca.gr/epixeirhmatikes-istoselides/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/el.png"
											alt="" width="16" height="11" />Î•Î»Î»Î·Î½Î¹ÎºÎ¬</a></li>
									<li><a href="http://www.Alatca.ru/biznes-sajt/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ru.png"
											alt="" width="16" height="11" />Ð ÑƒÑ�Ñ�ÐºÐ¸Ð¹</a></li>
									<li><a href="<?php echo DOMAIN ?>.ua/biznes-sajty/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/uk.png"
											alt="" width="16" height="11" />Ð£ÐºÑ€Ð°Ñ—Ð½Ñ�ÑŒÐºÐ°</a></li>
								</ul>
							</div>
							<div class="column">
								<ul>
									<li><a href="http://www.Alatca.jp/business-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ja.png"
											alt="" width="16" height="11" />æ—¥æœ¬èªž</a></li>
									<li><a href="http://www.Alatca.tw/business-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/tw.png"
											alt="" width="16" height="11" />æ¼¢èªž</a></li>
									<li><a href="http://www.Alatca.kr/business-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ko.png"
											alt="" width="16" height="11" />í•œêµ­ì–´</a></li>
								</ul>
							</div>
						</div>
						<div class="handle">
							<a href="#" id="hideLanguages">Hide language list</a>
						</div>
					</div>
					<div class="column">
						<h3 class="footer_header create-websites">How to use Alatca?</h3>
						<ul class="footer_list create-websites">
							<li><a href="<?php echo DOMAIN ?>">Create a free website</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/personal-websites/">Make your
									own website or blog</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/business-websites/">Create a
									business website</a></li>
							<li><a href="<?php echo DOMAIN ?>webcreathtml/e-commerce/">Create an online
									store</a></li>
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
						<h3>Languages</h3>
						<ul class="languages_short">
							<li><a href="" ><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/en.png"
									alt="English" width="16" height="11" /><span>English</span></a></li>
							<li><a href="http://de.Alatca.com/gewerbliche-homepage/"
								><img
									src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/de.png"
									alt="Deutsch" width="16" height="11" /><span>Deutsch</span></a></li>
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
