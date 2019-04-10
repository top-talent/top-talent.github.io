<?php
/**
 * Template Name: General Page - Typeform Survey
 */
?>
<link id="font" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&text=" rel="stylesheet" type="text/css">

<style type="text/css">
	/* This is to override the typical 'about-espen' on every single page */
	#about-espen, .newsletter-section, .TGA-text {
		display: none;
	}

	.is_form_wrapper {
		width: 80%;
		margin: 0 auto;
	}

	.infusion-field {
		width: 100%;
		padding: 50px 0 30px;
	}

	.infusion-field label, .infusion-field input {
		width: 100%;
		font-family: "Montserrat","Helvetica Neue",sans serif;
		font-size: 24px;
		color: #3d3d3d;
		font-weight: 400;
	}

	.infusion-field .subheading {
		font-size: 16px;
		margin-bottom: 20px;
		margin-top: 20px;
		padding-left: 45px;
		opacity: 0.8;
	}

	.infusion-field label {
		line-height: 35px;
	}

	.infusion-field input, .infusion-field textarea {
		border: 2px dashed rgba(0,137,161,0.4);
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		margin-left: 45px;
		margin-top: 20px;
	}

	.infusion-field textarea {
		width: 100%;
		height: 150px;
	}

	.infusion-field input.error {
		border-color: #ca0606;
	}

	.infusion-field label span.question-number {
		display: block;
		width: 45px;
		float: left;
		font-size: 16px;
		color: #0089A1;
	}

	.infusion-field label span.label-text {
		display: block;
		padding-left: 45px;
	}

	button.submit, a.youcanbookme {
		display: block;
		margin: 0 auto 40px;
		background: #C94429;
		color: #FFF;
		border-radius: 0;
		padding: 20px;
		font-size: 2em;
		font-weight: 700;
		white-space: normal;
		border: 0;
		outline: 0;
		text-align: center;
		line-height: normal;
	}

	.gai .infusion-radio-wrapper {
		margin-left: 45px;
	}

	.gai input {
		display: none;
	}

	.gai span.infusion-option {
		display: block;
		float: left;
		width: 45%;
		min-width: 280px;
		margin-right: 5%;
		margin-bottom: 8px;
		background-color: #f8f8f8;
		border: 1px solid rgba(0,0,0,0.2);
		border-radius: 2px;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		padding: 5px 15px;
	}

	.gai span.infusion-option label {
		color: #0089A1;
		font-size: 19px;
		padding-bottom: 0;
		margin-bottom: 0;
		cursor: pointer;
	}

	.gai span.infusion-option span.tick {
		display: none;
		float: right;
		margin-right: 5px;
		top: 50%;
		margin-top: -30px;
	}

	.survey-header {
		width: 70%;
		margin: 0 auto;
		text-align: center;
		padding-top: 40px;
		color: #3d3d3d;
	}

	.survey-header h1 {
		font-size: 24px;
		padding-top: 30px;
		font-weight: 700;
	}

	.survey-header h2 {
		font-size: 19px;
		line-height: 145%;
		opacity: 0.8;
	}

	.validation-errors {
		padding-bottom: 30px;
		text-align:center;
	}

	.validation-errors p {
		margin: 0;
		color: #ca0606;
	}

	.schedule-appointment {
		display: none;
	}
</style>


