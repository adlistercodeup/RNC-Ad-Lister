<?php


class Model {
	// Array to store our key/value 
	public $attributes = [];	
	//table will represent a database table
	protected static $table;
	//represents database connection
	protected static $dbc;
	//constructor
	public function __construct()
    {
        self::dbConnect();
    }
    //Connect to the DB
    private static function dbConnect()
    {
    	//self:: will ensure that all children use this database connection and private will ensure that children still can't 
    	//access this method through the public constructors which calls this method
        //if the database is not connected, then connect
        if (!isset(static::$dbc)) 
        {

            require_once '../database/adlist_db_config.php';
            require_once '../database/adlist_db_connect.php';

        	static::$dbc = $dbc;

        }
    }
    //Get a value from attributes based on name (name == 'key' or 'index') using magic getter
    public function __get($name)
    {
        //Return the value from attributes with a matching $name, if it exists
    	if (array_key_exists($name, $this->attributes)) {
    		return $this->attributes[$name];
    	}
    	return NULL;
    }
    
    // Magic setter to populate $attributes array
    public function __set($name, $value)
    {
        // Store the $key 'key' to hold $value in $attributes array
        $this->attributes[$name] = $value;
    }
    public static function getTableName()
    {
    	return self::$table;
    }
    private function insert ()
    {
        // @TODO: Use prepared statements to ensure data security - escape and trim
		//Describe will describe the current database
		$query = self::$dbc->prepare("DESCRIBE " . static::$table);
		$query->execute();
		//will return all the column names - regardless of the table being used
		//can also get all the column names $table_columns = array_keys ($this->attributes)
		$table_columns = $query->fetchAll(PDO::FETCH_COLUMN);
		$insertQuery = "INSERT INTO " . static::$table . ' (';
		$id = array_shift($table_columns);
        //You will need to iterate through all the attributes to build the prepared query
		foreach ($table_columns as $column)
		{
			$insertQuery = $insertQuery . $column . ', ';
		}
		$insertQuery = substr($insertQuery, 0, -2);
		$insertQuery = $insertQuery . ") VALUES (:";
		foreach ($table_columns as $column)
		{
			if (!empty ($this->attributes[$column]))
			{
				$insertQuery = $insertQuery . $column . ', :';
			}
		}
		$insertQuery = substr($insertQuery, 0, -3);
		$insertQuery = $insertQuery . ")";
		$stmt = self::$dbc->prepare($insertQuery);
		foreach ($table_columns as $column) 
		{
			$stmt->bindValue(":" . $column, $this->attributes[$column], PDO::PARAM_STR);
		}
		$stmt->execute();
		array_unshift ($this->attributes, $id);
    }
    public function update($id){
        //Ensure that update is properly handled with the id key
    	 // @TODO: Use prepared statements to ensure data security - escape and trim
		$table_columns = array_keys($this->attributes);
		// actually remove 'id'
		$idPopped = array_shift($table_columns);
		$updateQuery = "UPDATE " . static::$table . " SET ";
		foreach ($table_columns as $column)
		{
			$updateQuery .= "{$column}=:{$column}, ";
		}
		$updateQuery = substr($updateQuery, 0, -2);
		$updateQuery .= " WHERE id= :id";
		$stmt = self::$dbc->prepare($updateQuery);
		//bind here needs to include id
		foreach ($this->attributes as $column => $value) 
		{
			$stmt->bindValue(":" . $column, $value, PDO::PARAM_STR);
		}
		$stmt->execute();
		//add the id back
		$this->attributes['id'] = $id;
    }
    public static function find($id)
    {
        // Get connection to the database - needed because find does not need an object instantiation and therefore
        	//does not go through the constructor
        self::dbConnect();
        $findQuery = "SELECT * FROM " . static::$table . " WHERE id=" . $id;
        $stmt = self::$dbc->prepare($findQuery);
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
    //Persist the object to the database
    public function save()
    {
    	$message = "";
       	//Ensure there are attributes before attempting to save
    	if (!empty ($this->attributes))
    	{
        	//Perform the proper action - if the `id` is set, this is an update, if not it is a insert
    		if (isset($this->attributes['id']))
    		{
    			$this->update($this->attributes['id']);
    		} else {
		    	try {
		    		$this->insert();
				} catch (Exception $e) {
		    		// Report any errors
					$message = 'Unable to add contact to the database: ' . $e->getMessage();
				}
				return $message;
			}
		}
    }
    //Find all records in the table
    public static function all()
    {
        //Return all the matching records
        self::dbConnect();
        $findAllQuery = "SELECT * FROM " . static::$table;
        $stmt = self::$dbc->prepare($findAllQuery);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public static function delete($id)
    {
    	$message = "";
		try {
			//delete record
			//should be querying a select statement to make sure intended record will be deleted
	        $deleteQuery = "DELETE FROM " . static::$table . " WHERE id=" . $id;
        	$stmt = self::$dbc->prepare($deleteQuery);
			$result = $stmt->execute();			
		} catch (Exception $e) {
			//unable to delete
			$message = 'Unable to delete contact from the database: ' . $e->getMessage();
		}
		return $message;
    }
}
//TODO:  All queries should not have variables...instead we should be binding the values