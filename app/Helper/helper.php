<?php
 


function getAllRoles()
{
	return \App\Models\Role::all();
}

function getAllPermissions()
{
	return \App\Models\Permission::all();
}


function getRoleNamebyId($id)
{
	return \App\Models\Role::where('id', $id)->first();
}

function getPermissionNamebyId($id)
{
	return \App\Models\Permission::where('id', $id)->first();
}



function sendCommentAlert($data)
{

    // dd($data);
	$sub_type = isset($data['sub_type']) ? $data['sub_type'] : 'Comment';
	$name = isset($data['name']) ? $data['name'] : '';

	if (isset($data['link']) && isset($data['type']) && $data['email'] ) {
		if ($data['type'] == 'Verification') {
			$content = "<html><body>Hello ". $name ." ,\n<br>If you click the Verify Email Address your account will get verified.". $data['link'] . "</body></html>" ;
			$subject = "You have a Register on your " . $data['type'] . " Email Address";
		}
		elseif ($data['type'] == 'ForgotPassword') {
			$content = "<html><body>Hello ". $name ." ,\n<br>Click the Url to reset the password.". $data['link'] . "</body></html>" ;
			$subject = "You have a Register on your " . $data['type'] . " Email Address";
		}
		
		else{			
			$content = "<html><body>Hello ". $name ." ,\n<br>You have a ". $sub_type ." on your " . $data['type'] . " post. \n\n<br><br>Click on this link to view the  " . $sub_type . ' '. $data['link'] . "</body></html>" ;
			$subject = "You have a " . $sub_type . " on your " . $data['type'] . " post";
		}
		try {
			
			$headers = "From: info@nris.com\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

            $result = mail($data['email'], $subject, $content, $headers );
    

			if ($result) {
				return true;
			} else {
				return false;
			}

			
		} catch (\Exception $e) {
			echo "HERE CATCH";
		    dd($e);
			return $e->getMessage();
		}
	}
	return false;
}


function sendCreadentialsAlert($data){
    // dd($data);
	$sub_type = 'Creadentials';
	$name = isset($data['name']) ? $data['name'] : '';
	$email = isset($data['email']) ? $data['email'] : '';
	$pass = isset($data['pass']) ? $data['pass'] : '';

	if ($data['email'] ) {

		$content = "<html><body>Hello ". $name ." ,\n<br>Successfully your profile created.. \n<br>Please find your credentials below  \n\n<br>
		Email = ". $email .",\n<br>
		password = ". $pass ."
		</body></html>" ;
		$subject = "You have a " . $sub_type;

		try {

			
			$headers = "From: info@nris.com\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

            mail($data['email'], $subject, $content, $headers );
    
			return true;
		} catch (\Exception $e) {
		    dd($e);
			return $e->getMessage();
		}
	}
	return false;
}



function displayDotDot($str){   
	$string = mb_strimwidth($str, 0, 65, "...");
	return $string;
}




