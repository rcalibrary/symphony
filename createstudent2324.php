
<?php
##############################################################################
#                                                                            #
#                           uploadusersflatfile.php
#                                                                            #
##############################################################################
#
##############################################################################


# open master input file which should be in csv format and place under /tmp
# 
# 
# open outputfile in /tmp

$out_handle = fopen("C:\Users\iain.gray\Desktop\User_Uploads\mastudents\EnrolledStudents.txt", "w") or die("can't open output file"); //Outputfile

if (($handle = fopen("C:\Users\iain.gray\Desktop\User_Uploads\mastudents\EnrolledStudents.csv", "r")) !== FALSE) { // Check the resource is valid
	fgetcsv($handle); //omit the first row of the csv file as this contains the row headers
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)	{ // Check opening the file is OK!
       $record = "*** DOCUMENT BOUNDARY ***\n"; //start of each record in the loaduser file
   fputs($out_handle, $record);
   $record = "FORM=LDUSER\n";
   fputs($out_handle, $record);
	  $record = ".USER_ID.   |a" . trim($data[1]) . "\n";
   fputs($out_handle, $record);
      $record = ".USER_ALT_ID.   |a" . trim($data[1]) . "\n";
   fputs($out_handle, $record);
      $record = ".USER_FIRST_NAME.   |a" . trim(ucwords($data[2])) . "\n";
   fputs($out_handle, $record);
      $record = ".USER_LAST_NAME.   |a" . trim(ucwords($data[3])) . "\n";
   fputs($out_handle, $record);
      if(in_array(strstr($data[8],"-",true) , array('PRN','PHT','PNT','CAP','CAG','JAM','AHR')))
	  {$record = ".USER_LIBRARY.   |aBATTERSEA\n";
	  }
	  elseif(in_array(strstr($data[8],"-",true), array('ANM','DGD','IED','VIS')))
	  {$record = ".USER_LIBRARY.   |aWHITECITY\n";
	  }
	  elseif (strpos($data[5],"Graduate Diploma Art & Design")===0)
	  {$record = ".USER_LIBRARY.   |aWHITECITY\n";
	  }
	  else
	  {$record = ".USER_LIBRARY.   |aRCA\n";
	  }
   fputs($out_handle, $record);
      $record = ".USER_PROFILE.   |aSTU\n";
   fputs($out_handle, $record);
    if(strpos($data[4],"GradDip")===0) //This set of if statements will need to be tweaked to search for whatever appears in the csv file from registry. Suspect that all we will have STUDMA, STUDPHD,STUDMP, STUMRES,15 Month, GRad dips and whatever the pre-sessional students are called.
		{$record = ".USER_CATEGORY1.   |aGRADDIP\n";
		 }
		 elseif (strpos($data[4],"Graduate")===0)
		{$record = ".USER_CATEGORY1.   |aGRADDIP\n";
		 }
		 elseif (strpos($data[4],"MA")=== 0)
		{$record = ".USER_CATEGORY1.   |aSTUDMA\n";
		 }
		 elseif (strpos($data[4],"MFA")=== 0)
		{$record = ".USER_CATEGORY1.   |aSTUDMFA\n";
		 }
		 elseif (strpos($data[4],"MDes")=== 0)
		{$record = ".USER_CATEGORY1.   |aSTUDMDES\n";
		 }
		 elseif (strpos($data[4],"MEd")=== 0)
		{$record = ".USER_CATEGORY1.   |aSTUDMED\n";
		 }
		 elseif (strpos($data[4],"MPhil")===0)
		{$record = ".USER_CATEGORY1.   |aSTUDMP\n";
		 }
		 elseif (strpos($data[4],"PhD")=== 0)
		{$record = ".USER_CATEGORY1.   |aSTUDPHD\n";
		 }
		 elseif  (strpos($data[4],"MRes")=== 0)
		{$record = ".USER_CATEGORY1.   |aSTUMRES\n";
		 }
		 elseif  (strpos($data[4],"Exchange")=== 0)
		{$record = ".USER_CATEGORY1.   |aEXCH\n";
		 }
		 elseif  (strpos($data[5],"Visiting")=== 0)
		{$record = ".USER_CATEGORY1.   |aVS\n";
		 }
	else
		{$record = ".USER_CATEGORY1.   |aUNKNOWN\n";
		 }
   fputs($out_handle, $record);
   if(strpos($data[5],"School of Communication")===0) //assign school
		{$record = ".USER_CATEGORY2.   |aSCOMM\n";
		 }
		 elseif (strpos($data[5],"School of Architecture")=== 0)
		{$record = ".USER_CATEGORY2.   |aSOARCH\n";
		 }
		 elseif (strpos($data[5],"School of Arts & Humanities")===0)
		{$record = ".USER_CATEGORY2.   |aSOAH\n";
		 }
		 elseif (strpos($data[5],"School of Design")=== 0)
		{$record = ".USER_CATEGORY2.   |aSODESIGN\n";
		 }
		 elseif  (strpos($data[5],"Research")=== 0)
		{$record = ".USER_CATEGORY2.   |aRESEARCH\n";
		 }
		 elseif  (strpos($data[5],"Academic")=== 0)
		{$record = ".USER_CATEGORY2.   |aADO\n";
		 }
	else
		{$record = ".USER_CATEGORY2.   |aUNKNOWN\n";
		 }
   fputs($out_handle, $record);
	 if(strpos($data[4],"GradDip")===0) //assign department, using strstr to extract the string before the first hyphen in course code. not ideal
	  {$record = ".USER_CATEGORY3.   |aGRADDIP\n";
	  }
	  elseif (strpos($data[4],"Graduate")===0)
		{$record = ".USER_CATEGORY3.   |aGRADDIP\n";
		 }
	elseif (strpos($data[4],"PGV Student")===0)
		{$record = ".USER_CATEGORY3.   |aUNKNOWN\n";
		 }
	  elseif (strpos($data[8],"MRE-MRES-AHM")===0)
		{$record = ".USER_CATEGORY3.   |aAHM\n";
		 }
	  elseif (strpos($data[8],"MRE-MRES-ARC")===0)
		{$record = ".USER_CATEGORY3.   |aARC\n";
		 }	
	  elseif (strpos($data[8],"MRE-MRES-COM")===0)
		{$record = ".USER_CATEGORY3.   |aCOM\n";
		 }
	  elseif (strpos($data[8],"MRE-MRES-DES")===0)
		{$record = ".USER_CATEGORY3.   |aDES\n";
		 }
	  elseif (strpos($data[8],"MRE-MRES-RCA")===0)
		{$record = ".USER_CATEGORY3.   |aRCA\n";
		 }		 		 
	  else
	  {$record = ".USER_CATEGORY3.   |a" . strstr($data[8],"-",true) . "\n";
	  } 
   fputs($out_handle, $record);	
 	//if(in_array(strstr($data[8],"-",true) , array('IMB','ENV','CIT','DGD','HOD','WRT')))		
	//{$record = ".USER_CATEGORY4.   |aMA-15MONTH\n";  //Department
	//}
	if (strpos($data[4],"MRes")=== 0)
	{$record = ".USER_CATEGORY4.   |aMRES\n";
	}
	elseif (strpos($data[4],"MPhil")===0)
	{$record = ".USER_CATEGORY4.   |aMPHIL1\n";
	}
	elseif (strpos($data[4],"PhD")===0)
	{$record = ".USER_CATEGORY4.   |aPHD1\n";
	}
	elseif (strpos($data[4],"MA")===0)
	{$record = ".USER_CATEGORY4.   |aMA1\n";
	}
	else
	{$record = ".USER_CATEGORY4.   |aUNKNOWN\n";
	}
   fputs($out_handle, $record);	
	if(in_array(strstr($data[8],"-",true) , array('ARC','IDE','HED')))		
	{$record = ".USER_PRIV_EXPIRES.   |a20240809\n";  
	}
	//if (strpos($data[5],"School of Architecture")=== 0)
	//{$record = ".USER_PRIV_EXPIRES.   |a20240816\n";
	//}
	elseif (strpos($data[4],"MRes")=== 0)
	{$record = ".USER_PRIV_EXPIRES.   |a20240809\n";
	}
	elseif (strpos($data[4],"MPhil")===0)
	{$record = ".USER_PRIV_EXPIRES.   |aNEVER\n";
	}
	elseif (strpos($data[4],"PhD")===0)
	{$record = ".USER_PRIV_EXPIRES.   |aNEVER\n";
	}
	//elseif (strpos($data[4],"GradDip Student 2021 July")===0)
	//{$record = ".USER_PRIV_EXPIRES.   |a20220311\n";
	//}		
	//elseif (strpos($data[4],"GradDip Student 2022")===0)
	//{$record = ".USER_PRIV_EXPIRES.   |a20220819\n";
	//}	
	//elseif (strpos($data[4],"Graduate Diploma Art & Design Student 2022")===0)
	//{$record = ".USER_PRIV_EXPIRES.   |a20220819\n";
	//}
	//elseif (strpos($data[4],"April") !==false)
	//{$record = ".USER_PRIV_EXPIRES.   |a20221216\n";
	//}	
	elseif (strpos($data[5],"Visiting Student")===0)
	{$record = ".USER_PRIV_EXPIRES.   |a20220101\n";
	}
	elseif (strpos($data[4],"September") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20240405\n";
	}
	elseif (strpos($data[4],"January") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20230804\n";
	}
	elseif (strpos($data[4],"May") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20231208\n";
	}
	elseif (strpos($data[4],"MA Student 2023") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20240809\n";
	}
	elseif (strpos($data[4],"MFA Student 2023") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20240809\n";
	}
	elseif (strpos($data[4],"MDes Student 2023") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20240809\n";
	}
	elseif (strpos($data[4],"MEd Student 2023") !==false)
	{$record = ".USER_PRIV_EXPIRES.   |a20240809\n";
	}
	else
	{$record = ".USER_PRIV_EXPIRES.   |a20230804\n";
	}
   fputs($out_handle, $record);
      $record = ".USER_ADDR1_BEGIN.\n";
   fputs($out_handle, $record);
	  $record = ".EMAIL.   |a" . trim($data[7]) . "\n";
   fputs($out_handle, $record);	  
      $record = ".DEPT.   |a" . trim(strtoupper($data[6])) . "\n"; //change string to Uppercase
   fputs($out_handle, $record);
      $record = ".USER_ADDR1_END.\n";
   fputs($out_handle, $record);
      $record = ".USER_WEB_AUTH.   |a" . trim($data[0]) . "\n";
   fputs($out_handle, $record);   
    }
    fclose($handle);
}


?>

