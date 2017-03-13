<?php
namespace App\Models;

use PDO;

class DB extends \Core\Model{
/* 
 |--------------------------------------------------------------------------
 | DB
 |--------------------------------------------------------------------------
 | 
 | DB class provide shorthand functionalities for SQL SELECT, INSERT, DELETE, 
 | UPDATE statements. 
 | The class also provides methods to get results (stdClass), result count
 | and 'first' methods that returns the first result of a SELECT operation
 | Use getInstance method to create a DB object.  
 */

    // a flag to check whether an object of this class has been created
    private static $_instance = null; 
    private $_pdo, 
            $_query,
            $_error,
            $_results,
            $_count = 0;

    private function __construct (){
        try {
            $this->_pdo = static::getDB(); // from Core Model, connect to DB return a PDO object 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } 

    /**
     * getInstance method 
     *
     * @param 	void
     * @return	PDO     return an instance of the PDO object 
     */
    public static function getInstance (){
        if(!isset (self::$_instance )){
            self::$_instance = new DB(); // this is the method used to instantiate an object of this class
        }
        return self::$_instance;
    }

    /**
     * query method 
     *
     * @param  	$sql    SQL statement
     *          $params SQL statement parameters
     * @return	void  
     */
    public function query ($sql, $params = array()){
        $this->_error = false;
        
        // echo "<br/><br/><b>From query method :</b><br/>".$sql."<br/>";
        if($this->_query = $this->_pdo->prepare($sql)){
            // Prepare statement successful
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    // echo "Param: ".$param."<br/>";
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()){
                
                $this->_count = $this->_query->rowCount();

                // if sql statement is SELECT, fetch the result otherwise do nothing
                $sqlStatement = explode(' ',trim($sql))[0];
                // echo "<br/>statement is: {$sqlStatement}<br/>";
                if (strcasecmp($sqlStatement, 'SELECT') == 0){
                
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC); 
                
                } 
                
            }else{

                $this->_error = true;

            }
        }
    } 

    public function getResults(){
        return $this->_results;
    }

    /**
     * error method 
     *
     * @param 	none
     * @return  PDO error	 
     */
    public function error (){
        return $this->_error;
    }

    /**
     * first method return the first matching record
     *
     * @param		none
     * @return	 	stdClass   the result
     */
    public function first (){
        
        return $this->getResults()[0];
    }

    /**
     * count method 
     *
     * @param 	none
     * @return	int  the number of rows selected
     */
    public function count (){
         
        return $this->_count;
    }   

