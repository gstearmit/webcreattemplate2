<script type="text/javascript"
	src="<?php echo DOMAIN ?>webcreathtml/js/validatedatanew.js"></script>
<?php echo $this->element('creatmenu')?>
<div id="page" class="container">
	<div class="row">
		<div id="header"
			class="initialPage container col-xs-12 col-sm-6 col-md-8">
			<div class="row ">

				<div id="headerIllustration" class="headeriluss">
					<!-- div id="watchVideo">
								
							</div>-->
				</div>
				<div id="headerSlogan" class="single">
					<h1 id="slogan">Create a free website easily!</h1>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- end id="header" -->
	</div>
	<!-- endclass ="row" -->

	<hr class="hidden">
	<div class="row">
		<div id="content">
			<div class="row">
				<div id="threeBlocks">
				<?php
				
				$id = 90;
				$setting = $this->requestAction ( '/comment/noteindex/' . $id );
				
				?>
	
	<?php
	$id = "";
	$icon = "";
	
	foreach ( $setting as $key => $data ) {
    // pr($data ['Note'] ['location']);
		if ($key == 0) {
			$id = "leftBlock";
			$icon = "smart-features";
		} elseif ($key == 1) {
			$id = "middleBlock";
			$icon = "click-mouse";
		}elseif ($key == 2) {
			$id = "rightBlock";
			$icon = "good-company";
		}
// 		if ($data ['Note'] ['location'] == 1) {
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

	<div id="<?php echo $id; ?>"
						class="book-content <?php echo $icon; ?> col-lg-4 col-md-4 col-sm-4 col-xs-12 ez-hotro-box item animate_afc d1 animate_start">
						<h2>
							<a href="<?php echo DOMAIN ?>webcreathtml/free-website-builder/"><?php echo $titlev;?></a>
						</h2>
						<div class="content"><?php  echo $introductionv;?></div>
						<p class="link">
							<a href="<?php echo DOMAIN ?>webcreathtml/free-website-builder/"><?php __("More_information")?>...</a>
						</p>
	</div>

<?php
		//}
	}
	?>


					<div class="cleaner">
						<!-- -->
					</div>
				</div>
			</div>

			<div id="homepageBlock">
				<div id="homepageReviewsArea" class="quoteBlockArea homepageArea">
					<div id="homepageReviews" class="quoteBlock">
						<h4>
							<a href="<?php echo DOMAIN ?>webcreathtml/media/">What they wrote
								about us</a>
						</h4>
						<div id="homepageReviewsContent">
							<div itemscope="" itemtype="http://data-vocabulary.org/Review">
								<blockquote>
									<div class="bqtext">
										<table>
											<tbody>
												<tr>
													<td><p>
															<span itemprop="description">So you were reading your
																"Web Design For Dummies" book and still couldn't figure
																out what it's all about? That is when <span
																itemprop="itemreviewed">Alatca</span> comes into the
																game!
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
													<td><span><a
															href="<?php echo DOMAIN ?>webcreathtml/media/detail/Alatca-com-create-your-own-website/"><img
																src="<?php echo DOMAIN ?>webcreathtml/img/media/killerstartups.png"
																alt="KillerStartups"
																title="Alatca.com - Create Your Own Website" /></a></span>
														<address>
															<span itemprop="reviewer" class="reviewerHome">KillerStartups</span>
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
				<div id="homepageBlogArea" class="infoBlockArea homepageArea">
					<div id="homepageBlog" class="infoBlock">
						<h4>
							<a href="<?php echo DOMAIN ?>webcreathtml/mobile-version/"
								rel="nofollow">Optimized for mobile devices</a>
						</h4>
						<div id="blogText">
							<p>Enjoy proper display of your website on any mobile device. All
								sites are automatically built for smartphone and tablet use.</p>
							<p id="spotLink">
								<a href="<?php echo DOMAIN ?>webcreathtml/mobile-version/">More
									information...</a>
							</p>
						</div>
						<div id="blogImage">
							<img
								src="<?php echo DOMAIN ?>webcreathtml/img/blog/blog-mobil-2.png"
								width="124" height="121" alt="" />
						</div>
					</div>
				</div>
				<div class="cleaner">
					<!-- / -->
				</div>
			</div>
			<div id="firstBlock" class="open">
			<?php
			
