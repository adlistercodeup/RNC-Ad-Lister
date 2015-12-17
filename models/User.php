<?php


require_once '../database/adlist_db_config.php';
require_once '../database/adlist_db_connect.php';

require_once 'BaseModel.php';


class User extends Model {

	protected static $table = 'contacts';



	public static function findUser($username)
    {
        // Get connection to the database - needed because find does not need an object instantiation and therefore
        	//does not go through the constructor
        self::dbConnect();
        $findQuery = "SELECT * FROM  user_account  WHERE user_name= :username";
        $stmt = $dbc->prepare($findQuery);

        $stmt->bindValue


		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
        // The following code will set the attributes on the calling object based on the result variable's contents
        //instantiates an empty object
        $instance = null;
        if ($result)
        {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }	





}




