<?php echo $this->element('creatmenu')?> 
		<div id="page" class="container">
			<div id="header" class="initialPage">
				
				<div id="headerIllustration" class="personal">
					<!-- -->
				</div>
				<div id="headerSlogan">
					<h1 id="slogan">Make your own website for free!</h1>
					<h4 id="sloganNext">Ideal for personal web pages, blogs and picture
						galleries</h4>
				</div>
			</div>
			<hr class="hidden">
			<div id="content">
				<div id="twoBlocks">
					<div id="leftBlock">
						<h2>
							<b>It's free! No Ads. No cost. </b>
						</h2>
						<div class="content">You can now create a website fast and free.
							We don't place advertising on your site, and never will. We want
							you to be happy while using our technology.</div>
						<div class="icon">
							<!-- -->
						</div>
					</div>
					<div id="rightBlock">
						<h2>
							<b>Even your grandma can do it!</b>
						</h2>
						<div class="content">It really is that easy! All you need is an
							Internet browser and 5 minutes of your time. No download, no
							installation, no technical skills required.</div>
						<div class="icon">
							<!-- -->
						</div>
					</div>
					<div class="cleaner">
						<!-- -->
					</div>
				</div>
				<div id="websitesPreview">
					<h2>Choose from hundreds of modern templates</h2>
					<div>
						<p>
							We know that a good looking website is important to you and here,
							you're well looked after.<br /> Our graphic design professionals
							have prepared a wide variety of modern personal templates.
							There's something for everyone!
						</p>
					</div>
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
				<div class="cleaner boxSpacer">
					<!-- -->
				</div>
				<div>
					<div id="AlatcaFeaturesArea">
						<div id="AlatcaFeatures" class="infoBlock">
							<h4>
								<a href="<?php echo DOMAIN ?>webcreathtml/features-personal-websites/">Alatca
									Features</a>
							</h4>
							<div id="featuresList">
								<ul>
									<li>Real time fast editing as you see it in the browser</li>
									<li>No installation or configuration</li>
									<li>Use your own domain</li>
									<li>Photo galleries, polls, forums</li>
									<li>Blogs, fulltext search, RSS</li>
									<li>Detailed website statistics</li>
									<li>Community and social features</li>
									<li>Plenty of external gadgets and widgets</li>
								</ul>
							</div>
							<i id="icon"></i>
						</div>
						<p>
							<a href="<?php echo DOMAIN ?>webcreathtml/features-personal-websites/">More
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
																<span itemprop="description">We are cooperating with <span
																	itemprop="itemreviewed">Alatca</span> for more than
																	two years already. I appreciate especially helpful
																	communication and high-quality support team. They
																	fulfill what they promised. We currently&hellip;
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
																href="<?php echo DOMAIN ?>webcreathtml/Alatca-reviews/detail/zdenek-vanicek/"><img
																	src="<?php echo DOMAIN ?>webcreathtml/img/media/zdenek-vanicek.jpg"
																	alt="Zdeněk Vaníček" title="Zdeněk Vaníček" /></a></span>
														<address>
																<span itemprop="reviewer">Zdeněk Vaníček</span>
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
					<div id="firstWrapper">
						<h2 id="firstHeader">Make your own website easily or start a free
							blog!</h2>
						<div id="firstParagraph">
							<p>Create a free blog today and start publishing your stories.
								Make your own website and share your hobbies with others. You
								can build a free personal forum where you can interact and be in
								contact with your friends and family. Add widgets, such as a
								chat box, so you can talk live! Making a personal website is
								fast, free, and fun.</p>

							<p>
								<strong>Do you know how to make your own website easily? We do!</strong>
							</p>

							<p>If you want to know how to make your own website for free,
								with no technical knowledge necessary, or if you want to create
								a free blog, you have come to the right place. With our online
								website builder, your website or blog is ready in a matter of
								minutes. All you need to do is to register, choose the right
								template for your web and fill in basic information. After these
								three easy steps, everything is ready to run. Changing the
								content is as easy as editing an email and you can upload images
								or texts in no time.&nbsp;</p>
						</div>
					</div>
				</div>
			</div>
			<hr class="hidden">
			<div id="headerForms">
				<form id="headerSignUp"
					action="<?php echo DOMAIN ?>webcreathtml/personal-websites/" method="post"
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
							type="hidden" name="module_id" id="module_id" value="1">
						<noscript>
							<div id="a200881a212Wrapper">
								<div class="formRow" id="a200881a212Row">
									<label for="a200881a212" id="a200881a212Label">Copy the
										following text into the field:<strong>1b992985bb</strong>
									</label><span class="inputCase"><input id="a200881a212"
										name="a200881a212" type="text" value="" maxlength="255"><i>
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
									<li><a href="http://www.Alatca.cat/web-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ca.png"
											alt="" width="16" height="11" />Català</a></li>
									<li><a href="http://de.Alatca.com/private-homepage/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/de.png"
											alt="" width="16" height="11" />Deutsch</a></li>
									<li><a href="http://www.Alatca.at/private-homepage/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/at.png"
											alt="" width="16" height="11" />Deutsch (Österreich)</a></li>
									<li><a href="http://www.Alatca.in/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/en-in.png"
											alt="" width="16" height="11" />English (India)</a></li>
									<li><a href="http://www.Alatca.es/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es.png"
											alt="" width="16" height="11" />Español</a></li>
									<li><a href="<?php echo DOMAIN ?>.ar/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-ar.png"
											alt="" width="16" height="11" />Español (Argentina)</a></li>
									<li><a href="http://www.Alatca.cl/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-cl.png"
											alt="" width="16" height="11" />Español (Chile)</a></li>
									<li><a href="<?php echo DOMAIN ?>.co/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-co.png"
											alt="" width="16" height="11" />Español (Colombia)</a></li>
									<li><a href="http://www.Alatca.mx/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-mx.png"
											alt="" width="16" height="11" />Español (Mexico)</a></li>
									<li><a href="<?php echo DOMAIN ?>.uy/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-uy.png"
											alt="" width="16" height="11" />Español (Uruguay)</a></li>
								</ul>
							</div>
							<div class="column">
								<ul>
									<li><a href="<?php echo DOMAIN ?>.ve/website-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/es-ve.png"
											alt="" width="16" height="11" />Español (Venezuela)</a></li>
									<li><a href="http://www.Alatca.fr/site-personnel/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/fr.png"
											alt="" width="16" height="11" />Français</a></li>
									<li><a href="http://www.Alatca.it/sito-personale/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/it.png"
											alt="" width="16" height="11" />Italiano</a></li>
									<li><a href="http://www.Alatca.hu/szemelyes-weboldal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/hu.png"
											alt="" width="16" height="11" />Magyar</a></li>
									<li><a href="http://www.Alatca.nl/persoonlijke-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/nl.png"
											alt="" width="16" height="11" />Nederlands</a></li>
									<li><a href="http://no.Alatca.com/personlig-hjemmeside/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/no.png"
											alt="" width="16" height="11" />Norsk</a></li>
									<li><a href="http://pl.Alatca.com/personal-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/pl.png"
											alt="" width="16" height="11" />Polski</a></li>
									<li><a href="http://www.Alatca.pt/site-pessoal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/pt.png"
											alt="" width="16" height="11" />Português</a></li>
									<li><a href="<?php echo DOMAIN ?>.br/website-pessoal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/br.png"
											alt="" width="16" height="11" />Português brasileiro</a></li>
									<li><a href="http://www.Alatca.ro/site-personal/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ro.png"
											alt="" width="16" height="11" />Română</a></li>
								</ul>
							</div>
							<div class="column">
								<ul>
									<li><a href="http://www.Alatca.sk/osobne-stranky/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/sk.png"
											alt="" width="16" height="11" />Slovenčina</a></li>
									<li><a href="http://www.Alatca.fi/henkilokohtaiset-sivut/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/fi.png"
											alt="" width="16" height="11" />Suomi</a></li>
									<li><a href="http://www.Alatca.se/personlig-hemsida/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/sv.png"
											alt="" width="16" height="11" />Svenska</a></li>
									<li><a href="<?php echo DOMAIN ?>.tr/kisisel-web-site/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/tr.png"
											alt="" width="16" height="11" />Türkçe </a></li>
									<li><a href="http://us.Alatca.com/personal-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/us.png"
											alt="" width="16" height="11" />US English</a></li>
									<li><a href="http://www.Alatca.vn/website-ca-nh-an/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/vi.png"
											alt="" width="16" height="11" />tiếng Việt</a></li>
									<li><a href="http://www.Alatca.cz/osobni-stranky/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/cz.png"
											alt="" width="16" height="11" />Čeština</a></li>
									<li><a href="http://www.Alatca.gr/proswpikes-istoselides/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/el.png"
											alt="" width="16" height="11" />Ελληνικά</a></li>
									<li><a href="http://www.Alatca.ru/lichnyj-sajt/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ru.png"
											alt="" width="16" height="11" />Русский</a></li>
									<li><a href="<?php echo DOMAIN ?>.ua/personalni-sajty/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/uk.png"
											alt="" width="16" height="11" />Українська</a></li>
								</ul>
							</div>
							<div class="column">
								<ul>
									<li><a href="http://www.Alatca.jp/personal-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/ja.png"
											alt="" width="16" height="11" />日本語</a></li>
									<li><a href="http://www.Alatca.tw/personal-websites/"
										><img
											src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/tw.png"
											alt="" width="16" height="11" />漢語</a></li>
									<li><a href="http://www.Alatca.kr/personal-websites/"
										><img
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
							<li><a href="http://de.Alatca.com/private-homepage/"
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
