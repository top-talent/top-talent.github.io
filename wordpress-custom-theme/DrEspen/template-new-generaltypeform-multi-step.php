<?php

/**

 * Template Name: General Page - Typeform Survey 2 Multi-step

 */

?>


<?php while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'templates/page', 'header' );

	$upload_dir = wp_upload_dir(); ?>

<link id="font" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&text=" rel="stylesheet" type="text/css">

<body>
<div class="survey-header">

	<!--img src="<?php //echo $upload_dir['baseurl']; ?>/2016/09/wheel-of-life-survey-logo.png" style="width: 100%; max-width: 450px;"/>

	<h1>Wheel of Life Survey</h1>

	<h2>Take your time and answer truthfully. This test will identify your life's areas of improvement and how Dr. Espen and team can help you align your own true values with your life’s vision and purpose.</h2-->

</div>
<div class="is_form_wrapper">
	<form id="regForm" method="post">
 	  <!-- One "tab" for each step in the form: -->
		<div class="tab">
			<div class="infusion-field">

				<label><span class="question-number"></span><span class="label-text">You are about to begin the test.</span></label>

				<div class="subheading">All answers are completely private.</div>

				<div class="subheading">Instructions:<br>Rate the following 8 areas in your life between 1-10</div>

				<div class="subheading"><strong>1</strong> = I am currently at rock bottom and not reaching any amount of the potential I have<br><strong>10</strong> = I have reached full potential and am completely fulfilled, inspired and empowered in this area of life.</div>

				<div class="subheading">Please note that this is not how you WANT your life to be but how it actually IS. If you want to be in a relationship and you are NOT in a relationship then you are at 0 (for an example not 10 for the effort of looking for one). The more honest you are with yourself, the better your analysis and your results moving forward.</div>
				<div class="infusion-field">
					<label for="inf_custom_MentalAndEmotionalState"><span class="question-number">1 -></span><span class="label-text"> Mental and Emotional State?<span class="asterisk">*</span></span></label>
					<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
					<!--input class="infusion-field-input" id="inf_custom_MentalAndEmotionalState" name="inf_custom_MentalAndEmotionalState" type="text" /-->
					<div class="subheading">
						<div id="demo1"></div>
						<input type="hidden" id="inf_custom_MentalAndEmotionalState" name="inf_custom_MentalAndEmotionalState" class="demo1-result1" value="1">
					</div>
				</div>
				<div class="infusion-field">

					<label for="MentalAndEmotionalState_feel"><span class="question-number">2 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
					<textarea cols="24" id="MentalAndEmotionalState_feel" name="MentalAndEmotionalState_feel" rows="5"></textarea>


				</div>	

			</div>

		</div>
		<div class="tab">
		
			<div class="infusion-field">
				<label for="inf_custom_CareerMission"><span class="question-number">3 -></span><span class="label-text">Career/Vocation/Purpose?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_CareerMission" name="inf_custom_CareerMission" type="text" /-->
				<div class="subheading">
					<div id="demo2"></div>
					<input type="hidden" id="inf_custom_CareerMission" name="inf_custom_CareerMission" class="demo1-result2" value="1">
                </div>
			</div>
			<div class="infusion-field">

				<label for="CareerMission_feel"><span class="question-number">4 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="CareerMission_feel" name="CareerMission_feel" rows="5"></textarea>


			</div>
		

		</div>
		<div class="tab">
			<div class="infusion-field">
				<label for="inf_custom_Family"><span class="question-number">5 -></span><span class="label-text">Relationships?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_Family" name="inf_custom_Family" type="text" /-->
				<div class="subheading">
					<div id="demo3"></div>
					<input type="hidden" id="inf_custom_Family" name="inf_custom_Family" class="demo1-result3" value="1">
				</div>

			</div>
			<div class="infusion-field">

				<label for="Family_feel"><span class="question-number">6 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="Family_feel" name="Family_feel" rows="5"></textarea>


			</div>
					
				

		</div>
		<div class="tab">
			<div class="infusion-field">
				<label for="inf_custom_Time"><span class="question-number">7-></span><span class="label-text">Time?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_Time" name="inf_custom_Time" type="text" /-->
				<div class="subheading">
					<div id="demo4"></div>
					<input type="hidden" id="inf_custom_Time" name="inf_custom_Time" class="demo1-result4" value="1">
				</div>

			</div>
			<div class="infusion-field">

				<label for="Time_feel"><span class="question-number">8 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="Time_feel" name="Time_feel" rows="5"></textarea>


			</div>
		

		</div>
		<div class="tab"> 
			<div class="infusion-field">
				<label for="inf_custom_Financial"><span class="question-number">9 -></span><span class="label-text">Financial?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_Financial" name="inf_custom_Financial" type="text" /-->
				<div class="subheading">
					<div id="demo5"></div>
					<input type="hidden" id="inf_custom_Financial" name="inf_custom_Financial" class="demo1-result5" value="1">
				</div>

			</div>
			<div class="infusion-field">

				<label for="Financial_feel"><span class="question-number">10 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="Financial_feel" name="Financial_feel" rows="5"></textarea>


			</div>
				
		</div>		
		<div class="tab"> 
			<div class="infusion-field">
				<label for="inf_custom_PhysicalHealth"><span class="question-number">11 -></span><span class="label-text">Physical Health?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_PhysicalHealth" name="inf_custom_PhysicalHealth" type="text" /-->
				<div class="subheading">
					<div id="demo6"></div><input type="hidden" id="inf_custom_PhysicalHealth" name="inf_custom_PhysicalHealth" class="demo1-result6" value="1">
				</div>

			</div>
			<div class="infusion-field">

				<label for="PhysicalHealth_feel"><span class="question-number">12 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="PhysicalHealth_feel" name="PhysicalHealth_feel" rows="5"></textarea>


			</div>
		</div>
		<div class="tab">
	
			<div class="infusion-field">
				<label for="inf_custom_SpiritualFulfillment"><span class="question-number">13-></span><span class="label-text">Spiritual Fulfillment?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_SpiritualFulfillment" name="inf_custom_SpiritualFulfillment" type="text" /-->
				<div class="subheading">
				  <div id="demo7"></div><input type="hidden" id="inf_custom_SpiritualFulfillment" name="inf_custom_SpiritualFulfillment" class="demo1-result7" value="1">
				</div>

			</div>
			<div class="infusion-field">

				<label for="SpiritualFulfillment_feel"><span class="question-number">14 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="SpiritualFulfillment_feel" name="SpiritualFulfillment_feel" rows="5"></textarea>


			</div>
		
		</div>
		<div class="tab"> 
			<div class="infusion-field">
				<label for="inf_custom_PersonalDevelopment"><span class="question-number">15-></span><span class="label-text"> Personal Development ?<span class="asterisk">*</span></span></label>
				<div class="subheading">Rate this aspect in your life in a scale of 1 (lowest) to 10 (highest).</div>
				<!--input class="infusion-field-input" id="inf_custom_PersonalDevelopment" name="inf_custom_PersonalDevelopment" type="text" /-->
				<div class="subheading">
				  <div id="demo8"></div><input type="hidden" id="inf_custom_PersonalDevelopment" name="inf_custom_PersonalDevelopment" class="demo1-result8" value="1">
				</div>

			</div>
			<div class="infusion-field">

				<label for="PersonalDevelopment_feel"><span class="question-number">16 -></span><span class="label-text">How does your score above make you feel? (optional)</label>
				<textarea cols="24" id="PersonalDevelopment_feel" name="PersonalDevelopment_feel" rows="5"></textarea>


			</div>			
		</div>
		<div style="overflow:auto;">
			<div style="float:right;">
			<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
 			  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
			</div>
		</div>
	  <!-- Circles which indicates the steps of the form: -->
	  <div style="text-align:center;margin:40px;">
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
	  </div>
	</form>
