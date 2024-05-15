<?php

return [
    'pagingListArray' => ["100", "300", "500", "1000", "5000", "10000", "1000000"],

	
	
//'ADMINFOLDER' => 'admin',
'COMPANY' 		=> 'I-Techniques',
'FULLURL'		=> env('APP_URL', 'https://I-techniques.in'),
'COPYRIGHTTEXT' => '',
'VERSION' 		=> '1.0',
'TXNURL' 		=> 'https://bscscan.com/tx/',


'PROFILEPHOTOWIDTH' => '200',
'GALLERYPHOTOWIDTH' => '400',
'UPLOADSLIP' => 'upload/slip/', 
'UPLOADPATH' => 'upload/useruploads/',
'EDITORPATHIMAGE' => 'upload/ckeditor/photos/',
'EDITORPATHFILES' => 'upload/ckeditor/files/',
'CATEGORYPHOTOWIDTH' => '1200',
'BANNERUPLOADPATH' => 'upload/offerbanner/',
'LOGOPATH' => 'upload/logo/',
'PRODUCTUPLOADPATH' => '/upload/products/',

/////////////////  Manage According to plan need////////////////
    
'incomeTypesArray' => [
    
	"Referral" 	=> ["direct","Referral Income","/listIncomeReports/Referral"], 
	"roi" 	=> ["roi","ROI Income","/listIncomeReports/roi"],
	// "galaxy"    => ["galaxy","Galaxy Income","/listIncomeReports/galaxy","roi_no#ROI No."],
	// "helping_star"    => ["helping_star","Helping Star","/listIncomeReports/helping_star"],

	// "direct" 	=> ["direct","Sponsor Bonus","/listIncomeReports/direct"], 
	// "boosting" 	=> ["boosting","Boosting Bonus","/listIncomeReports/boosting"], 
	// "boosting-level" => ["boosting-level","Boosting Level Bonus","/listIncomeReports/boosting-level","paid_level#For Level"],	
	// "level" 	=> ["level","Level Bonus","/listIncomeReports/level","paid_level#For Level"],
	// "autopool" 	=> ["autopool","Autopool Bonus","/listIncomeReports/autopool","paid_level#Paid Level"],
	// "dividend" 	=> ["dividend","Dividend Bonus","/listIncomeReports/dividend"], 
	// "royalty" 	=> ["royalty","Royalty Bonus","/listIncomeReports/royalty","reward_name#Royalty Name"],

],


'networkMenuArray' => [
	"binary"	=> ["binary","Genealogy Tree","network_binary"],
	"explorer" 	=> ["explorer","Network Explorer","network_explorer"],
	"downline" 	=> ["downline","Downline List","network_downline"]
],

'supportstatus' => [
	0=>'Closed',
	1=>'Open',
	2=>'Under Process'
],


'clubTablesArray' => ["ClubStartup"=>"Startup"],

'NewsType' => ["NewsEvent"=>"News & Events", "Popup"=>"Popup"],

///////////////////////////////////////////////////////////////

// Write in any case //
'orderTypesArray' 	=> ["Pending","Approved","Delivered","Rejected"],
//////////////////////
'pagingListArray' 	=> ["100","300","500","1000","5000","10000","1000000"],

'categoryTypesArray' => ["epin-registration","epin-topup","product"],

'allowedImage' 		=> ['gif', 'png', 'jpg', 'jpeg'],

'relation' 			=> ["Father","Mother","Husband","Wife","Son","Daughter","Brother","Sister","Nephew","Cousin"],

'currencies' 		=> ["INR","USD","EURO"],

'showothervalues' 	=> ["BV","PV","Both"],	

'type' 	=> ["Activation","Income","Recycle","Gift","Unknown"],	


];

?>