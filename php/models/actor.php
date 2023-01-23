<?php
class Actor {

        private $id;
        private $firstname;
        private $lastname;
        private $DOB;
        private $idcountry;

        public function __construct($idActor,$firstnameActor,$lastnameActor,$DOBActor,$idcountryActor)
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
    
}


?>