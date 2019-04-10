<?php

/**

 * Template Name: General Page - Typeform Survey 2 New

 */

?>


<?php while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'templates/page', 'header' );

	$upload_dir = wp_upload_dir(); ?>

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

		position: relative;

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



	button.submit-clicked {

		color: #C94429;

	}



	.gai .infusion-radio-wrapper , .gai2 .infusion-radio-wrapper{

		margin-left: 45px;

	}



	.gai input, .gai2 input{

		display: none;

	}



	.gai span.infusion-option,.gai2 span.infusion-option {

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



	.gai span.infusion-option label,.gai2 span.infusion-option label {

		color: #0089A1;

		font-size: 19px;

		padding-bottom: 0;

		margin-bottom: 0;

		cursor: pointer;

	}



	.gai span.infusion-option span.tick, .gai2 span.infusion-option span.tick {

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



	.submit-loading-img {

		position: absolute;

		left: 50%;

		margin-left: -17px;

		display: none;

	}



	.submit-loading-img-active {

		display: block;

	}

</style>

			<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

			<script type="text/javascript">

				jQuery(document).ready(function () {

					jQuery( ".gai span.infusion-option label" ).click(function() {

						jQuery(document).find("span.tick").hide();

						jQuery(this).parent().find("span.tick").show();

					});
					jQuery( ".gai2 span.infusion-option label" ).click(function() {

						jQuery(".gai2").find("span.tick").hide();

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
						 if( jQuery("#inf_field_LastName").val() == '' ) {

							errors.push('Last Name is required');

							error_fields.push( jQuery("#inf_field_LastName") );

						} 
						if( jQuery("#inf_field_Phone1").val() == '' ) {

							errors.push('Phone is required');

							error_fields.push( jQuery("#inf_field_Phone1") );

						} 
						
						if( jQuery("#inf_custom_MentalAndEmotionalState").val() == '' ) {

							errors.push('Mental and Emotional State is required');

							error_fields.push( jQuery("#inf_custom_MentalAndEmotionalState") );

						} 
					  
						if( jQuery("#inf_custom_Family").val() == '' ) {

							errors.push('Relationships is required');

							error_fields.push( jQuery("#inf_custom_Family") );

						} 
						if( jQuery("#inf_custom_Time").val() == '' ) {

							errors.push('Time is required');

							error_fields.push( jQuery("#inf_custom_Time") );

						} 
						if( jQuery("#inf_custom_Financial").val() == '' ) {

							errors.push('Financial is required');

							error_fields.push( jQuery("#inf_custom_Financial") );

						} 
						if( jQuery("#inf_custom_CareerMission").val() == '' ) {

							errors.push(' Career/Mission is required');

							error_fields.push( jQuery("#inf_custom_CareerMission") );

						} 
						if( jQuery("#inf_custom_SpiritualFulfillment").val() == '' ) {

							errors.push('Spiritual Fulfillment is required');

							error_fields.push( jQuery("#inf_custom_SpiritualFulfillment") );

						} 
						if( jQuery("#inf_custom_WLSMein12months").val() == '' ) {

							errors.push('Months from today is required');

							error_fields.push( jQuery("#inf_custom_WLSMein12months") );

						} 
						if( jQuery("#inf_custom_WLSMein10Years").val() == '' ) {

							errors.push('Years from today is required');

							error_fields.push( jQuery("#inf_custom_WLSMein10Years") );

						} 
						if( jQuery("#inf_custom_WLSRoadBlocks").val() == '' ) {

							errors.push('Road blocks is required');

							error_fields.push( jQuery("#inf_custom_WLSRoadBlocks") );

						} 
						if( jQuery("#inf_custom_WLSpersonalorprofessionalvision").val() == '' ) {

							errors.push('Personal or professional vision is required');

							error_fields.push( jQuery("#inf_custom_WLSpersonalorprofessionalvision") );

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



						jQuery( this ).find( ".submit-loading-img" ).addClass( "submit-loading-img-active" );

						jQuery( this ).addClass( "submit-clicked" );



						var data = {

						'action': 'submit_wheel_of_life_survey',
							'inf_field_FirstName': jQuery( "#inf_field_FirstName" ).val(),
							'inf_field_LastName': jQuery( "#inf_field_LastName" ).val(),
							'inf_field_Phone1': jQuery( "#inf_field_Phone1" ).val(),
							'inf_field_Email': jQuery( "#inf_field_Email" ).val(),
							'inf_custom_WLSFacebook': jQuery( "#inf_custom_WLSFacebook" ).val(),
							'inf_custom_MentalAndEmotionalState': jQuery( "#inf_custom_MentalAndEmotionalState" ).val(),
 							'inf_custom_Family': jQuery( "#inf_custom_Family" ).val(),
							'inf_custom_Time': jQuery( "#inf_custom_Time" ).val(),
 							'inf_custom_Financial': jQuery( "#inf_custom_Financial" ).val(),
							'inf_custom_PhysicalHealth': jQuery( "#inf_custom_PhysicalHealth" ).val(),
							'inf_custom_CareerMission': jQuery( "#inf_custom_CareerMission" ).val(),
							'inf_custom_SpiritualFulfillment': jQuery( "#inf_custom_SpiritualFulfillment" ).val(),
							'inf_custom_WLSMein12months': jQuery( "#inf_custom_WLSMein12months" ).val(),
							'inf_custom_WLSMein10Years': jQuery( "#inf_custom_WLSMein10Years" ).val(),
							'inf_custom_WLSRoadBlocks': jQuery( "#inf_custom_WLSRoadBlocks" ).val(),
							'inf_custom_WLSpersonalorprofessionalvision': jQuery( "#inf_custom_WLSpersonalorprofessionalvision" ).val(),
							'inf_custom_WLSPinnacleWheelofLife': jQuery( "#inf_custom_WLSPinnacleWheelofLife" ).val(),
							'inf_custom_Thankforreferringyou': jQuery( "#inf_custom_Thankforreferringyou" ).val(),
							
							 
							'inf_custom_WLSGrossAnnualIncome': jQuery( ".gai span.infusion-option .tick:visible" ).parent().find( "input" ).val(),
							'inf_option_WLSPlannedInvestmentinSelfDevelopment': jQuery( ".gai2 span.infusion-option .tick:visible" ).parent().find( "input" ).val()

						};



						console.log( 'form-submited' );

						jQuery.post( <?php echo "'" . admin_url( 'admin-ajax.php' ) . "'"; ?>, data, function( response ) {

							console.log( response );

							window.location = 'https://www.drespen.com/wheel-of-life-session-booking?email=' + jQuery( "#inf_field_Email" ).val();

						});

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

				<h2>Take your time and answer truthfully. This test will identify your life's areas of improvement and how Dr. Espen and team can help you align your own true values with your life’s vision and purpose.</h2>

			</div>
			<div class="is_form_wrapper">
				<input name="inf_form_xid" type="hidden" value="105daaa51770c22ac2c49f249b78d3eb" />
				<input name="inf_form_name" type="hidden" value="Wheel of Life Survey Webform" />
				<input name="infusionsoft_version" type="hidden" value="1.69.0.47575" />
				<div class="infusion-field">

					<label for="inf_field_FirstName"><span class="question-number">1 -></span><span class="label-text">What is your <strong>first name</strong>?<span class="asterisk">*</span></span></label>

 					<input class="infusion-field-input-container" id="inf_field_FirstName" name="inf_field_FirstName" type="text" />
				</div>
				<div class="infusion-field">

					<label for="inf_field_LastName"><span class="question-number">2 -></span><span class="label-text">What is your <strong>last name</strong>?<span class="asterisk">*</span></span></label>

					<input class="infusion-field-input-container" id="inf_field_LastName" name="inf_field_LastName" type="text" />

				</div>
				
				<div class="infusion-field">

					<label for="inf_field_Phone1"><span class="question-number">3 -></span><span class="label-text">What is the <strong>best number</strong> to reach you?<span class="asterisk">*</span></span></label>

 					<input class="infusion-field-input-container" id="inf_field_Phone1" name="inf_field_Phone1" type="text" />

				</div>
				
				<div class="infusion-field">

					<label for="inf_field_Email"><span class="question-number">4 -></span><span class="label-text">What is your <strong>email address</strong>?<span class="asterisk">*</span></span></label>

					<div class="subheading">(Please ensure spelling is correct)</div>

					<input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="text" />

				</div>
				
				
				<div class="infusion-field">

					<label for="inf_custom_WLSFacebook"><span class="question-number">5 -></span><span class="label-text">What is your<strong> Facebook name</strong>? This is the fastest way we can give you online support. Enter it here:</span></label>

					 
					<input class="infusion-field-input-container" id="inf_custom_WLSFacebook" name="inf_custom_WLSFacebook" type="text" />

				</div>
				
				<div class="infusion-field">

					<label for="inf_custom_Thankforreferringyou"><span class="question-number">6 -></span><span class="label-text">Who can we thank for referring you to the Dr Espen Coaching team?</label>
 					<input class="infusion-field-input" id="inf_custom_Thankforreferringyou" name="inf_custom_Thankforreferringyou" type="text" />

				</div>
				
				<div class="infusion-field gai">

					<label for="inf_custom_WLSGrossAnnualIncome"><span class="question-number">7 -></span><span class="label-text">What is your gross annual income? (Rough estimate)</span></label>

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
				
				
				
				
				<div class="infusion-field gai2">

					<label for="inf_custom_WLSGrossAnnualIncome"><span class="question-number">8 -></span><span class="label-text">Assuming we get the results and reach the goals you are after, how much are you willing to invest in <strong>self-development </strong>per annum?</span></label>

					<div class="subheading">Privacy policies apply to all information entered in this survey.</div>

					<div class="infusion-radio-wrapper">

						<div class="infusion-radio">

							<span class="infusion-option">

 								<input id="inf_option_WLSPlannedInvestmentinSelfDevelopment_738" name="inf_option_WLSPlannedInvestmentinSelfDevelopment" type="radio" value="$10000-20000" />
 								<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment_738">$10,000 - $20,000</label>

								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>

							</span>

								<span class="infusion-option">

								<input id="inf_option_WLSPlannedInvestmentinSelfDevelopment_740" name="inf_option_WLSPlannedInvestmentinSelfDevelopment" type="radio" value="$21000-30000" />

								<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment_740">$21,000 - $30,000</label>

								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>

							</span>

								<span class="infusion-option">

								<input id="inf_option_WLSPlannedInvestmentinSelfDevelopment_742" name="inf_option_WLSPlannedInvestmentinSelfDevelopment" type="radio" value="$31000-40000" />

								<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment_742">$31,000 - $40,000</label>

								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>

							</span>

								<span class="infusion-option">

								<input id="inf_option_WLSPlannedInvestmentinSelfDevelopment_744" name="inf_option_WLSPlannedInvestmentinSelfDevelopment" type="radio" value="$41000-50000" />

								<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment_744">$41,000 - $50,000</label>

								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>

							</span>

								<span class="infusion-option">

								<input id="inf_option_WLSPlannedInvestmentinSelfDevelopment_746" name="inf_option_WLSPlannedInvestmentinSelfDevelopment" type="radio" value="$51000-60000" />

								<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment_746">$51,000 - $60,000</label>

								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>

							</span>

								<span class="infusion-option">

								<input id="inf_option_WLSPlannedInvestmentinSelfDevelopment_748" name="inf_option_WLSPlannedInvestmentinSelfDevelopment" type="radio" value="Above $61000" />

								<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment_748">$61,000 and up</label>

								<span class="tick"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-tick.jpg" /></span>

							</span>


						</div>

					</div>

					<div style="width: 100%; clear: both;"></div>

				</div>
				<div class="infusion-field">

					<label><span class="question-number"></span><span class="label-text">You are about to begin the test.</span></label>

					<div class="subheading">All answers are completely private.</div>

					<div class="subheading">Instructions:<br>Rate the following 8 areas in your life between 1-10</div>

					<div class="subheading"><strong>1</strong> = I am currently at rock bottom and not reaching any amount of the potential I have<br><strong>10</strong> = I have reached full potential and am completely fulfilled and inspired and empowered in this area of life.</div>

					<div class="subheading">Please note that this is not how you WANT your life to be but how it actually IS. If you want to be in a relationship and you are NOT in a relationship then you are at 0 (for an example not 10 for the effort of looking for one). The more honest you are with yourself, the better your analysis and your results moving forward.</div>

				</div>
				<div class="infusion-field">
					<label for="inf_custom_MentalAndEmotionalState"><span class="question-number">9 -></span><span class="label-text">1. Mental and Emotional State?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
 					<input class="infusion-field-input" id="inf_custom_MentalAndEmotionalState" name="inf_custom_MentalAndEmotionalState" type="text" />

				</div>
				
				<div class="infusion-field">
					<label for="inf_custom_CareerMission"><span class="question-number">10 -></span><span class="label-text">2. Career/Vocation/Purpose?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_CareerMission" name="inf_custom_CareerMission" type="text" />

				</div>
				<div class="infusion-field">
					<label for="inf_custom_Family"><span class="question-number">11 -></span><span class="label-text">3. Relationships?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_Family" name="inf_custom_Family" type="text" />

				</div>
				
				<div class="infusion-field">
					<label for="inf_custom_Time"><span class="question-number">12 -></span><span class="label-text">4. Time?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_Time" name="inf_custom_Time" type="text" />

				</div>
				<div class="infusion-field">
					<label for="inf_custom_Financial"><span class="question-number">13 -></span><span class="label-text">5. Financial?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_Financial" name="inf_custom_Financial" type="text" />

				</div>
				
				<div class="infusion-field">
					<label for="inf_custom_PhysicalHealth"><span class="question-number">14 -></span><span class="label-text">6. Physical Health?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_PhysicalHealth" name="inf_custom_PhysicalHealth" type="text" />

				</div>
				 
				
				<div class="infusion-field">
					<label for="inf_custom_SpiritualFulfillment"><span class="question-number">15 -></span><span class="label-text">7. Spiritual Fulfillment?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_SpiritualFulfillment" name="inf_custom_SpiritualFulfillment" type="text" />

				</div>
				 
				<div class="infusion-field">
					<label for="inf_custom_PersonalDevelopment"><span class="question-number">16 -></span><span class="label-text">8. Personal Development ?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<input class="infusion-field-input" id="inf_custom_PersonalDevelopment" name="inf_custom_PersonalDevelopment" type="text" />

				</div> 
				
				<div class="infusion-field">

					<label for="inf_custom_WLSMein12months"><span class="question-number">17 -></span><span class="label-text">Where do you want to be in 12 months from today?</label>
					<div class="subheading">Looking at the 8 areas of life above, please give us as much detail as possible. Describe EXACTLY what you want your life to look like. Don't hold back and don't be afraid to dig deep and dream big; pretend fear doesn't exist while answering this question.</div>

					<textarea cols="24" id="inf_custom_WLSMein12months" name="inf_custom_WLSMein12months" rows="5"></textarea>

				</div>
			
				
				<div class="infusion-field">

					<label for="inf_custom_WLSMein10Years"><span class="question-number">18 -></span><span class="label-text">Where do you want to be in 10 years from today?</label>
 					<div class="subheading">Please consider each area of life.</div>

					<textarea cols="24" id="inf_custom_WLSMein10Years" name="inf_custom_WLSMein10Years" rows="5"></textarea>

				</div>
				<div class="infusion-field">

					<label for="inf_custom_WLSRoadBlocks"><span class="question-number">19 -></span><span class="label-text">What are the 3 biggest road blocks in your life right now?</label>
					<textarea cols="24" id="inf_custom_WLSRoadBlocks" name="inf_custom_WLSRoadBlocks" rows="5"></textarea>


				</div>
				<div class="infusion-field">

					<label for="inf_custom_WLSpersonalorprofessionalvision"><span class="question-number">20 -></span><span class="label-text">Do you have a personal or professional vision for your life?
					If so what is it?</label>
 
					<input class="infusion-field-input" id="inf_custom_WLSpersonalorprofessionalvision" name="inf_custom_WLSpersonalorprofessionalvision" type="text" />
				</div>
				<div class="infusion-field">

					<label for="inf_custom_WLSPinnacleWheelofLife"><span class="question-number">21 -></span><span class="label-text"><strong>In three single words</strong>, please tell us your top three values in your life.?</label>
					<div class="subheading">What is most important to you? What do you spend your time and money on? What shows up as physical proof of this in your life? NOTE: This isn't what you THINK you should value. It's what is actually showing up the most in your life, What do you talk about the most? What would you do, if you could do anything you wanted in life? What inspires you? Where are you most organised and reliable?</div>
					<input class="infusion-field-input" id="inf_custom_WLSTopValues" name="inf_custom_WLSTopValues" type="text" />


				</div>
				 <div class="infusion-field">

					<label for="inf_custom_WLSPinnacleWheelofLife"><span class="question-number">22 -></span><span class="label-text">The Ultimate Wheel of Life</label>
					<div class="subheading">The Ultimate Wheel of Life should be both Full and Symmetrical. Here is an example of what a 90% Fulfillment and Balance in Life looks like:<br>(You will receive your results from our team within 24-48 hours.)</div>
					<img src="<?php echo $upload_dir['baseurl']; ?>/2018/06/pinnacle-wheel-of-live.png" style="width: 100%; max-width: 450px;"/>
					<input class="infusion-field-input" id="inf_custom_WLSPinnacleWheelofLife" name="inf_custom_WLSPinnacleWheelofLife" type="text" />

				</div>
				
				 
				
				<div style="height:15px; line-height:15px;">
					&nbsp;
				</div>
				<div class="validation-errors" id="validation-errors"></div>

				<div class="infusion-submit">

					<button class="submit" id="is-form-submit"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/10/ajax-loader.gif" class="submit-loading-img" />REQUEST YOUR RESULTS</button>

				</div>


			</div>	
	<script type="text/javascript" src="https://jw315.infusionsoft.com/app/webTracking/getTrackingCode"></script>
<script type="text/javascript" src="https://jw315.infusionsoft.com/app/timezone/timezoneInputJs?xid=105daaa51770c22ac2c49f249b78d3eb"></script>
	
	
<?php endwhile; ?>