<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part( 'templates/page', 'header' );
	$upload_dir = wp_upload_dir(); ?>
			<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function () {
					jQuery( ".gai span.infusion-option label" ).click(function() {
						jQuery(document).find("span.tick").hide();
						jQuery(this).parent().find("span.tick").show();
					});

					jQuery("#is-form-submit").click(function(e) {
						e.preventDefault();

						// form validation
						var errors = new Array();
						var error_fields = new Array();
						if( jQuery("#inf_field_FirstName").val() == '' ) {
							errors.push('First Name is required');
							error_fields.push( jQuery("#inf_field_FirstName") );
						}

						if( jQuery("#inf_field_Email").val() == '' ) {
							errors.push('Email Address is required');
							error_fields.push( jQuery("#inf_field_Email") );
						} else {
							var patt = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,63}$/i;
							var result = patt.test( jQuery("#inf_field_Email").val() );

							if( result == false ) {
								errors.push('Email address has incorrect format');
								error_fields.push( jQuery("#inf_field_Email") );
							}
						}

						if( errors.length > 0 ) {
							jQuery("#validation-errors p").remove();
							for( var i = 0; i < errors.length; i++ ) {
								jQuery("#validation-errors").append( '<p>' + errors[i] + '</p>' );
							}

							for( i = 0; i < error_fields.length; i++ ) {
								jQuery( error_fields[i] ).addClass( "error" );
							}

							return;
						}

						var data = {
							'action': 'submit_wheel_of_life_survey',
							'inf_field_FirstName': jQuery( "#inf_field_FirstName" ).val(),
							'inf_field_LastName': jQuery( "#inf_field_LastName" ).val(),
							'inf_field_Phone1': jQuery( "#inf_field_Phone1" ).val(),
							'inf_field_Email': jQuery( "#inf_field_Email" ).val(),
							'inf_custom_WLSSkypeId': jQuery( "#inf_custom_WLSSkypeId" ).val(),
							'inf_custom_WLSPlannedInvestmentinSelfDevelopment': jQuery( "#inf_custom_WLSPlannedInvestmentinSelfDevelopment" ).val(),
							'inf_custom_MentalAndEmotionalState': jQuery( "#inf_custom_MentalAndEmotionalState" ).val(),
							'inf_custom_WLSCareerVocationPurpose': jQuery( "#inf_custom_WLSCareerVocationPurpose" ).val(),
							'inf_custom_WLSRelationships': jQuery( "#inf_custom_WLSRelationships" ).val(),
							'inf_custom_WLSTime': jQuery( "#inf_custom_WLSTime" ).val(),
							'inf_custom_WLSFinancial': jQuery( "#inf_custom_WLSFinancial" ).val(),
							'inf_custom_WLSPhysicalHealth': jQuery( "#inf_custom_WLSPhysicalHealth" ).val(),
							'inf_custom_WLSSpiritualFulfillment': jQuery( "#inf_custom_WLSSpiritualFulfillment" ).val(),
							'inf_custom_WLSPersonalDevelopment': jQuery( "#inf_custom_WLSPersonalDevelopment" ).val(),
							'inf_custom_WLSMein51020Years': jQuery( "#inf_custom_WLSMein51020Years" ).val(),
							'inf_custom_WLSRoadBlocks': jQuery( "#inf_custom_WLSRoadBlocks" ).val(),
							'inf_custom_WLSRoadBlocksNegativeImpact': jQuery( "#inf_custom_WLSRoadBlocksNegativeImpact" ).val(),
							'inf_custom_WLSTopValues': jQuery( "#inf_custom_WLSTopValues" ).val(),
							'inf_custom_WLSGrossAnnualIncome': jQuery( ".gai span.infusion-option .tick:visible" ).parent().find( "input" ).val()
						};

						console.log( 'form-submited' );
						jQuery.post( 'http://www.drespen.com/wp-admin/admin-ajax.php', data, function( response ) {
							console.log( response );
						});

						jQuery( ".schedule-appointment" ).show();
						jQuery( "button.submit" ).hide();
					});

					jQuery( ".infusion-field-input-container" ).focus( function() {
						jQuery( ".validation-errors" ).empty();
						jQuery( this ).removeClass( "error" );
					});
				});
			</script>

			<div class="survey-header">
				<img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-logo.png" style="width: 100%; max-width: 450px;"/>
				<h1>Wheel of Life Survey</h1>
				<h2>Take your time and answer truthfully. This test will identify your life's areas of improvement and how Dr. Espen can help you align your own true values with your life’s vision and purpose.</h2>
			</div>
			<div class="is_form_wrapper">
				<div class="infusion-field">
					<label for="inf_field_FirstName"><span class="question-number">1 -></span><span class="label-text">What is your <strong>first name</strong>?<span class="asterisk">*</span></span></label>
					<input class="infusion-field-input-container" id="inf_field_FirstName" name="inf_field_FirstName" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_field_LastName"><span class="question-number">2 -></span><span class="label-text">What is your <strong>last name</strong>?</span></label>
					<input class="infusion-field-input-container" id="inf_field_LastName" name="inf_field_LastName" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_field_Phone1"><span class="question-number">3 -></span><span class="label-text">What is the <strong>best number</strong> to reach you?</span></label>
					<input class="infusion-field-input-container" id="inf_field_Phone1" name="inf_field_Phone1" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_field_Email"><span class="question-number">4 -></span><span class="label-text">What is your <strong>email address</strong>?<span class="asterisk">*</span></span></label>
					<div class="subheading">(Please ensure spelling is correct)</div>
					<input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSSkypeId"><span class="question-number">5 -></span><span class="label-text">Got a Skype ID? This is the fastest way we can give you online support. Enter it here:</span></label>
					<input class="infusion-field-input-container" id="inf_custom_WLSSkypeId" name="inf_custom_WLSSkypeId" type="text" />
				</div>
				<div class="infusion-field gai">
					<label for="inf_custom_WLSGrossAnnualIncome"><span class="question-number">6 -></span><span class="label-text">What is your gross annual income? (Rough estimate)</span></label>
					<div class="subheading">Privacy policies apply to all information entered in this survey.</div>
					<div class="infusion-radio-wrapper">
						<div class="infusion-radio">
							<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_$10000-50000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="$10000-50000" />
								<label for="inf_custom_WLSGrossAnnualIncome_$10000-50000">$10,000-50,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
								<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_$50000-100000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="$50000-100000" />
								<label for="inf_custom_WLSGrossAnnualIncome_$50000-100000">$50,000-100,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
								<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_$100000-250000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="$100000-250000" />
								<label for="inf_custom_WLSGrossAnnualIncome_$100000-250000">$100,000-250,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
								<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_$250000-500000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="$250000-500000" />
								<label for="inf_custom_WLSGrossAnnualIncome_$250000-500000">$250,000-500,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
								<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_$500000-1000000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="$500000-1000000" />
								<label for="inf_custom_WLSGrossAnnualIncome_$500000-1000000">$500,000-1,000,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
								<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_$1000000-5000000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="$1000000-5000000" />
								<label for="inf_custom_WLSGrossAnnualIncome_$1000000-5000000">$1,000,000-5,000,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
								<span class="infusion-option">
								<input id="inf_custom_WLSGrossAnnualIncome_Above $5000000" name="inf_custom_WLSGrossAnnualIncome" type="radio" value="Above $5000000" />
								<label for="inf_custom_WLSGrossAnnualIncome_Above $5000000">Above $5,000,000</label>
								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>
							</span>
						</div>
					</div>
					<div style="width: 100%; clear: both;"></div>
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSPlannedInvestmentinSelfDevelopment"><span class="question-number">7 -></span><span class="label-text">Assuming we get the results and reach the goals you are after, how much are you willing to invest in self development per annum?</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSPlannedInvestmentinSelfDevelopment" name="inf_custom_WLSPlannedInvestmentinSelfDevelopment" type="text" />
				</div>
				<div class="infusion-field">
					<label><span class="question-number"></span><span class="label-text">You are about to begin the test.</span></label>
					<div class="subheading">All answers are completely private.</div>
					<div class="subheading">Instructions:<br>Rate the following 8 areas in your life between 1-100</div>
					<div class="subheading"><strong>1</strong> = I am currently at rock bottom and not reaching any amount of the potential I have<br><strong>100</strong> = I have reached full potential and am completely fulfilled and inspired and empowered in this area of life.</div>
					<div class="subheading">Please note that this is not how you WANT your life to be but how it actually IS. If you want to be in a relationship and you are NOT in a relationship then you are at 0 (for an example not 10 for the effort of looking for one). The more honest you are with yourself, the better your analysis and your results moving forward.</div>
				</div>
				<div class="infusion-field">
					<label for="inf_custom_MentalAndEmotionalState"><span class="question-number">8 -></span><span class="label-text">Mental and emotional state</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_MentalAndEmotionalState" name="inf_custom_MentalAndEmotionalState" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSCareerVocationPurpose"><span class="question-number">9 -></span><span class="label-text">Career/vocation/purpose</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSCareerVocationPurpose" name="inf_custom_WLSCareerVocationPurpose" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSRelationships"><span class="question-number">10 -></span><span class="label-text">Relationships</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSRelationships" name="inf_custom_WLSRelationships" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSTime"><span class="question-number">11 -></span><span class="label-text">Time</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSTime" name="inf_custom_WLSTime" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSFinancial"><span class="question-number">12 -></span><span class="label-text">Financial</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSFinancial" name="inf_custom_WLSFinancial" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSPhysicalHealth"><span class="question-number">13 -></span><span class="label-text">Physical Health</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSPhysicalHealth" name="inf_custom_WLSPhysicalHealth" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSSpiritualFulfillment"><span class="question-number">14 -></span><span class="label-text">Spiritual Fulfillment</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSSpiritualFulfillment" name="inf_custom_WLSSpiritualFulfillment" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSPersonalDevelopment"><span class="question-number">15 -></span><span class="label-text">Personal Development</span></label>
					<div class="subheading">Rate this aspect in your life from a scale of 1 (lowest) to 100 (highest).</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSPersonalDevelopment" name="inf_custom_WLSPersonalDevelopment" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSMein51020Years"><span class="question-number">16 -></span><span class="label-text">Where do you want to be in 5, 10 and 20 years from today?</span></label>
					<div class="subheading">Looking at the 8 areas of life above, please give us as much detail as possible. Describe EXACTLY what you want your life to look like. Don't hold back and don't be afraid to dig deep and dream big; pretend fear doesn't exist while answering this question.</div>
					<textarea class="infusion-field-input-container" id="inf_custom_WLSMein51020Years" name="inf_custom_WLSMein51020Years"></textarea>
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSRoadBlocks"><span class="question-number">17 -></span><span class="label-text">What are the 3 biggest road blocks in your life right now?</span></label>
					<textarea class="infusion-field-input-container" id="inf_custom_WLSRoadBlocks" name="inf_custom_WLSRoadBlocks"></textarea>
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSRoadBlocksNegativeImpact"><span class="question-number">18 -></span><span class="label-text">How have these 3 roadblocks been holding you back and negatively affecting your life?</span></label>
					<textarea class="infusion-field-input-container" id="inf_custom_WLSRoadBlocksNegativeImpact" name="inf_custom_WLSRoadBlocksNegativeImpact"></textarea>
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSTopValues"><span class="question-number">19 -></span><span class="label-text">In three single words, please tell us your top three values in your life.</span></label>
					<div class="subheading" style="font-style: italic;">What is most important to you? What do you spend your time and money on? What shows up as physical proof of this in your life? NOTE: This isn't what you THINK you should value. It's what is actually showing up the most in your life, What do you talk about the most? What would you do, if you could do anything you wanted in life? What inspires you? Where are you most organised and reliable?</div>
					<input class="infusion-field-input-container" id="inf_custom_WLSTopValues" name="inf_custom_WLSTopValues" type="text" />
				</div>
				<div class="infusion-field">
					<label for="inf_custom_WLSTopValues"><span class="question-number">20 -></span><span class="label-text">The Ultimate Wheel of Life</span></label>
					<div class="subheading">This is a picture of ideal balance.</div>
					<div class="subheading">(You will receive your results from our team within 24-48 hours.)</div>
					<div class="subheading" style="text-align: center; padding-left: 0;"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/pinnacle-wheel-of-live.png" style="width: 100%; max-width: 450px;"/></div>
				</div>
				<div class="validation-errors" id="validation-errors"></div>
				<div class="infusion-submit">
					<button class="submit" id="is-form-submit">REQUEST YOUR RESULTS</button>
				</div>
				<div class="infusion-field schedule-appointment">
					<label for="inf_custom_WLSTopValues"><span class="label-text" style="padding-left: 0;">Thank you for participating!</span></label>
					<div class="subheading" style="padding-left: 0;">By taking the Wheel of Life assessment you have completed the first step to personal mastery - self-discovery!</div>
					<a class="youcanbookme" href="https://drespen.youcanbook.me/">BOOK YOUR 30-MINUTE COMPLIMENTARY STRATEGY SESSION</a>
				</div>
			</div>
<?php endwhile; ?>