<form id="final-submit" method="post" style="display:none">
	<div class="is_form_wrapper">
		<div class="infusion-field step-2-heading">
			<span class="">Well done on your wheel, almost there!</br>
			So we can find the best Coach to assist you, please provide your details below.</span>
		</div>
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
					<div class="subheading">Do You Wish To Receive A Complimentary Strategy Session With One Of Our Qualified Coaches (Value $175).</div>
					<div class="complimentary"><span class="yes">Yes</span><span class="no">No</span></div>
				</div>
				<div class="infusion-field custom_WLSPinnacleWheelofLife" style="display:none;">

					<label for="inf_custom_WLSPinnacleWheelofLife"><span class="question-number"></span><span class="label-text"><strong>In three single words</strong>, please tell us your top three values in your life.?</span></label>
					<div class="subheading">What is most important to you? What do you spend your time and money on? What shows up as physical proof of this in your life? NOTE: This isn't what you THINK you should value. It's what is actually showing up the most in your life, What do you talk about the most? What would you do, if you could do anything you wanted in life? What inspires you? Where are you most organised and reliable?</div>
					<input class="infusion-field-input" id="inf_custom_WLSTopValues" name="inf_custom_WLSTopValues" type="text" />


				</div> 
				<div class="infusion-field custom_Thankforreferringyou">

					<label for="inf_custom_Thankforreferringyou"><span class="question-number"></span><span class="label-text">Who can we thank for referring you to the Dr Espen Coaching team?</span></label>
 					<input class="infusion-field-input" id="inf_custom_Thankforreferringyou" name="inf_custom_Thankforreferringyou" type="text" />

				</div>
				
				<div class="infusion-field custom-inf-WLSMein12months">

					<label for="inf_custom_WLSMein12months "><span class="question-number">6 -></span><span class="label-text">Where do you want to be in 12 months from today?</span></label>
					<div class="subheading">Looking at the 8 areas of life above, please give us as much detail as possible. Describe EXACTLY what you want your life to look like. Don't hold back and don't be afraid to dig deep and dream big; pretend fear doesn't exist while answering this question.</div>

					<textarea cols="24" id="inf_custom_WLSMein12months" name="inf_custom_WLSMein12months" rows="5"></textarea>

				</div>
					
						
				<div class="infusion-field  custom-inf-WLSMein10Years">

					<label for="inf_custom_WLSMein10Years"><span class="question-number">7 -></span><span class="label-text">Where do you want to be in 10 years from today?</span></label>
					<div class="subheading">Please consider each area of life.</div>

					<textarea cols="24" id="inf_custom_WLSMein10Years" name="inf_custom_WLSMein10Years" rows="5"></textarea>

				</div>
						
						
				<div class="infusion-field custom-inf-WLSRoadBlocks">

					<label for="inf_custom_WLSRoadBlocks "><span class="question-number">8 -></span><span class="label-text">What are the 3 biggest road blocks in your life right now?</span></label>
					<textarea cols="24" id="inf_custom_WLSRoadBlocks" name="inf_custom_WLSRoadBlocks" rows="5"></textarea>


				</div>
				<div class="infusion-field custom-inf-WLS">

					<label for="inf_custom_WLSpersonalorprofessionalvision "><span class="question-number">9 -></span><span class="label-text">Do you have a personal or professional vision for your life?
					If so what is it?</span></label>

					<input class="infusion-field-input" id="inf_custom_WLSpersonalorprofessionalvision" name="inf_custom_WLSpersonalorprofessionalvision" type="text" />
				</div>
				
				
				<div class="infusion-field gai custom-gai">

					<label for="inf_custom_WLSGrossAnnualIncome"><span class="question-number">11 -></span><span class="label-text">What is your gross annual income? (Rough estimate)</span></label>

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
				
				
				
				
				<div class="infusion-field gai2 custom-gai2">

					<label for="inf_option_WLSPlannedInvestmentinSelfDevelopment"><span class="question-number">12 -></span><span class="label-text">Assuming we get the results and reach the goals you are after, how much are you willing to invest in <strong>self-development </strong>per annum?</span></label>

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
		 
	 
		
		
	
				
			
			 <div class="infusion-field custom-info-pinnacle">

				<label for="inf_custom_WLSPinnacleWheelofLife"><span class="question-number custom-question-number">13 -></span><span class="label-text">The Ultimate Wheel of Life</span></label>
				<div class="subheading">The Ultimate Wheel of Life image does not show the 90% wheel being filled (as in the optimal wheel at 9/10 in all areas)</div>
				<img src="<?php echo $upload_dir['baseurl']; ?>/2018/06/pinnacle-wheel-of-live-new.png" style="width: 100%; max-width: 450px;"/>
			 
			</div>
			<div style="height:15px; line-height:15px;">
				&nbsp;
			</div>
				
			<div class="validation-errors" id="validation-errors"></div>

			<div class="infusion-submit"> 
                <input type="hidden" name="status" id="wol-status" value="WOLSS">
				<button class="submit" id="is-form-submit"><img src="<?php echo $upload_dir['baseurl']; ?>/2016/10/ajax-loader.gif" class="submit-loading-img" />Request your results</button>

			</div>

	</div>
