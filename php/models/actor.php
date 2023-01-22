<?php
/*include "../../db/connection_db.php";*/
require_once('../../db/connection_db.php');
class Actor {

        private $id;
        private $firstname;
        private $lastname;
        private $DOB;
        private $idcountry;

        public function _construct($idActor=null,$firstnameActor=null,$lastnameActor=null,$DOBActor=null,$idcountryActor=null)
        {
            $this->id = $idActor;
            $this->firstname = $firstnameActor;
            $this->lastname = $lastnameActor;
            $this->DOB = $DOBActor;
            $this->idcountry = $idcountryActor;

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
  
     
          
        public function getAll()
        {   
            $mysqli = (new CconexionDB)->initConnectionDb();
            $query = $mysqli-> query("SELECT * FROM actors") ;
            $listData = [];
            foreach ($query as $item) {
            $itemObject = new Actor($item['id'], $item['firstname'], $item['lastname'], $item['DOB'], $item['idcountry'] ) ;
            array_push( $listData, $itemObject) ;
            }
        $mysqli ->close( ) ;
        return $listData;
        }
  
}


?>