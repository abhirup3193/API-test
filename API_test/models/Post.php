<?php
    class Post {
        //DB Stuff
        private $conn;
        private $table = '1_basic_info';

        //Post Properties
        public $id;        
        public $organization;
        public $projectName;
        public $projectDescription;
        public $req_date;
        public $endUser;
       
        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;           
        }

        //Get Posts
        public function read() {
            //Query
            $query = 'SELECT                         
                       p.id,
                       p.organization,
                       p.projectName,
                       p.projectDescription,
                       p.req_date,
                       p.endUser                     
                    FROM
                        ' . $this->table . ' p
                    ';
                        
                //Prepare statement 
                $stmt = $this->conn->prepare($query);

                //Excute query
                $stmt->execute();

                return $stmt;
        }

    }