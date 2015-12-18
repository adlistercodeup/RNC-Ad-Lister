<?php


require_once 'BaseModel.php';


class User extends Model {

	protected static $table = 'user_account';



	public static function findUser($user_name) {
        // Get connection to the database - needed because find does not need an object instantiation and therefore
        	//does not go through the constructor
        self::dbConnect();

        $findQuery = "SELECT * FROM  ". static::$table. "  WHERE user_name= :user_name";
        $stmt = self::$dbc->prepare($findQuery);
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
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