foreach ( $setting as $key => $view ) {
				if ($view ['Note'] ['location'] == 2) {
					
					?>
			
				<div id="firstWrapper">
					<h2 id="firstHeader"><?php echo $view['Note']['title']?></h2>
					<div id="firstParagraph">
						<?php echo $view['Note']['content'];?>
					</div>
				</div>
				<?php } }?>
			</div>
		</div>
		<!--  -->
	</div>
	<!-- end row content -->
	<hr class="hidden">

	<div id="headerForms">
		<form id="headerSignUp" name="headerSignUp"
			action="<?php echo DOMAIN ?>launch-your-site" method="post"
			enctype="application/x-www-form-urlencoded">
			<!-- onsubmit="return SignUp.onSubmit(this);" -->
			<fieldset class="withoutSeparator">
				<div id="registrantFullNameWrapper">
					<div class="formRow" id="registrantFullNameRow">
						<label for="registrantFullName" id="registrantFullNameLabel">Website
							name&nbsp;<b>*</b>
						</label> <span class="inputCase"> <input id="registrantFullName"
							name="storename" type="text" value="" maxlength="32"> <i> <!-- -->
						</i>
						</span>
						<div class="inputHint" id="registrantFullNameHint">
							<h4>Website name</h4>
							<p>This form entry should contain the name of your website.</p>
							<i> <!-- -->
							</i>
						</div>
					</div>
				</div>
				<div id="signupUserEMailWrapper">
					<div class="formRow" id="signupUserEMailRow">
						<label for="signupUserEMail" id="signupUserEMailLabel">Email
							address&nbsp;<b>*</b>
						</label> <span class="inputCase"> <input id="signupUserEMail"
							name="mail" type="email" value="" maxlength="255"> <i> <!-- -->
						</i>
						</span>
						<div class="inputHint" id="signupUserEMailHint">
							<h4>Email address</h4>
							<p>Your email address will be used as your login. Don't worry,we
								don't spam.</p>
							<i> <!-- -->
							</i>
						</div>
					</div>
				</div>
				<div id="signupUserPwdWrapper">
					<div class="formRow" id="signupUserPwdRow">
						<label for="signupUserPwd" id="signupUserPwdLabel">Password&nbsp;<b>*</b>
						</label><span class="inputCase"><input id="signupUserPwd"
							name="pass" type="password" value="" maxlength="255"><i> <!-- -->
						</i></span>
						<div class="inputHint" id="signupUserPwdHint">
							<h4>Password</h4>
							<p>The password must have at least six characters. We recommend a
								combination of letters and numbers.</p>
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
						<b>Sign up</b> <span>and launch your site</span><i> <!-- -->
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
		<form id="headerSignIn"
			action="<?php echo DOMAIN ?>webcreathtml/sign-in/" method="post"
			enctype="application/x-www-form-urlencoded">
			<!-- style="display: block; visibility: visible; top: 7px;z-index: 1032;position: absolute;" -->
			<input type="hidden" name="login" value="1">
			<div class="formRow">
				<label for="signInEmail">Email address</label><span
					class="inputCase"><input id="signInEmail" type="email" name="usr"
					value="" maxlength="255"><i> <!-- -->
				</i></span>
			</div>
			<div class="formRow">
				<label for="signInPassword">Password</label><span class="inputCase"><input
					id="signInPassword" type="password" name="pwd" value=""
					maxlength="255"><i> <!-- -->
				</i></span>
			</div>
			<div class="cleaner boxSpacer">
				<!-- -->
			</div>
			<a href="<?php echo DOMAIN ?>webcreathtml/new-password/"
				id="loginFormNewPwd">Forgot your password?</a><span
				class="buttonCase"><button type="submit">
					<b>Login</b><i> <!-- -->
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
					<li><a href="<?php echo DOMAIN ?>about-us">About us</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/contact/">Contact us</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/our-team/">Our team</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/jobs/">Career</a></li>
					<li><a href="http://blog.Alatca.com/" target="_blank">Blog</a></li>
				</ul>
			</div>
			<div class="column">
				<h3 class="footer_header about-Alatca">Alatca</h3>
				<ul class="footer_list about-Alatca">
					<li><a
						href="<?php echo DOMAIN ?>webcreathtml/free-website-builder/">Features</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/pricing/">Pricing</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/faq/" target="_blank">FAQ</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/Alatca-reviews/">User
							Testimonials</a></li>
					<li><a
						href="<?php echo DOMAIN ?>webcreathtml/terms-and-conditions/">Terms
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
				<h3 class="footer_header create-websites">How to use Alatca?</h3>
				<ul class="footer_list create-websites">
					<li><a href="<?php echo DOMAIN ?>">Create a free website</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/personal-websites/">Make
							your own website or blog</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/business-websites/">Create
							a business website</a></li>
					<li><a href="<?php echo DOMAIN ?>webcreathtml/e-commerce/">Create
							an online store</a></li>
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
					<li><a href=""><img
							src="<?php echo DOMAIN ?>webcreathtml/img/layout3-2/flags/en.png"
							alt="English" width="16" height="11" /><span>English</span></a></li>
					<li><a href="http://de.Alatca.com/"><img
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
