<?php
// ajax to return contact data
add_action( 'wp_ajax_submit_wheel_of_life_survey', 'SubmitWheelOfLifeSurvey' );
add_action( 'wp_ajax_nopriv_submit_wheel_of_life_survey', 'SubmitWheelOfLifeSurvey' );
function SubmitWheelOfLifeSurvey() {
    header('Content-Type: application/json');

    //echo json_encode( $_POST );

    echo json_encode( ifsFormScrape::scrape( $_POST ) );

    die();
}

class ifsFormScrape {
    /**
     * This does the actual form scraping
     */
    public static function scrape( $p ) {
        $fields = array(
            'inf_field_FirstName' => $p['inf_field_FirstName'],
            'inf_field_LastName' => $p['inf_field_LastName'],
            'inf_field_Email' => $p['inf_field_Email'],
            'inf_custom_WLSPlannedInvestmentinSelfDevelopment' => $p['inf_custom_WLSPlannedInvestmentinSelfDevelopment'],
            'inf_custom_MentalAndEmotionalState' => $p['inf_custom_MentalAndEmotionalState'],
            'inf_custom_WLSCareerVocationPurpose' => $p['inf_custom_WLSCareerVocationPurpose'],
            'inf_custom_WLSRelationships' => $p['inf_custom_WLSRelationships'],
            'inf_custom_WLSTime' => $p['inf_custom_WLSTime'],
            'inf_custom_WLSFinancial' => $p['inf_custom_WLSFinancial'],
            'inf_custom_WLSPhysicalHealth' => $p['inf_custom_WLSPhysicalHealth'],
            'inf_custom_WLSSpiritualFulfillment' => $p['inf_custom_WLSSpiritualFulfillment'],
            'inf_custom_WLSPersonalDevelopment' => $p['inf_custom_WLSPersonalDevelopment'],
            'inf_custom_WLSMein51020Years' => $p['inf_custom_WLSMein51020Years'],
            'inf_custom_WLSRoadBlocks' => $p['inf_custom_WLSRoadBlocks'],
            'inf_custom_WLSRoadBlocksNegativeImpact' => $p['inf_custom_WLSRoadBlocksNegativeImpact'],
            'inf_custom_WLSTopValues' => $p['inf_custom_WLSTopValues'],
            'inf_custom_WLSGrossAnnualIncome' => $p['inf_custom_WLSGrossAnnualIncome'],
            'inf_form_xid' => '105daaa51770c22ac2c49f249b78d3eb',
            'inf_form_name' => 'Wheel of Life Survey&#a;Webform',
           'infusionsoft_version' => '1.70.0.54335'
        );

        $fh = fopen( get_template_directory() . '/functions-wheel-of-life-survey-log.txt', 'a+' );
        fwrite( $fh, date( "Y-m-d G:i:s" ) . ' - ' . json_encode( $fields ) );
        fclose( $fh );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_POST, TRUE );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-type: multipart/form-data' ) );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );    // Timeout
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0" );
        curl_setopt( $ch, CURLOPT_URL, 'https://jw315.infusionsoft.com/app/form/process/105daaa51770c22ac2c49f249b78d3eb' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
        $source = curl_exec( $ch );
        $curl_error = curl_error( $ch );
        curl_close($ch);

        return( $source );
    }
}