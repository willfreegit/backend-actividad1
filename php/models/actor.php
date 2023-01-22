<?php
    class Actor {

        private $id;
        private $firstname;
        private $lastname;
        private $DOB;
        private $idcountry;

        public function _Construct($idActor,$firstnameActor,$lastnameActor,$DOBActor,$idcountryActor)
        {
            $this->id=$idActor;
            $this->firstname=$firstnameActor;
            $this->lastname=$lastnameActor;
            $this->DOB=$DOBActor;
            $this->idcountry=$idcountryActor;

        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        /**
         * @return firstname
         */
        public function getfirstname(){
            return $this->firstname;
        }

        public function setfirstname($firstname){
            $this->firstname=$firstname;
        }

        /**
         * @return lastname
         */
        public function getlastname(){
            return $this->lastname;
        }

        public function setlastname($lastname){
            $this->lastname=$lastname;
        }

        /**
         * @return DOB
         */
        public function getDOB(){
            return $this->DOB;
        }

        public function setDOB($DOB){
            $this->DOB=$DOB;
        }

         /**
         * @return idcountry
         */
        public function getidcountry(){
            return $this->idcountry;
        }

        public function setidcountry($idcountry){
            $this->idcountry=$idcountry;
        }
       
    }
?>