</form>

	<div class="thank-you" style="display:none">
		<h2>Thank you for participating!</h2>
		<p>By taking the Wheel of Life assessment you have completed the first step to personal mastery - self-discovery!
		<br><br>
		To reach personal power and fulfillment (to fill full) in life, further work is needed.<br>
		Book your 30-minute complimentary, non-obligatory life evaluation and action plan session, (actual value $375) with one of our Dr. Espen Coaches.
		<br>
		 <a href="https://drespen.youcanbook.me/" target="__blank">Click here</a>
		<br>
		Yours in Health and Peak Performance, <br>
		<span style="font-size: 25px; padding-top: 15px; display: block;">Dr. Espen Team</span>
		<br>
	
		<!--<div id="chartContainer" style="height: 370px; width: 100%;"></div>-->
		<div id="canvas-holder" style="width:60%">
		<canvas id="chart-area"></canvas>
		</div>

	
	</div>
 
</div>
<!--<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->
<script src="http://www.chartjs.org/docs/latest/gitbook/gitbook-plugin-chartjs/Chart.bundle.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/scripts/utils.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/scripts/ion.rangeSlider.min.js"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/styles/ion.rangeSlider.css" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/styles/normalize.css" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/styles/ion.rangeSlider.skinHTML5.css" />
             
