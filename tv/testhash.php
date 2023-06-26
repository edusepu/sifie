<?php
    
	$txt="RoJuBe20";
	$pass="$2a$10$0tUjGjHwv45hpPLg7ovMHe6J.oz2NVChcwH4ODusbFAG4ANYol0rq";
	
	if(password_verify($txt,$pass))
    echo "Welcome";

    else
    echo "Wrong Password";

// $_POST["password"] ---> Is The User`s Input
// $hashed_password ---> Is The Hashed Password You Have Fetched From DataBase
?>
