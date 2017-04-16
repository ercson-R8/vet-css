<?php

namespace App\Controllers\User;

use \Core\View;
use App\Controllers\Auth\Session;
use App\Models\DB;
/**
 * Home controller
 *
 * PHP version 5.4
 */
class UserController extends \Core\Controller{


    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        $sessionData = Session::getInstance();
        if (!$sessionData->inSession){
            header("Location: /home/logout");
            exit;
        }
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {

    }


    public function indexAction(){
        echo "you have landed...";
    }

    public function addUserAction(){
        echo "you have landed...";
        // exit;
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM user');
            $userGroupTable = ($db->getResults());
            // $db->query('SELECT * FROM posts');

            
            $db->query("SELECT * FROM user ");
            // print_r("<pre>");
            // print_r($db->getResults());
            $user_group = $db->getResults();
            
            View::renderTemplate ('Users/addUserForm.twig.html', [
                                        'userGroupTable'=> $userGroupTable,
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'user_group'    => $user_group,
                                        'title'         => 'Add New User',
                                        'tableHeadings' => ['First', 'Last', 'Email', 'Rights']

                                    ]);


        
        }else {
            View::renderTemplate('Auth/login.twig.html');
        }
    }

    /*
     * editProfile method display form to edit detail
     *
     * @param		
     * @return	 	
     */
    public function editProfileAction (){

        $db = DB::getInstance();
        $sessionData = Session::getInstance();
          
        $oldEntry = [   "id"            => $sessionData->id,
                        "email"         => $sessionData->email,
                        "first_name"    => $sessionData->firstName,
                        "last_name"     => $sessionData->lastName,
                        "password"      => $sessionData->password,
                        "rights"        => $sessionData->rights
                     ];
        // render the page 
        View::renderTemplate ('Users/editProfileForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Profile',
                                    

                                ]);       
    }

    /*
     * updateProfileAction method 
     *
     * @param		
     * @return	 	
     */
    public function updateProfileAction (){
        // echo "<pre>";
        // print_r($_POST);

        // exit;
        /*
            
            Array
                (
                    [first_name] => John
                    [last_name] => Doe
                    [email] => admin@admin.com
                    [password] => password
                    [confirm_password] => password
                    [user_id] => 
                    [submit] => 
                )

        */

        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $first_name         = $_POST["first_name"];
        $last_name          = $_POST["last_name"];
        $email              = $_POST["email"];
        $password           = $_POST["password"];
        $confirm_password   = $_POST["confirm_password"];
        $id                 = $sessionData->id;
        $errorMsg           = '';

            
        if( strcmp($confirm_password, $password)){
            
            $errorMsg .= ' *Passwords does not match.';
        }

        // new email entered
        if (  strcmp($email, $sessionData->email) ) {
           
            // check if email already exist; 
            $db->select(
                array('user.email', 'user.password', 'user.rights', 'user.first_name', 'user.last_name'),
                array('user'),
                array(['user.email',    '=', $email ])
            );

            if( $db->count() > 0){

                // user email already taken
                $errorMsg .= ' *Email already taken.';

            }


        }


        if (strlen($errorMsg) > 0 ){
            // return to previous action for correcting error 

            $sessionData = Session::getInstance();
            
            $oldEntry = [   "id"            => $sessionData->id,
                            "email"         => $email,
                            "first_name"    => $first_name,
                            "last_name"     => $last_name,
                            "password"      => $password,
                            
                        ];
            // render the page 
            View::renderTemplate ('Users/editProfileForm.twig.html', [
                                        'status'        => '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <h4 class="text-center">'.$errorMsg.'</h4>
                                                                </div>',
                                        'firstName'     => $sessionData->firstName,
                                        'oldEntry'      => $oldEntry,
                                        'accessRight'   => $sessionData->rights,
                                        'title'         => 'Edit Profile',
                                        

                                    ]);
            exit;

        }else{ // clear to processs profile change
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $db->update ('user', 
                                array(  ['first_name',  '=', $first_name],
                                        ['last_name',   '=', $last_name],
                                        ['email',       '=', $email],
                                        ['password',    '=', $hashedPassword]
                                    ),
                                array(['id','=', $id])
                    );
            $sessionData = Session::getInstance();
            
            $oldEntry = [   "id"            => $sessionData->id,
                            "email"         => $email,
                            "first_name"    => $first_name,
                            "last_name"     => $last_name,
                            "password"      => $password,
                            
                        ];
            // render the page 
            View::renderTemplate ('Users/editProfileForm.twig.html', [
                                        'status'        => '<div class="alert alert-success alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <h4 class="text-center">Profile Change Successful!</h4>
                                                                </div>',
                                        'firstName'     => $sessionData->firstName,
                                        'oldEntry'      => $oldEntry,
                                        'accessRight'   => $sessionData->rights,
                                        'title'         => 'Edit Profile',
                                        

                                    ]);
            exit;
            

        }



        

    }


    public function createNewUserAction(){
        // echo "<pre>ready to create new user";
        // print_r($_POST);
        // exit;
        /*
                ready to create new userArray
                    (
                        [first_name] => a
                        [last_name] => a
                        [email] => james@doe.com
                        [password] => asdfasf
                        [section] => 0
                        [submit] => 
                    )


        */
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $first_name = $_POST["first_name"];
        $last_name  = $_POST["last_name"];
        $email      = $_POST["email"];
        $rights     = $_POST["rights"];
        $password   = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        $db->select(
            array('user.email', 'user.password', 'user.rights', 'user.first_name', 'user.last_name'),
            array('user'),
            array(
                ['user.email',    '=', $email ]
            )
        );
        $user = ($db->getResults());

        // it alread exist
        if($db->count() > 0){
            
            $db = DB::getInstance();
            $db->query('SELECT * FROM user');
            $userGroupTable = ($db->getResults());
            
            $db->query("SELECT * FROM user ");

            $user_group = $db->getResults();
            
            // render the page 
            View::renderTemplate ('Users/addUserForm.twig.html', [
                                    'status' => '<div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h4 class="text-center">User email already exist!</h4>
                                                </div>',
                                    'userGroupTable'    => $userGroupTable,
                                    'firstName'         => $sessionData->firstName,
                                    'accessRight'       => $sessionData->rights,
                                    'user_group'        => $user_group,
                                    'title'             => 'Add New User',
                                    'tableHeadings'     => ['First', 'Last', 'Email', 'Rights']
                                ]);

        }else { // process the data

                    
            // save the data 
            $db->insert('user', 
                array(  'first_name'    => $first_name,
                        'last_name'     => $last_name,
                        'email'         => $email,
                        'rights'        => $rights,                        
                        'password'      => $password
            ));


            $db->query('SELECT * FROM user');
            $userGroupTable = ($db->getResults());
            
            $db->query("SELECT * FROM user ");

            $user_group = $db->getResults();
            
            // render the page 
            View::renderTemplate ('Users/addUserForm.twig.html', [
                                            'status' => '<div class="alert alert-success alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">A New User has been added!</h4>
                                                        </div>',
                                            'userGroupTable'    => $userGroupTable,
                                            'firstName'         => $sessionData->firstName,
                                            'user_group'        => $user_group,
                                            'accessRight'   => $sessionData->rights,
                                            'title'             => 'Add New User',
                                            'tableHeadings'     => ['First', 'Last', 'Email', 'Rights']
                                        ]);
            
        }

    }

    /*
     * editTraineeGroup method display form to edit detail
     *
     * @param		
     * @return	 	
     */
    public function editUserAction (){
        $sessionData = Session::getInstance();
        // echo "<pre>parameter is : ";
        // print_r($this->route_params['id']);
        // exit;
        $sessionData->editID = $this->route_params['id'];
        header("Location: /User/UserController/redirectEditUser");
        exit;        
    }

    /*
     * redirectUser method 
     *
     * @param		
     * @return	 	
     */
    public function redirectEditUser (){
        $db = DB::getInstance();
        $sessionData = Session::getInstance();

        $db->query('SELECT * FROM user WHERE user.id = '.$sessionData->editID);
        $user = ($db->getResults());
          
        $oldEntry = [   "id"            => $user[0]->id,
                        "email"         => $user[0]->email,
                        "first_name"    => $user[0]->first_name,
                        "last_name"     => $user[0]->last_name,
                        "rights"        => $user[0]->rights
                     ];
         // render the page 
        View::renderTemplate ('Users/editUserForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'user'          => $user,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit User',
                                    'tableHeadings' => ['First', 'Last', 'Email', 'Rights']

                                ]);

    }

    /*
     * updateTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function updateUser (){

        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        // $first_name = $_POST["first_name"] ;
        // $last_name  = $_POST["last_name"] ;
        $email      = $_POST["email"] ;
        $rights     = $_POST["rights"] ;
        $id         = $_POST["user_id"];

        //create digest of the form submission:

        $messageIdent = md5($_POST['rights'] . $_POST['user_id']);
        
        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        if($messageIdent!=$sessionMessageIdent){//if it's different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                
                // check if email already exist; 
                $db->select(
                    array('user.email', 'user.password', 'user.rights', 'user.first_name', 'user.last_name'),
                    array('user'),
                    array(
                        ['user.email',    '=', "@" ]
                    )
                );
                
                // save the data
                if($db->count() > 0){
            
                    $db->query('SELECT * FROM user');
                    $userGroupTable = ($db->getResults());
                    
                    $db->query("SELECT * FROM user ");

                    $user_group = $db->getResults();
                    
                    // render the page 
                    View::renderTemplate ('Users/editUserForm.twig.html', [
                                            'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">User email already exist!</h4>
                                                        </div>',
                                            'userGroupTable'    => $userGroupTable,
                                            'firstName'         => $sessionData->firstName,
                                            'user_group'        => $user_group,
                                            'accessRight'       => $sessionData->rights,
                                            'title'             => 'Add New User',
                                            'tableHeadings'     => ['First', 'Last', 'Email', 'Rights']
                    ]);

                }else { // clear to update user

                    $db->update ('user', 
                                array(  
                                        ['rights',      '=', $rights]
                                    ),
                                array(['id','=', $id])
                    );

                    


                    $db->query('SELECT * FROM user');
                    $userGroupTable = ($db->getResults());
                    
                    $db->query("SELECT * FROM user ");

                    $user_group = $db->getResults();
                    header("Location: /User/UserController/addUser");
                    exit; 

                }

        
        } else {
            //you've sent this already!

            $db->query('SELECT * FROM user WHERE user.id = '.$sessionData->editID);
            $user = ($db->getResults());
            
            $oldEntry = [   "id"            => $user[0]->id,
                            "email"         => $user[0]->email,
                            "first_name"    => $user[0]->first_name,
                            "last_name"     => $user[0]->last_name,
                            "rights"        => $user[0]->rights
                        ];
            // render the page 
            View::renderTemplate ('Users/editUserForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">User has already been updated!</h4>
                                                        </div>',
                                        'firstName'     => $sessionData->firstName,
                                        'user'          => $user,
                                        'oldEntry'      => $oldEntry,
                                        'accessRight'   => $sessionData->rights,
                                        'title'         => 'Edit Trainee Group',
                                        'tableHeadings'     => ['First', 'Last', 'Email', 'Rights']

                                    ]);

            
        }

        

    }

    /*
     * deleteCourse method 
     *
     * @param		
     * @return	 	
     */
    public function deleteUser (){
        //         echo "<pre>";
        // print_r($_POST);

        // exit;
        /*
            Array
            (
                [userID] => user@user.com
            )
        */
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $email = $_POST['email'];
        
        //create digest of the form submission:
        $messageIdent = md5($_POST['email']);

        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

        if($messageIdent!=$sessionMessageIdent){//if its different: 

                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // delete the data; 
                $db->delete('user', 
                        array(
                            ['email', '=', $email]
                        )
                ); 

                $db = DB::getInstance();
                $db->query('SELECT * FROM user');
                $userGroupTable = ($db->getResults());


                
                $db->query("SELECT * FROM user ");

                $user_group = $db->getResults();

                // render the page 
                View::renderTemplate ('Users/addUserForm.twig.html', [
                                            'status'        => '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <h4 class="text-center">User has been deleted!</h4>
                                                                </div>',
                                            'userGroupTable'=> $userGroupTable,
                                            'firstName'     => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'user_group'    => $user_group,
                                            'title'         => 'Add New User',
                                            'tableHeadings' => ['First', 'Last', 'Email', 'Rights']

                                        ]);
                


        } else {
            //you've sent this already!
            $db = DB::getInstance();
            $db->query('SELECT * FROM user');
            $userGroupTable = ($db->getResults());
            // $db->query('SELECT * FROM posts');

            
            $db->query("SELECT * FROM user ");
            // print_r("<pre>");
            // print_r($db->getResults());
            $user_group = $db->getResults();
            // render the page 
            View::renderTemplate ('Users/addUserForm.twig.html', [
                                        'status'        => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Data already deleted.</h4>
                                                            </div>',
                                        'userGroupTable'=> $userGroupTable,
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'user_group'    => $user_group,
                                        'title'         => 'Add New User',
                                        'tableHeadings' => ['First', 'Last', 'Email', 'Rights']

                                    ]);

            
        }

    }



}