<!-- plus a jQuery UI theme, here I use "flick" -->
 <script>
jQuery(document).ready(function(){ 
var $range = jQuery("#demo1,#demo2,#demo3,#demo4,#demo5,#demo6,#demo7,#demo8"),
    $result = jQuery(".demo1-result"),
    $getvalues = jQuery(".js-get-values"),
    
    from = 0,
    to = 0;

var saveResult1 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result1").val(from)
};
var saveResult2 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result2").val(from)
};
var saveResult3 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result3").val(from)
};
var saveResult4 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result4").val(from)
};
var saveResult5 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result5").val(from)
};
var saveResult6 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result6").val(from)
};
var saveResult7 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result7").val(from)
};
var saveResult8 = function (data) {
    from = data.from;
    to = data.to;
	 jQuery(".demo1-result8").val(from)
};

 
	jQuery("#demo1").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult1(data);},to: to });
	jQuery("#demo2").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult2(data);},to: to });
	jQuery("#demo3").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult3(data);},to: to });
	jQuery("#demo4").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult4(data);},to: to });
	jQuery("#demo5").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult5(data);},to: to });
	jQuery("#demo6").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult6(data);},to: to });
	jQuery("#demo7").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult7(data);},to: to });
	jQuery("#demo8").ionRangeSlider({type: "single",min: 1,max: 10,step: 1,from: from,onChange: function (data) {saveResult8(data);},to: to });
 
	jQuery( ".gai span.infusion-option label" ).click(function() {

		jQuery(".gai").find("span.tick").hide();

		jQuery(this).parent().find("span.tick").show();
		jQuery(this).parent().find("input").attr('checked', true);
		jQuery(this).parent().find("span.tick").addClass("visible");
	});
	jQuery( ".gai2 span.infusion-option label" ).click(function() {

		jQuery(".gai2").find("span.tick").hide();

		jQuery(this).parent().find("span.tick").show();
		jQuery(this).parent().find("input").attr('checked', true);
		jQuery(this).parent().find("span.tick").addClass("visible");

	});
	jQuery(".complimentary .yes").on("click",function(){
		jQuery(".custom_WLSPinnacleWheelofLife").show();
		jQuery(".custom_Thankforreferringyou").show();
		jQuery('.custom-gai,.custom-gai2,.custom-inf-WLSMein12months,.custom-inf-WLSMein10Years,.custom-inf-WLSRoadBlocks,.custom-inf-WLS').show();
		
	});
	jQuery(".complimentary .no").on("click",function(){
		jQuery(".custom_WLSPinnacleWheelofLife").hide();
		//jQuery(".custom_Thankforreferringyou").show();
		jQuery('.custom-gai,.custom-gai2,.custom_Thankforreferringyou,.custom-inf-WLSMein12months,.custom-inf-WLS,.custom-inf-WLSMein10Years,.custom-inf-WLSRoadBlocks').hide();
		jQuery('#inf_custom_WLSTopValues,#inf_custom_Thankforreferringyou,#inf_custom_WLSMein12months,#inf_custom_WLSpersonalorprofessionalvision,#inf_custom_WLSMein10Years,#inf_custom_WLSRoadBlocks').val('');
        jQuery('input[type="radio"]').attr('checked', false);
		jQuery('.custom-gai .tick,.custom-gai2 .tick').removeClass('visible'); // Unchecks it
        jQuery('.custom-gai .tick,.custom-gai2 .tick').css('display','none');
		
	});
});
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
	jQuery('html, body').animate({
        scrollTop: jQuery("#page-top").offset().top
    }, 500);
   // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
	//alert(jQuery("#inf_custom_MentalAndEmotionalState").val());
    /* document.getElementById("regForm").submit();
    return false; */
	jQuery("#regForm").hide();
	jQuery("#final-submit").show();
  }
  
  // Otherwise, display the correct tab:
  showTab(currentTab);
 
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  } 
  if(jQuery('.gai').parent(".tab:visible").length != 0){
		if(jQuery('.gai').find("input:checked").length <= 0){
			jQuery(".gai .required").hide();
			jQuery(".gai").append('<span class="required">* This is required</span>');
		  valid = false;
		}else{
			jQuery(".gai .required").hide();
		}
		if(jQuery('.gai2').find("input:checked").length <= 0){
			jQuery(".gai2 .required").hide();
			jQuery(".gai2").append('<span class="required">* This is required</span>');
		  valid = false;
		}else{
			jQuery(".gai2 .required").hide();
		}
  }
  
  
  //valid = true;
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  var j, y = document.getElementsByClassName("icon-tab");
  var k, z = document.getElementsByClassName("video_image");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
  for (j = 0; j < y.length; j++) {
    //y[j].className = y[j].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  y[n].className += " active";
  for (k = 0; k < z.length; k++) {
    z[k].className = z[k].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  z[n].className += " active";
}


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

	'action': 'save_wheel_of_life_survey',
	"submit":"WOL",
		'inf_field_FirstName': jQuery( "#inf_field_FirstName" ).val(),
		'inf_field_LastName': jQuery( "#inf_field_LastName" ).val(),
		'inf_field_Phone1': jQuery( "#inf_field_Phone1" ).val(),
		'inf_field_Email': jQuery( "#inf_field_Email" ).val(),
		'inf_custom_WLSFacebook': jQuery( "#inf_custom_WLSFacebook" ).val(),
		'inf_custom_MentalAndEmotionalState': jQuery( "#inf_custom_MentalAndEmotionalState" ).val(),
		'MentalAndEmotionalState_feel': jQuery( "#MentalAndEmotionalState_feel" ).val(),
		'inf_custom_Family': jQuery( "#inf_custom_Family" ).val(),
		'Family_feel': jQuery( "#Family_feel" ).val(),
		'inf_custom_Time': jQuery( "#inf_custom_Time" ).val(),
		'Time_feel': jQuery( "#Time_feel" ).val(),
		'inf_custom_Financial': jQuery( "#inf_custom_Financial" ).val(),
		'Financial_feel': jQuery( "#Financial_feel" ).val(),
		'inf_custom_PhysicalHealth': jQuery( "#inf_custom_PhysicalHealth" ).val(),
		'PhysicalHealth_feel': jQuery( "#PhysicalHealth_feel" ).val(),
		'inf_custom_PersonalDevelopment': jQuery( "#inf_custom_PersonalDevelopment" ).val(),
		'PersonalDevelopment_feel': jQuery( "#PersonalDevelopment_feel" ).val(),
		'inf_custom_CareerMission': jQuery( "#inf_custom_CareerMission" ).val(),
		'CareerMission_feel': jQuery( "#CareerMission_feel" ).val(),
		'inf_custom_SpiritualFulfillment': jQuery( "#inf_custom_SpiritualFulfillment" ).val(),
		'SpiritualFulfillment_feel': jQuery( "#SpiritualFulfillment_feel" ).val(),
		'inf_custom_WLSMein12months': jQuery( "#inf_custom_WLSMein12months" ).val(),
		'inf_custom_WLSMein10Years': jQuery( "#inf_custom_WLSMein10Years" ).val(),
		'inf_custom_WLSRoadBlocks': jQuery( "#inf_custom_WLSRoadBlocks" ).val(),
		'inf_custom_WLSpersonalorprofessionalvision': jQuery( "#inf_custom_WLSpersonalorprofessionalvision" ).val(),
 		'inf_custom_Thankforreferringyou': jQuery( "#inf_custom_Thankforreferringyou" ).val(),
		'inf_custom_WLSGrossAnnualIncome': jQuery( ".gai .visible" ).parent().find( "input" ).val(),
		'status':jQuery('#wol-status').val(),
		'inf_option_WLSPlannedInvestmentinSelfDevelopment': jQuery( ".gai2   .visible" ).parent().find( "input" ).val()
	};
	 
	 jQuery.ajax({
		url :"<?php echo admin_url( 'admin-ajax.php' ); ?>" ,
		type : 'post',
		data :  data,
		success : function( response ) {
			
			var inf_custom_MentalAndEmotionalState = jQuery("#inf_custom_MentalAndEmotionalState").val()
			var inf_custom_CareerMission = jQuery("#inf_custom_CareerMission").val()
			var inf_custom_Family = jQuery("#inf_custom_Family").val()
			var inf_custom_Time = jQuery("#inf_custom_Time").val()
			var inf_custom_Financial = jQuery("#inf_custom_Financial").val()
			var inf_custom_PhysicalHealth = jQuery("#inf_custom_PhysicalHealth").val()
			var inf_custom_SpiritualFulfillment = jQuery("#inf_custom_SpiritualFulfillment").val()
			var inf_custom_PersonalDevelopment = jQuery("#inf_custom_PersonalDevelopment").val()
		console.log( response );
		jQuery("#final-submit").hide();
		jQuery(".thank-you").show();
		var chartColors = window.chartColors;
		var color = Chart.helpers.color;
		var config = {
			data: {
				datasets: [{
					data: [inf_custom_MentalAndEmotionalState,inf_custom_CareerMission,inf_custom_Family,inf_custom_Time,inf_custom_Financial,inf_custom_PhysicalHealth,inf_custom_SpiritualFulfillment,inf_custom_PersonalDevelopment],
					backgroundColor: [
                    "#faa41b",
                    "#f73913",
                    "#aa2173",
                    "#00979f",
                    "#1d3464",
					"#9ecb3d",
					"#6d166d",
					"#C94429",
                ],
					label: 'My dataset' // for legend
				}],
				labels: [
					'Mental and Emotional State',
					'Career/Vocation/Purpose',
					'Relationships',
					'Time',
					'Financial',
					'Physical Health',
					'Spiritual Fulfillment',
					'Personal Development'
				]
			},
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: false
				},
				scale: {
					 ticks: {
						min: 0,
						max: 10
					},
					reverse: false
				},
				animation: {
					animateRotate: false,
					animateScale: true
				}
			}
		};
			var ctx = document.getElementById('chart-area');
			window.myPolarArea = Chart.PolarArea(ctx, config);
		    
		}
	});	
    
	

});


		

</script>
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}
 .page-id-3936 .survey-header_new {
    display: block;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #C94429;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.2;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
.required{
	color:red;
	font-weight:bold;
}
.step-2-heading{
	font-size: 34px;
    text-align: center;
    color: red;
    line-height: 35px;
    margin: 0 auto;
    font-weight: bold;
}
</style>

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

		padding: 18px 30px;

		font-size: 20px;

		font-weight: 600;

		white-space: normal;

		border: 0;

		outline: 0;

		text-align: center;

		line-height: normal;
		text-transform: capitalize;

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
	.infusion-field.custom-info-pinnacle {
      display: none;
   }
	.step-2-heading span {
     text-transform: capitalize;
   }
   #canvas-holder{
	   margin:0 auto;
   }
   

</style>
	
<?php endwhile; ?>