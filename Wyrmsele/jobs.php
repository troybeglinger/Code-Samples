<?php
function jobs_getmoduleinfo(){
	$info = array(
		"name"=>"Jobs System",
		"version"=>"5.24",
		"author"=>"Troy Beglinger",
		"category"=>"Village",
		"settings"=>array(
			"Jobs Module Settings,title",
			"dkmin"=>"Minimum dks needed to play this module?,int|0",
			"requireapp"=>"Require application approval by staff before receiving a job?,bool|1",
			"woodapprove"=>"Require Custom furniture names to be approved by Staff?,enum,0,No,1,Yes,2,No; but send mail informing of the name|1",
			"industrialpark"=>"Make everything appear in one Industrial park?,bool|1",
			"indusloc"=>"Where is the Industrial Park located?,location|".getsetting("villagename", LOCATION_FIELDS),
			"If the Industrial Park is not utilized you need to pick each location below,note",
			"farmloc"=>"Where does the Estate Farm appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"millloc"=>"Where does the Gristmill appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"clothloc"=>"Where does the Cloth Mill appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"breweryloc"=>"Where does the Brewery appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"foundryloc"=>"Where does the Foundry appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"woodloc"=>"Where does the Healwudu appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"jobserviceloc"=>"Where does the Job Services appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"marketloc"=>"Where does the Market appear:,location|".getsetting("villagename", LOCATION_FIELDS),
			"farm"=>"Unused Estate Farm shifts:,int|0",
			"mill"=>"Unused Gristmill shifts:,int|0",
			"cloth"=>"Unused Cloth Mill shifts:,int|0",
			"brewery"=>"Unused Brewery shifts:,int|0",
			"foundry"=>"Unused Foundry shifts:,int|0",
			"Vacation/Firing,title",
			"fire"=>"How should firing be based?,enum,0,Real Time Missed,1,Not Working X Gamedays|,0",
			"Gamedays are defined as days that the player has logged on and not gone to work,note",
			"xdays"=>"How many missed gamedays before getting fired?,int|5",
			"vacation"=>"Allow players to request vacation time?,bool|1",
			"Note: Vacations are applied for at Job Services. Managers CANNOT get vacation.,note",
			"Pay Scale,title",
			"farmpay1"=>"Pay for first day of work at Estate Farm:,int|50",
			"millpay1"=>"Pay for first day of work at Gristmill:,int|80",
			"clothpay1"=>"Pay for first day of work at Cloth Mill:,int|110",
			"brewpay1"=>"Pay for first day of work at Brewery:,int|150",
			"founpay1"=>"Pay for first day of work at Foundry:,int|170",
			"woodpay1"=>"Pay for first day of work at Healwudu:,int|190",
			"farmincpay"=>"Percentage pay increase for each ff worked at the Estate Farm:,int|30",
			"millincpay"=>"Percentage pay increase for each ff worked at the Gristmill:,int|26",
			"clothincpay"=>"Percentage pay increase for each ff worked at the Cloth Mill:,int|22",
			"brewincpay"=>"Percentage pay increase for each ff worked at the Brewery:,int|18",
			"founincpay"=>"Percentage pay increase for each ff worked at the Foundry:,int|14",
			"woodincpay"=>"Percentage pay increase for each ff worked at Healwudu:,int|10",
			"mfarmpay"=>"Additional pay per turn for working as the manager at the Estate Farm:,int|25",
			"mmillpay"=>"Additional pay per turn for working as the manager at the Gristmill:,int|40",
			"mclothpay"=>"Additional pay per turn for working as the manager at the Cloth Mill:,int|60",
			"mbrewpay"=>"Additional pay per turn for working as the manager at the Brewery:,int|75",
			"mfounpay"=>"Additional pay per turn for working as the manager at the Foundry:,int|95",
			"mwoodpay"=>"Additional pay per turn for working as the manager at Healwudu:,int|110",
			"Inventory,title",
			"milk"=>"Milk Quantity:,int|0",
			"egg"=>"Egg Quantity:,int|0",
			"pork"=>"Pork Quantity:,int|0",
			"beef"=>"Beef Quantity:,int|0",
			"chicken"=>"Chicken Quantity:,int|0",
			"bread"=>"Bread Quantity:,int|0",
			"thread"=>"Thread Quantity:,int|0",
			"fabric"=>"Fabric Quantity:,int|0",
			"leather"=>"Leather Quantity:,int|0",
			"ale"=>"Ale Quantity:,int|0",
			"breastplate"=>"Breastplate Quantity:,int|0",
			"longsword"=>"LongSword Quantity:,int|0",
			"chainmail"=>"Chainmail Quantity:,int|0",
			"duallongsword"=>"Dual Longsword Quantity:,int|0",
			"fullarmor"=>"Full Armor Quantity:,int|0",
			"duallongsworddaggers"=>"Dual Longsword with Daggers Quantity:,int|0",
			"Custom Furniture Production,title",
			"cust1"=>"How many turns does it take to make the 1st custom chair?,int|10",
			"cwood1"=>"How much wood does it take to make the 1st custom chair?,int|1",
			"cstone1"=>"How much stone does it take to make the 1st custom chair?,int|0",
			"cust2"=>"How many turns does it take to make the 2nd custom chair?,int|13",
			"cwood2"=>"How much wood does it take to make the 2nd custom chair?,int|1",
			"cstone2"=>"How much stone does it take to make the 2nd custom chair?,int|0",
			"cust3"=>"How many turns does it take to make the 3rd custom chair?,int|13",
			"cwood3"=>"How much wood does it take to make the 3rd custom chair?,int|1",
			"cstone3"=>"How much stone does it take to make the 3rd custom chair?,int|0",
			"cust4"=>"How many turns does it take to make the 1st custom table?,int|15",
			"cwood4"=>"How much wood does it take to make the 1st custom table?,int|1",
			"cstone4"=>"How much stone does it take to make the 1st custom table?,int|1",
			"cust5"=>"How many turns does it take to make the 2nd custom table?,int|18",
			"cwood5"=>"How much wood does it take to make the 2nd custom table?,int|1",
			"cstone5"=>"How much stone does it take to make the 2nd custom table?,int|1",
			"cust6"=>"How many turns does it take to make the 3rd custom table?,int|18",
			"cwood6"=>"How much wood does it take to make the 3rd custom table?,int|1",
			"cstone6"=>"How much stone does it take to make the 3rd custom table?,int|1",
			"cust7"=>"How many turns does it take to make the 1st custom bed?,int|20",
			"cwood7"=>"How much wood does it take to make the 1st custom bed?,int|2",
			"cstone7"=>"How much stone does it take to make the 1st custom bed?,int|1",
			"cust8"=>"How many turns does it take to make the 2nd custom bed?,int|25",
			"cwood8"=>"How much wood does it take to make the 2nd custom bed?,int|2",
			"cstone8"=>"How much stone does it take to make the 2nd custom bed?,int|1",
			"cust9"=>"How many turns does it take to make the 3rd custom bed?,int|25",
			"cwood9"=>"How much wood does it take to make the 3rd custom bed?,int|2",
			"cstone9"=>"How much stone does it take to make the 3rd custom bed?,int|1",
			"Custom Furniture Payment,title",
			"cgold1"=>"How much bonus gold for completing Custom Chair 1?,int|275",
			"cgems1"=>"How many bonus gems for completing Custom Chair 1?,int|0",
			"cgold2"=>"How much bonus gold for completing Custom Chair 2?,int|425",
			"cgems2"=>"How many bonus gems for completing Custom Chair 2?,int|1",
			"cgold3"=>"How much bonus gold for completing Custom Chair 3?,int|425",
			"cgems3"=>"How many bonus gems for completing Custom Chair 3?,int|1",
			"cgold4"=>"How much bonus gold for completing Custom Table 1?,int|350",
			"cgems4"=>"How many bonus gems for completing Custom Table 1?,int|1",
			"cgold5"=>"How much bonus gold for completing Custom Table 2?,int|425",
			"cgems5"=>"How many bonus gems for completing Custom Table 2?,int|2",
			"cgold6"=>"How much bonus gold for completing Custom Table 3?,int|425",
			"cgems6"=>"How many bonus gems for completing Custom Table 3?,int|2",
			"cgold7"=>"How much bonus gold for completing Custom Bed 1?,int|400",
			"cgems7"=>"How many bonus gems for completing Custom Bed 1?,int|2",
			"cgold8"=>"How much bonus gold for completing Custom Bed 2?,int|475",
			"cgems8"=>"How many bonus gems for completing Custom Bed 2?,int|3",
			"cgold9"=>"How much bonus gold for completing Custom Bed 3?,int|475",
			"cgems9"=>"How many bonus gems for completing Custom Bed 3?,int|3",
			"HoF,title",
			"nosuper"=>"Exclude Superusers from the HoF?,bool|0",
			"usehof"=>"Use Metal Hall of Fame?,bool|1",
			"pp"=>"Entries per page in HoF:,int|40",
		),
		"prefs"=>array(
			"Jobs Module User Preferences,title",
			"user_stat"=>" Would you like a Pigeon Post informing you when a worker at your shop does something wrong?,bool|1",
			"user_furnyomsell"=>"Would you like a Pigeon Post when your custom furniture is purchased?,bool|1",
			"super"=>"Allow player to process Job Applications or Furniture Names if superuser?,bool|0",
			"email"=>"Receive Pigeon Post when a Job Application or Furniture Name is pending?,bool|0",
			"Allprefs,title",
			"Note: Please edit with caution. Consider using the Allprefs Editor instead.,note",
			"allprefs"=>"Preferences for Jobs,textarea|",
		),
		"requires"=>array(
			"furniture" => "Furniture Store by Troy Beglinger",
		),
	);
	return $info;
}

