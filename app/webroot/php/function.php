<?php

require 'dbconfig.php';

class User {

    function checkUser($uid, $oauth_provider, $username) 
	{
        $query = mysql_query("SELECT * FROM users WHERE twUniqueID = '$uid' and isFBorTwitter = '$oauth_provider'");
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
	  
            return $result;

            # User is already present
        } else {
            #user not present. Insert a new Record
			$fname='First Name';
			$lname='Last Name';
			$username=$username;
			$email='Email';	
			$day='5';
			$month='5';
			$year='1991';
			$password='000';
			$orgpassword='123456';
			$gender='gender';
			$address='null';
			$zipcode='000';
			$contact='123456';
			$image='null';
			$weight='000';
			$school='n';
			$status=1;
			$emailverification=1;
			$stoken='ds';
			$fbUniqueID='null';
			$twUniqueID=$uid;
			$isFBorTwitter=$oauth_provider;

            $query = mysql_query("INSERT INTO users (firstname,lastname,username,email,day,month,year,password,orgpassword,gender,address,zip,contact,image,weight,school,status,email_confirmation,secToken,fbUniqueID,twUniqueID,isFBorTwitter) 
	    VALUES('$fname','$lname','$username','$email','$day','$month','$year','$password','$orgpassword','$gender','$address','$zipcode','$contact','$image','$weight','$school','$status','$emailverification','$stoken','$fbUniqueID','$twUniqueID','$isFBorTwitter')");
	  //echo "INSERT INTO users (firstname,lastname,username,email,password,address,zip,contact,image,wieght,school,status,email_confirmation,secToken,fbUniqueID,twUniqueID,isFBorTwitter) 
	    //VALUES ('$fname','$lname','$username','$email','$password','$address','$zipcode','$contact','$image','$weight','$school','$status','$emailverification','$stoken','$fbUniqueID','$twUniqueID','$isFBorTwitter')";
            $query = mysql_query("SELECT * FROM users WHERE twUniqueID = '$uid' and isFBorTwitter = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }

    

}

?>
