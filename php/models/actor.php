<?php
class Actor {

        private $id;
        private $firstname;
        private $lastname;
        private $DOB;
        private $idcountry;

        public function __construct($idActor=null,$firstnameActor=null,$lastnameActor=null,$DOBActor=null,$idcountryActor=null)
        {
            $this->id = $idActor;
            $this->firstname = $firstnameActor;
            $this->lastname = $lastnameActor;
            $this->DOB = $DOBActor;
            $this->idcountry = $idcountryActor;

        }

        public function setId($id)
        {
            $this->id = $id;
        }
    
        public function getId()
        {
            return $this->id;
        }
    
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
        }
    
        public function getFirstname()
        {
            return $this->firstname;
        }
    
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }
    
        public function getLastname()
        {
            return $this->lastname;
        }
    
        public function setDOB($DOB)
        {
            $this->DOB = $DOB;
        }
    
        public function getDOB()
        {
            return $this->DOB;
        }
    
        public function setIdcountry($idcountry)
        {
            $this->idcountry = $idcountry;
        }
    
        public function getIdcountry()
        {
            return $this->idcountry;
        }
    
        function getAll(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
            $actorList = [];
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry FROM actors";               
        
            $actores= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($actores)){
                $iactor = new Actor($row['id'], $row['firstname'], $row['lastname'], $row['DOB'], $row['idcountry']);
         /*Depuracion de valores que se envian a las vistas
                echo $iactor->getId().'<br>';
                echo $row['firstname'].'<br>';
         */       
                array_push($actorList, $iactor);
            }
        
            $mysqli ->close( ) ;
            return $actorList;
           }
        

        function saveActor(){
            $actorcreated=false;
    
            $mysqli = (new CconexionDB)->initConnectionDb();
           
            $query= "INSERT INTO actors(firstname, lastname, DOB, idcountry) VALUES('$this->firstname','$this->lastname','$this->DOB','$this->idcountry')";
            echo $query;
            $add_actor = mysqli_query($mysqli,$query);
            $mysqli ->close( ) ;
            
            if($add_actor){
                $actorcreated=true;
            } else {
                echo "Error insert actor: ". mysqli_error($mysqli);
            }
            return  $actorcreated;
        }

    }



?>