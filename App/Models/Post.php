<?php

namespace App\Models;
use App\Models\DB;
use PDO;

/**
 * Post model
 *
 * PHP version 5.4
 */
class Post extends \Core\Model
{

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        //$host = 'localhost';
        //$dbname = 'mvc';
        //$username = 'root';
        //$password = 'secret';
    
        try {
            // $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $db = static::getDB();

            // $db = DB::getInstance();
            // $db->query("SELECT * FROM posts");
            
            $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
            // $results = $db->getResults();
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
