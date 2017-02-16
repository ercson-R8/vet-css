<?php

namespace App\Controllers;

use \Core\View;
use App\Models\DB;

/**
 * Posts controller
 *
 * PHP version 5.4
 */
class testDBController extends \Core\Controller{


    /*
     * indexAction method 
     *
     * @param 	
     * @return	 
     */
    public function indexAction (){
        $db = DB::getInstance();
        echo "<pre>";
                echo "<br/>";
        print_r($db);
        // $db->insert('posts', array(
        //         'title' => 'insert',
        //         'content' => 'this is insertinsertinsert'
        // ));
        
        


        // SELECT * FROM `posts` WHERE title LIKE '%'
        $db->query('SELECT * FROM posts WHERE title = ? ', array ('First Post'));
        // $db->query('SELECT * FROM posts');
    
        echo "<br/>";
        if ($db->count()){
            echo $db->count()."<br/>no errors...<br/><pre>";
            var_dump($db->getResults());
        }

        // // SELECT statement
        $db->get('posts', array('title', 'LIKE', '%'));
        // var_dump($db->getResults());

        // display the results
        foreach ($db->getResults() as $result){
            echo $result->title. "<br/>";
        }


        echo "<br/>Using first() method:<br/>";
        print_r( $db->first());

        echo "<br/>Using getResults() method:<br/>";
        print_r( $db->getResults()[0]->content);


        // UPDATE table_name
        // SET column1=value, column2=value2,...
        // WHERE some_column=some_value

        // table_name, 
        // SET array(column1=value), 
        // WHERE array(some_column=some_value)

        // $db->query('SELECT * FROM posts WHERE title = ?', array ('First post'));
        // $db->query(' ');' 
        // $db->update ('posts', 
        //             array(
        //                 'title'=> 'update63'
        //             ),
        //             array(
        //                 'id'=>'63'
        //             )
        // );

        $db->update ('posts', 
                    array (
                        ['title','=','update'],
                        ['content','=','updateupdate 63 63 63 ']
                    ),
                    array(
                        ['id','=','65']
                    )
        );
        $a = array (
            ['title','=','update 32'],
            ['post','=','update 63']
        );
        $a_fields = [];
        $a_set = '';
        $x = 1;
        foreach ($a as $sets){
            // print_r($sets);
            // echo '<br/>col: '.$sets[0]. ' '. $sets[1];
            $a_set .= $sets[0]. ' '. $sets[1]. ' ? ';
            if($x < count($sets)){
                $a_set .= ', ';
            }
            $a_fields += [$sets[0] => $sets[2]];
            // echo '<br/>value: '.$sets[2]; 
            $x++;
        }
        // SELECT id, title FROM posts WHERE id = 1 and title LIKE 'F%'

        // SELECT posts.id, posts.title, users.id, users.email 
        // FROM posts, users 
        // WHERE posts.id = 1 AND users.id = 1
        $cols = array(
                'posts.id', 'posts.title', 'users.id', 'users.email'
            );
        $tables = array ('posts', 'users'
        );


        // $colSet = '';
        // $x = 1;
        // echo count($cols);
        // foreach ($cols as $f){
        //     $colSet .= $f;
        //     echo "<br/>{$x}: {$colSet}";
        //     if ($x < count($cols)){
        //         $colSet .= ', ';
        //     }
        //     $x++;
        // }
        // echo "<br/>{$x}: {$colSet} <br/>";


        $whereClause = array(
                ['posts.id', '=', '1'],
                ['users.id', '=', '1']
            );

        
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

  

        // // display the results
        // foreach ($db->getResults() as $result){
        //     echo $result->title. "<br/>";
        // }
        // $y = 1;
        // $where = '';
        // foreach ($whereClause as $whereSet){
        //     $x = 1;

        //     foreach ($whereSet as $ws){
        //         $where .= $ws.' ?';
        //         if ($x < count($whereSet)){
        //             $where .= ', ';
        //         }
        //         $x++;
        //     }
        //     if ($y < count($whereClause) ){
        //         $where .= ' AND ';
        //     }
        //     $y++;
        // }
        // echo "{$where} <br/><br/>";
        // print_r($whereFields);

        $db->select(
            array('posts.id', 'posts.title', 'users.id', 'users.email'),
            array('posts', 'users'),
            array(
                ['posts.id', '=', '1'],
                ['users.id', '=', '1']
            )
        );
        echo "<br/>Result count: {$db->count()}<br/> ";
        if ($db->count()){
            print_r ($db->getResults());
            var_dump($db->first());

            foreach ($db->getResults() as $result){
                echo $result->email;
            }
            echo "<br/>{$db->count()} ".$db->first()->title;
        }

        // DELETE FROM `posts` WHERE `posts`.`id` = 67
        $db->delete('posts', 
                array(
                    ['posts.id', '=', '66']
                )
        );
        echo "<br/>Result count: {$db->count()}<br/> ";




        // echo "<br/>{$a_set}<br/>";
        // print_r($a_fields);
        /* 
        array(4) {
                [0]=>
                object(stdClass)#7 (4) {
                    ["id"]=>
                    string(1) "1"
                    ["title"]=>
                    string(10) "First post"
                    ["content"]=>
                    string(34) "This is a really interesting post."
                    ["created_at"]=>
                    string(19) "2017-01-04 16:50:45"
                }
                [1]=>
        */




 
        
    }



}