function jobs_install(){
	module_addhook("newday");
	module_addhook("newday-runonce");
	module_addhook("village");
	module_addhook("superuser");
	module_addhook("footer-hof");
	module_addhook("allprefs");
	module_addhook("allprefnavs");
	return true;
}

function jobs_uninstall(){
	return true;
}

function jobs_dohook($hookname,$args){
	global $session;
	require("modules/jobs/dohook/$hookname.php");
	return $args;
}

function jobs_run(){
	global $session;
	$op = httpget('op');
	$op2 = httpget('op2');
	$place = httpget('place');
	$shifts = $_POST['shifts'];
	$C1 = $_POST['C1'];
	$C2 = $_POST['C2'];
	$T1 = $_POST['T1'];
	if ($place == "industrialpark") include("modules/jobs/jobsindustrialpark.php");
	if ($place == "farm") include("modules/jobs/jobsfarm.php");	
	if ($place == "mill") include("modules/jobs/jobsmill.php");
	if ($place == "cloth") include("modules/jobs/jobscloth.php");
	if ($place == "brewery") include("modules/jobs/jobsbrewery.php");
	if ($place == "foundry") include("modules/jobs/jobsfoundry.php");
	if ($place == "wood") include("modules/jobs/jobswood.php");
	if ($place == "jobservice") include("modules/jobs/jobsjobservice.php");
	if ($place == "market") include("modules/jobs/jobsmarket.php");
	if ($place == "super") include("modules/jobs/jobssuper.php");
	if ($place == "supername") include("modules/jobs/jobssupername.php");

if ($op=="superuser"){
	require_once("modules/allprefseditor.php");
	allprefseditor_search();
	page_header("Allprefs Editor");
	$subop=httpget('subop');
	$id=httpget('userid');
	addnav("Navigation");
	addnav("Return to the Grotto","superuser.php");
	villagenav();
	addnav("Edit User","user.php?op=edit&userid=$id");
	modulehook('allprefnavs');
	$allprefse=unserialize(get_module_pref('allprefs',"jobs",$id));
	if ($allprefse['reason']=="") $allprefse['reason']="";
	if ($allprefse['lastworked']=="") $allprefse['lastworked']="";
	if ($allprefse['jobexp']=="") $allprefse['jobexp']=0;
	if ($allprefse['dayssince']=="") $allprefse['dayssince']=0;
	if ($allprefse['vacation']=="") $allprefse['vacation']=0;
	if ($allprefse['ffspent']=="") $allprefse['ffspent']=0;
	if ($allprefse['name1']=="") $allprefse['name1']="";
	if ($allprefse['name2']=="") $allprefse['name2']="";
	if ($allprefse['name3']=="") $allprefse['name3']="";
	if ($allprefse['name4']=="") $allprefse['name4']="";
	if ($allprefse['name5']=="") $allprefse['name5']="";
	if ($allprefse['name6']=="") $allprefse['name6']="";
	if ($allprefse['name7']=="") $allprefse['name7']="";
	if ($allprefse['name8']=="") $allprefse['name8']="";
	if ($allprefse['name9']=="") $allprefse['name9']="";
	set_module_pref('allprefs',serialize($allprefse),'jobs',$id);
	if ($subop!='edit'){
		$allprefse=unserialize(get_module_pref('allprefs',"jobs",$id));
		$allprefse['reason']= httppost('reason');
		$allprefse['lastworked']= httppost('lastworked');
		$allprefse['job']= httppost('job');
		$allprefse['jobexp']= httppost('jobexp');
		$allprefse['jobapp']= httppost('jobapp');
		$allprefse['jobworked']= httppost('jobworked');
		$allprefse['dayssince']= httppost('dayssince');
		$allprefse['vacation']= httppost('vacation');
		$allprefse['type']= httppost('type');
		$allprefse['ffspent']= httppost('ffspent');
		$allprefse['cust1']= httppost('cust1');
		$allprefse['name1']= httppost('name1');
		$allprefse['cust2']= httppost('cust2');
		$allprefse['name2']= httppost('name2');
		$allprefse['cust3']= httppost('cust3');
		$allprefse['name3']= httppost('name3');
		$allprefse['cust4']= httppost('cust4');
		$allprefse['name4']= httppost('name4');
		$allprefse['cust5']= httppost('cust5');
		$allprefse['name5']= httppost('name5');
		$allprefse['cust6']= httppost('cust6');
		$allprefse['name6']= httppost('name');
		$allprefse['cust7']= httppost('cust7');
		$allprefse['name7']= httppost('name7');
		$allprefse['cust8']= httppost('cust8');
		$allprefse['name8']= httppost('name8');
		$allprefse['cust9']= httppost('cust9');
		$allprefse['name9']= httppost('name9');
		set_module_pref('allprefs',serialize($allprefse),'jobs',$id);
		output("Allprefs Updated`n");
		$subop="edit";
	}
	if ($subop=="edit"){
		require_once("lib/showform.php");
		$form = array(
			"Jobs Plus,title",
			"reason"=>"Reason they are applying:,text",
			"lastworked"=>"Date Last Worked:,text",
			"job"=>"Job:,enum,0,None,1,Estate Farm,2,Mill,3,Cloth,4,Brewery,5,Foundry,6,Healwudu,7,Estate Farm Management,8,Mill Management,9,Cloth Management,10,Brewery Management,11,Foundry Management,12,Healwudu Management,13,Quit",
			"jobexp"=>"Job Experience:,int",
			"jobapp"=>"Current Job applied for:,enum,0,None,1,Estate Farm,2,Mill,3,Cloth,4,Brewery,5,Foundry,6,Healwudu,7,Estate Farm Management,8,Mill Management,9,Cloth Management,10,Brewery Management,11,Foundry Management,12,Healwudu Management",
			"jobworked"=>"Job Worked today?,bool",
			"dayssince"=>"How many days has it been since last worked?,int",
			"vacation"=>"How many days does the player have left for vacation?,int",
			"Healwudu,title",
			"type"=>"What project are they current working on?,enum,0,Basic Furniture,1,Custom Chair 1,2,Custom Chair 2,3,Custom Chair 3,4,Custom Table 1,5,Custom Table 2,6,Custom Table 3,7,Custom Bed 1,8,Custom Bed 2,9,Custom Bed 3",
			"ffspent"=>"How many turns has the player spent working on their current furniture?,int",
			"cust1"=>"Has the player finished a Rough Chair?,enum,0,No,1,Yes,2,Pending Approval",
			"name1"=>"What is the name of their Rough Chair?,text",
			"cust2"=>"Has the player finished an Average Chair?,enum,0,No,1,Yes,2,Pending Approval",
			"name2"=>"What is the name of their Average Chair?,text",
			"cust3"=>"Has the player finished an Refined Chair?,enum,0,No,1,Yes,2,Pending Approval",
			"name3"=>"What is the name of their Refined Chair?,text",
			"cust4"=>"Has the player finished a Rough Table?,enum,0,No,1,Yes,2,Pending Approval",
			"name4"=>"What is the name of their Rough Table?,text",
			"cust5"=>"Has the player finished an Average Table?,enum,0,No,1,Yes,2,Pending Approval",
			"name5"=>"What is the name of their Average Table?,text",
			"cust6"=>"Has the player finished an Refined Table?,enum,0,No,1,Yes,2,Pending Approval",
			"name6"=>"What is the name of their Refined Table?,text",
			"cust7"=>"Has the player finished a Rough Bed?,enum,0,No,1,Yes,2,Pending Approval",
			"name7"=>"What is the name of their Rough Bed?,text",
			"cust8"=>"Has the player finished an Average Bed?,enum,0,No,1,Yes,2,Pending Approval",
			"name8"=>"What is the name of their Average Bed?,text",
			"cust9"=>"Has the player finished an Refined Bed?,enum,0,No,1,Yes,2,Pending Approval",
			"name9"=>"What is the name of their Refined Bed?,text",
		);
		$allprefse=unserialize(get_module_pref('allprefs',"jobs",$id));
		rawoutput("<form action='runmodule.php?module=jobs&op=superuser&userid=$id' method='POST'>");
		showform($form,$allprefse,true);
		$click = translate_inline("Save");
		rawoutput("<input id='bsave' type='submit' class='button' value='$click'>");
		rawoutput("</form>");
		addnav("","runmodule.php?module=jobs&op=superuser&userid=$id");
	}
	page_footer();
}
}
?>