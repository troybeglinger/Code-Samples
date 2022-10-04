<?php
page_header("Head Wind Brewery");
output("`c`b`&Head Wind Brewery`b`c`n");
$allprefs=unserialize(get_module_pref('allprefs'));
if (get_module_setting("fire")==0 && $allprefs['lastworked'] < date("Y-m-d H:i:s",strtotime("-259200 seconds")) && $allprefs['job']==4){
	output("`^You have been fired for taking an unscheduled vacation from work!`n`n");
	if(get_module_setting("vacation")==1) output("`&To avoid getting fired in the future, remember to apply for vacation time in advance of your absence at the Job Services Office.`n`n"); 
	$allprefs['job']=0;
	$allprefs['jobexp']=1000;
	set_module_pref('allprefs',serialize($allprefs));
	$allprefs=unserialize(get_module_pref('allprefs'));
	$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
	$res = db_query($sql);
	for ($i=0;$i<db_num_rows($res);$i++){
		$row = db_fetch_assoc($res);
		$allprefsj=unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
		if ($allprefsj['job']==10 &&  get_module_pref("user_stat","jobs",$row['acctid'])==1){
			require_once("lib/systemmail.php");
			$subj = translate_inline(array("`&Delinquent Employee At The Head Wind Brewery, `^%s`&",$session['user']['name']));
			$body = translate_inline(array("`&Dear %s,`n`n`&As the manager of the Head Wind Brewery you are hereby informed that I have had to fire `^%s`& for failing to report for duty.`n`n`&Sincerely,`n`&The Foreman",$name,$session['user']['name']));
			systemmail($row['acctid'],$subj,$body);
		}
	}
}
if ($op == ""){
	output("`&This is the Head Wind Brewery. It is here, that villagers needing a few extra coins can come to dry grains and hops in the oast house, and combine them with yeast and pure water to produce ale for all of the inns and taverns.`n`n");
	$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
	$res = db_query($sql);
	$new_array = array();
	while($row = db_fetch_assoc($res)){
		$array = unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
		if ($array['job']==4) $new_array[$row['name']] = $array['jobexp'];
	}
	$n=0;
	arsort($new_array);
	foreach($new_array AS $name => $value){
		$n=$n+1;
		if ($n==1) output("`&`cOn a small plaque by the office, it reads:`n`b`^Most Valuable Employee:`& %s`c`b`n",$name);
	}
}
if ($allprefs['jobapp'] == 4) output("`&You begin to wonder if you will get the job you applied for.`n");
else{
	if ($allprefs['job']==13) output("`&Thanks to your decision to quit your most recent job, you will have to wait a day before you can get another one.");
	elseif ($allprefs['job'] < 4 && $allprefs['jobapp'] <> 4 && $op == "" && $allprefs['jobworked']==0){
		output("`&You see a sign on the outside of the Head Wind Brewery that says \"`^Help Wanted`&\". You take a second and realize how nice it would be to have a steady income. Plus, your parents always told you that good hard work can cleanse the soul. So, why not work at a brewery for a change?`n`n");
		addnav("Apply for a Job","runmodule.php?module=jobs&place=brewery&op=apply");
	}elseif ($allprefs['job'] == 4){
		if ($allprefs['jobworked']==0 && $op == ""){
			output("`&You head back to the brewery for a bit. Since you have a job there, now would be a good time to work a shift so you can stay employed.`n");
			if ($session['user']['turns'] > 0) addnav("Work","runmodule.php?module=jobs&place=brewery&op=work");
		}elseif ($allprefs['jobworked']==1) output("`^You have already worked today, come back again tommorow.`n`&");
		addnav("Quit your job","runmodule.php?module=jobs&place=brewery&op=quit");
	}elseif ($allprefs['job'] == 10){
		if ($allprefs['jobworked']==0 && $op == ""){
			output("`&You head back to the brewery. As you are management there, now would be a good time to work a shift so you can stay employed.`n");
			if ($session['user']['turns'] > 0) addnav("Work","runmodule.php?module=jobs&place=brewery&op=work");
		}elseif ($allprefs['jobworked']==1) output("`^You have already worked today, come back again tommorow.`n`&");
		addnav("Quit your job","runmodule.php?module=jobs&place=brewery&op=quit");
	}elseif ($allprefs['job'] > 4) output("`&You have many fond memories of working hard at the brewery. Your dedication to your craft also helped to build your character and create the foundations your current level of success.`n");
}
if ($op == "quit"){
	output("`^Are you sure you want to quit your job?`&");
	addnav("Yes","runmodule.php?module=jobs&place=brewery&op=yesquit");
	addnav("No","runmodule.php?module=jobs&place=brewery");
	blocknav("runmodule.php?module=jobs&place=industrialpark");
	blocknav("runmodule.php?module=jobs&place=brewery&op=quit");
	blocknav("village.php");
}
if ($op == "yesquit"){
	output("`^Your letter of resignation has been submitted. You no longer work here.`&");
	if ($allprefs['job']==4) {
		addnews("`&%s`^ quit their job at the Head Wind Brewery today.`&",$session['user']['name']);
		$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
		$res = db_query($sql);
		for ($i=0;$i<db_num_rows($res);$i++){
			$row = db_fetch_assoc($res);
			$allprefsj=unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
			if ($allprefsj['job']==10){
				$name = $row['name'];
				$id = $row['acctid'];
				if (get_module_pref("user_stat","jobs",$id)==1) {
					require_once("lib/systemmail.php");
					$subj = translate_inline(array("`^Head Wind Brewery Employee, `&%s`^, Quit`&",$session['user']['name']));
					$body = translate_inline(array("`&Dear %s`&,`n`nAs the manager of the Head Wind Brewery, you are hereby notified that `^%s`& has quit.`n`n`&Sincerely,`n`&The Foreman",$name,$session['user']['name']));
					systemmail($id,$subj,$body);
				}
			}
		}
	}else addnews("`&%s`^ quit their job as Head Wind Brewery manager today.`&",$session['user']['name']);
	$allprefs['job']=13;
	set_module_pref('allprefs',serialize($allprefs));
	debuglog("quit their job at the Head Wind Brewery today.");
	$allprefs=unserialize(get_module_pref('allprefs'));
	blocknav("runmodule.php?module=jobs&place=brewery&op=quit");
}
if ($op == "apply"){
	output("<big><big><big><span style=\"font-weight: bold;\">Job Application<br></span><small><small><small>",true);
	output("`n`^Name: `&%s`n",$session['user']['name']);
	output("`^Postion Applied for: `&Brewery Worker`n");
	output("<form action='runmodule.php?module=jobs&place=brewery&op=applied' method='POST'>",true);
	output("<script language='JavaScript'>document.getElementById('bet').focus();</script>",true); 
	output("<p>Are you currently Employed? <input type=\"radio\" name='C1' value='2' checked>No",true);
	output("<input type='radio' name='C1' value='1'>Yes</p>",true);
	output("<p>Are you currently wanted for any crimes? <input type=\"radio\" name='C2' value='2' checked>No",true);
	output("<input type='radio' name='C2' value='1'>Yes</p>",true);
	output("<p>Please give a short reason why you would be qualified for this job: <input type=\"text\" name=\"T1\" size=\"37\"></p>",true);
	output("<p><input type=\"submit\" value=\"Submit\" name=\"B1\"><input type=\"reset\" value=\"Reset\" name=\"B2\"></p>",true);
	output("</form>",true);
	addnav("","runmodule.php?module=jobs&place=brewery&op=applied");
}
if ($op == "applied"){
	if ($allprefs['jobexp']>1500){
		if (get_module_setting("requireapp")==1){
			$allprefs['jobapp']=4;
			$mailmessage=$session['user']['name'];
			$mailmessage.=translate_inline(" has applied for a job at the `^Head Wind Brewery");
			if ($C1 == 1) $mailmessage.=translate_inline("`n`^They are currently employed!`& ");
			else $mailmessage.=translate_inline("`n`&They are not currently employed. ");
			if ($C2 == 1) $mailmessage.=translate_inline("`n`^They say that they are currently a wanted criminal!`& ");
			else $mailmessage.=translate_inline("`n`&They say that they are not currently wanted for any crimes. ");
			$mailmessage.=translate_inline("`n`&They explain:`n");
			$mailmessage.=$T1;
			$mailmessage=stripslashes($mailmessage);
			$allprefs['reason']=$mailmessage;
			set_module_pref('allprefs',serialize($allprefs));
			$allprefs=unserialize(get_module_pref('allprefs'));
			$sql = "SELECT acctid,value FROM ".db_prefix('module_userprefs')." LEFT JOIN ".db_prefix('accounts')." ON (acctid = userid) WHERE modulename='jobs' and setting='email' and value ='1'";
			$result = db_query($sql);
			for ($i=0;$i<db_num_rows($result);$i++){
				$row = db_fetch_assoc($result);
				require_once("lib/systemmail.php");
				if ($row['value'] == 1 && get_module_pref("super","jobs",$row['acctid'])==1) systemmail($row['acctid'],translate_inline("`^Job Application`&"),$mailmessage);  
			}
			output("`^Your job application has been sent to Human Resources for review.`&");
		}else{
			output("`^Congratulations! Your application has been reviewed, and you got the a job at the Head Wind Brewery!`&");
			$allprefs['job']=4;
			$allprefs['jobapp']=0;
			$allprefs['dayssince']=0;
			$allprefs['jobworked']=0;
			$allprefs['lastworked']=date("Y-m-d H:i:s");
			set_module_pref('allprefs',serialize($allprefs));
			$allprefs=unserialize(get_module_pref('allprefs'));
			addnews("`&%s`^ got a job at the Head Wind Brewery, today.",$session['user']['name']);
			addnav("Back to the Brewery","runmodule.php?module=jobs&place=brewery");
		}
	}else{
		output("`&Your interviewer looks at your application and shakes her head. \"`^I am sorry, `&%s`^, but you do not have enough experience to work here. I suggest you try working at the cloth mill for the time being, as we only hire the most experienced workers here.\" While it saddens you to not be able to go for your dream job, right now, you are at least hopeful that a position will be open once you've gotten more experienced.`n");
	}
}
if ($op == "work"){
	require_once("lib/showform.php");
	$shifts = httppost('shifts');
	if ($allprefs['vacation']>0){
		output("`&The foreman looks over the log for vacation requests, and notices that you aren't supposed to be here.");
		output("`n`n`&\"`^You need to tell Job Services that you're back from vacation if you want to work today.`&\"");
	}elseif (is_module_active ("drinks") && get_module_pref('drunkeness','drinks')>65 && ($allprefs['job']==4 || $allprefs['job']==10)){
		$session['user']['experience']-=3;
		$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
		$res = db_query($sql);
		for ($i=0;$i<db_num_rows($res);$i++){
			$row = db_fetch_assoc($res);
			$allprefsj=unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
			if ($allprefsj['job']==10){
				$name = $row['name'];
				$id = $row['acctid'];
			}
		}
		output("`^The foreman stops you before you can even get in the door. \"How dare you show up to work in your condition?!\"`n`n");
		if ($name <> "" &&  get_module_pref("user_stat","jobs",$id)==1 && $allprefs['job']==4) {
			require_once("lib/systemmail.php");
			output("`^\"Go get yourself sobered up! Manager `&%s`^ shall be informed about your disgraceful behavior, at once.\"",$name);
			$subj = translate_inline(array("`^Drunken Employee Seen At The Brewery"));
			$body = translate_inline(array("`&Dear %s,`n`nAs the manager of the Head Wind Brewery, you are hereby informed that `^%s`& came to work in a drunken state, today. Please remind them that this cannot be tolerated in such a dangerous workplace.`n`n`&Thank you in advance for your assistance.`n`n`&Sincerely,`n`&The Foreman",$name,$session['user']['name']));
			systemmail($id,$subj,$body);
		}elseif ($allprefs['job']==10){
			output("`^\"As the manager, you're supposed to set a good example for everyone who works for you. You're fired!\"`&");
			$allprefs['jobexp']=7000;
			$allprefs['job']=0;
			set_module_pref('allprefs',serialize($allprefs));
			$allprefs=unserialize(get_module_pref('allprefs'));
			addnews("`&%s`^ showed up drunk to work, today, and was fired from their job as the manager of the Head Wind Brewery.`&",$session['user']['name']);
		}else output("`^\"Go sober up!\"`&");
	}else{
		if ($shifts < 1){
			rawoutput("<form action='runmodule.php?module=jobs&place=brewery&op=work' method='post'>");
			$stuff = array(
				"shifts"=>"How many shifts (turns) would you like to work?,range,1,5,1|1",
			);
			$b = array(
				"shifts"=>1,
			);
			showform($stuff,$b,true);
			$b = translate_inline("Work");
			rawoutput("<input type='submit' class='button' value='$b'></form>");
			addnav("","runmodule.php?module=jobs&place=brewery&op=work"); 
		}elseif ($shifts > $session['user']['turns']){
			output("`^You can only work %s %s!`&",$session['user']['turns']);
			addnav("Continue","runmodule.php?module=jobs&place=brewery&op=work");   
		}else{
			output("`^You complete your goal of working for %s %s.`&`n",$shifts,translate_inline($shifts>1?"shifts":"shift"));
			if ($allprefs['job']==4){
				for ($i=1;$i<$shifts+1;$i++){
					output("`nShift %s: ",$i);
					$a=1;
					if (get_module_pref('drunkeness','drinks')>32 && e_rand(1,2)==2) $a=9;
					switch(e_rand($a,9)){
						case 1:
							output("`&You pick green hops by the bushel before placing them into a poke; a large hessian (burlap) sack.");
						break;
						case 2:
							output("`&You spread green hops onto the floor of the oast house kiln to dry.");
						break;
						case 3:
							output("`&You remove dried hops from the oast house kiln using a scuppet; a large wooden shovel with upturned sides.");
						break;
						case 4:
							output("`&You combine malted grain, hops, yeast, and pure water into giant vats to ferment.");
						break;
						case 5:
							output("`&You collect isinglass from the swim bladders of fish to help clarify the beer.");
						break;
						case 6:
							output("`&You filter fully fermented beer before pouring it into casks and barrels for storage.");
						break;
						case 7:
							output("`&You label casks and barrels of beer with the maker's mark of the brewery.");
						break;
						case 8:
							output("`&You load marked casks and barrels of beer onto wagons for delivery.");
						break;
						case 9:
							output("You slack off for a while.");
							$allprefs['jobexp']=$allprefs['jobexp']-3;
							set_module_pref('allprefs',serialize($allprefs));
							$allprefs=unserialize(get_module_pref('allprefs'));
						break;
					}
				}
			}
			if ($shifts == 1) output("`n`n`^You hardly worked at all.`&");
			elseif ($shifts == 2) output("`n`n`^You worked just long enough to say you did something. You will never become the Most Valuable Employee that way.`&");
			elseif ($shifts == 3) output("`n`n`^You put in a fair day's work, today. Keep it going!");
			elseif ($shifts == 4) output("`n`n`^You worked for a good amount of time, today! We like hard workers around here!");
			elseif ($shifts == 5) output("`n`n`^You are simply incredible! Keep working like that, and you'll become Most Valuable Employee in no time!");
			$brewincpay=get_module_setting("brewincpay","jobs");
			//make the increase pay variable into a percentage
			$brewincpay1= $brewincpay/100 +1;
			//make the multiplier a variable based on the number of shifts
			$brewpay1= get_module_setting("brewpay1","jobs");
			$brewpay2= $brewpay1*$brewincpay1;
			$brewpay3= $brewpay1*$brewincpay1*$brewincpay1;
			$brewpay4= $brewpay1*$brewincpay1*$brewincpay1*$brewincpay1;
			$brewpay5= $brewpay1*$brewincpay1*$brewincpay1*$brewincpay1*$brewincpay1;
			//calculate the pay based on the number of shifts worked
			if ($shifts == 1) $paid = round($brewpay1);
			if ($shifts == 2) $paid = round($brewpay1 + $brewpay2);
			if ($shifts == 3) $paid = round($brewpay1 + $brewpay2 + $brewpay3);
			if ($shifts == 4) $paid = round($brewpay1 + $brewpay2 + $brewpay3 + $brewpay4);
			if ($shifts == 5) $paid = round($brewpay1 + $brewpay2 + $brewpay3 + $brewpay4 + $brewpay5);
			$session['user']['gold']+=$paid;
			//Pay manager
			if ($allprefs['job'] == 10){
				$mpay=get_module_setting("mbrewpay");
				$session['user']['gold']+=round($shifts*$mpay);
				$paid+=round($shifts*$mpay);
			}
			output("`n`n`^You have been paid `&%s gold`^ for your efforts today.`n`&",$paid);
			$session['user']['turns']-=$shifts;
			$experience=((e_rand(100,150)*$shifts)+$session['user']['level'])/5;
			if ($allprefs['job']>5) $experience+=((e_rand(130,180)*$shifts)+$session['user']['level'])/5;
			$allprefs['jobexp']=$allprefs['jobexp']+$experience+$shifts*4;
			debuglog("Worked for $shifts turns at the Head Wind Brewery and received $paid gold and gained $experience experience");
			$allprefs['jobworked']=1;
			if (is_module_active('odor')) increment_module_pref('odor',2,'odor');
			if (is_module_active('usechow')) increment_module_pref('hunger',$shifts,'usechow');
			$allprefs['lastworked']=date("Y-m-d H:i:s");
			set_module_pref('allprefs',serialize($allprefs));
			$allprefs=unserialize(get_module_pref('allprefs'));
			increment_module_setting('brewery',$shifts);
			if ($shifts>4){
				$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
				$res = db_query($sql);
				$new_array = array();
				while($row = db_fetch_assoc($res)){
					$array = unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
					if ($array['job']==4) $new_array[$row['name']] = $array['jobexp'];
				}
				$n=0;
				arsort($new_array);
				foreach($new_array AS $name => $value){
					$n=$n+1;
					if ($n==1 && $session['user']['name']==$name){
						output("`n`n`^You have been declared the Most Valuable Employee at the Head Wind Brewery! For showing such dedication to your labors, you have also received a blessing from the Gods; the `&Wonderful Worker`^ buff!`&");
						apply_buff('wonderfulworker',array(
							"name"=>translate_inline("`Wonderful Worker"),
							"rounds"=>35,
							"wearoff"=>translate_inline("`^Your Wonderful Worker buff has faded. Time to get back to your projects.`&"),
							"atkmod"=>1.25,
							"roundmsg"=>translate_inline("`^All your hard work and dedication has really paid off. Kicking butt has never been this easy!"),
							"activate"=>"offense"
						));
						debuglog("gained the Wonderful Worker buff for being the Most Valuable Employee at the Head Wind Brewery.");
					}
				}
			}
		}
	}
}
$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
$res = db_query($sql);
for ($i=0;$i<db_num_rows($res);$i++){
	$row = db_fetch_assoc($res);
	$allprefsm=unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
	if ($allprefsm['job']==10) output("`n`c`n`b`&Manager:`b `^%s`c`&",$row['name']);
}
$sql = "SELECT acctid,name FROM ".db_prefix("accounts")."";
$res = db_query($sql);
$n=0;
for ($i=0;$i<db_num_rows($res);$i++){
	$row = db_fetch_assoc($res);
	$allprefsj=unserialize(get_module_pref('allprefs','jobs',$row['acctid']));
	if ($allprefsj['job']==4){
		$n=$n+1;
		if ($n==1) output("`c`n`b`&Current Employees`b`n`c");
		if ($n>0) output_notl("`c- `^%s `&-`n`c",$row['name']);
	}
}
if (get_module_setting("industrialpark")==1) addnav("Return to Industrial Park","runmodule.php?module=jobs&place=industrialpark");
villagenav();
page_footer();
?>