    /*
     * action method 
     *
     * @param 	
     * @return	 
     */
    public function action ($action, $table, $where = array()){
        if(count ($where === 3)){
            $operators = array ('=', '<', '>', '<=', '>=', 'LIKE');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                
                // if (!$this->query($sql, array($value))->error()){
                //     return $this;
                // }
                
                $this->query($sql, array($value));
                if (!$this->error()){
                    return $this;
                }
            }
        }
        return false;
    }

    /**
     * get method shorthand for the SQL SELECT * statement 
     *
     * @param 	$table  db table to lookup
     *          $where  SQL where clause
     * @return	PDO     result of the SQL statement in a PDO object
     */
    public function get ($table, $where){
        
        return $this->action('SELECT *', $table, $where);
    }

    /**
     * delete method shorthand for SQL DELETE statement
     *
     * @param 	$table  db table to lookup
     *          $where  SQL where clause
     * @return	PDO     result of the SQL statement in a PDO object
     */
    public function delete ($table, $whereClause = array()){
        $where = '';
        $whereFields = [];
        $x = 1;
        foreach( $whereClause as $whereSet){
            $where .=$whereSet[0]. ' '. $whereSet[1]. ' ?';
            if ($x < count($whereClause)){
                $where .= ' AND ';
            }
            $whereFields += [$whereSet[0] => $whereSet[2]];
            $x++;
        }

        $sql = "DELETE FROM {$table} WHERE {$where}";
        // echo "<br/><br/>SQL: {$sql}"; 
        $this->query($sql, $whereFields);
        if (!$this->error()){
            return $this;
        }
        return false;
    }
    
    /**
     * insert method    
     *   $db->insert('posts', array(
     *           'title' => 'this is title',
     *           'content' => 'this is content'
     *   ));
     *
     * @param		$table      table to be modified
     *              $fields     column and content combo
     * @return	 	bool        true with no error, else false
     */
    public function insert ($table, $fields = array()){
        if (count($fields)){
            $keys = array_keys($fields) ;
            $values = '';
            $x = 1;

            foreach ($fields as $field){
                $values .= ' ?';
                if ($x < count($fields)){
                    $values .= ', ';
                }
                $x++;   
            }
            $sql = "INSERT INTO {$table} (`"  .implode('`, `' ,$keys).   "`) VALUES ({$values})";

            echo "<br/>Sql:".$sql."<br/>fields: ";
            var_dump( $fields);
            echo "<br/>values: ".$values."<br/>";
            $this->query($sql, $fields);
            if (!$this->error()){
                return $this;
            }
        }

        return false;
    }
    /**
     * update method updates a row in a table
     *
     * @param		$table      table to be updated
     *              $id         primary key
     *              $fields     the WHERE clause
     * @return	 	bool        true execute without error, else false
     */
    public function update ($table, $setClause = array (), $whereClause = array()){
        $set = '';
        $where = '';
        $x = 1;
        $fields = [];

        foreach($setClause as $sets){
            $set .= $sets[0]. ' '. $sets[1]. ' ? ';
            if($x < count($setClause)){
                $set .= ', ';
            }
            $fields += [$sets[0] => $sets[2]];
            $x++;
        }
        $x = 1;
        foreach($whereClause as $whereSets){
            $where .= $whereSets[0]. ' '. $whereSets[1]. ' ? ';
            if($x < count($whereClause)){
                $set .= ', ';
            }
            $fields += [$whereSets[0] => $whereSets[2]];
            $x++;
        }
        $sql = "UPDATE {$table} SET {$set} WHERE {$where}";

        echo "Fields: ";
        print_r($fields); 
        $this->query($sql, $fields);
        if (!$this->error()){
            return $this;
        }

        return false;
    }

    /*
     * select method 
     *
     * @param		
     * @return	 	
     */
    public function select ($fields = array(), $table = array(),  $whereClause = array ()){
        // SELECT posts.id, posts.title, users.id, users.email 
        // FROM posts, users 
        // WHERE posts.id = 1 AND users.id = 1
        $fieldSet = '';
        $x = 1;
        foreach ($fields as $f){
            $fieldSet .= $f;
            if ($x < count($fields)){
                $fieldSet .= ', ';
            }
            $x++;
        }
        $tableSet = '';
        $x = 1;
        foreach ($table as $t){
            $tableSet .= $t;
            if ($x < count($table)){
                $tableSet .= ', ';
            }
            $x++;
        }
        $where = '';
        $whereFields = [];
        $x = 1;
        foreach( $whereClause as $whereSet){
            $where .=$whereSet[0]. ' '. $whereSet[1]. ' ?';
            if ($x < count($whereClause)){
                $where .= ' AND ';
            }
            $whereFields += [$whereSet[0] => $whereSet[2]];
            $x++;
        }

        $sql = "SELECT {$fieldSet} FROM {$tableSet} WHERE {$where}";
        // echo "<br/><br/>SQL: {$sql}"; 
        $this->query($sql, $whereFields);
        if (!$this->error()){
            return $this;
        }
        return false;
    }
}


//  $db->query('SELECT * FROM posts WHERE title = ?', array ('First post'));
// SELECT * FROM posts WHERE title = ?


// no errors...
// array(1) {
//   [0]=>
//   object(stdClass)#7 (4) {
//     ["id"]=>
//     string(1) "1"
//     ["title"]=>
//     string(10) "First post"
//     ["content"]=>
//     string(34) "This is a really interesting post."
//     ["created_at"]=>
//     string(19) "2017-01-04 16:50:45"
//   }
// }
// Array
// (
//     [0] => title
//     [1] => LIKE
//     [2] => %Second post%
// )

// $db-> get(           'posts',           array('title', 'LIKE', '%Second post%'));
//      SELECT * FROM    posts      WHERE         title    LIKE     ?

// array(1) {
//   [0]=>
//   object(stdClass)#6 (4) {
//     ["id"]=>
//     string(1) "2"
//     ["title"]=>
//     string(11) "Second post"
//     ["content"]=>
//     string(27) "This is a fascinating post!"
//     ["created_at"]=>
//     string(19) "2017-01-04 16:50:45"
//   }
// }
 /*
        foreach ($setClause as $col => $setValue){
            echo "col: {$col} value: {$setValue} <br/>";
            $set .= "{$col} = ? ";
            if ($x < count($setClause)){
                $set .= ', ';
            }
            $x++;   
        }
        echo "<br/>{$set}<br/>";
        $x = 1;
        foreach ($whereClause as $col => $WhereValue){
            $where .= "{$col} = ? ";
            if ($x < count($whereClause)){
                $where .= ', ';
            }
            $x++;   
        }
        





        
        //  $sql = "INSERT INTO {$table} (`"  .implode('`, `' ,$keys).   "`) VALUES ({$values})";
        // INSERT INTO posts (`title`, `content`) VALUES ( ?,  ?)


        // UPDATE sql: UPDATE posts SET (`column1`, `column2`) column1 = ? , column2 = ?  
        // WHERE (`some_column`) some_column = ? 

        // column1 = ? , column2 = ? 
        // UPDATE sql: UPDATE posts SET column1 = ? , column2 = ? 
        //                                 WHERE some_column1 = ? 
        // ("UPDATE table SET name=? WHERE id=?");
        echo "UPDATE sql: ".$sql."<br/>";
        // $fields = $setClause + $whereClause;


 */