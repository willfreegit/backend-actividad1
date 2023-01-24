<?php
class Actor {

        private $id;
        private $firstname;
        private $lastname;
        private $DOB;
        private $idcountry;
        private $nationality;

        public function __construct($idActor=null,$firstnameActor=null,$lastnameActor=null,$DOBActor=null,$idcountryActor=null,$nationality=null)
        {
            $this->id = $idActor;
            $this->firstname = $firstnameActor;
            $this->lastname = $lastnameActor;
            $this->DOB = $DOBActor;
            $this->idcountry = $idcountryActor;
            $this->nationality = $nationality;

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

        public function setNationality($nationality)
        {
            $this->nationality = $nationality;
        }
    
        public function getnationality()
        {
            return $this->nationality;
        }
        


        function getAll(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
            $actorList = [];
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry,countries.nationality FROM actors, countries
            where actors.idcountry= countries.num_code";               
        
            $actores= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($actores)){
                $iactor = new Actor($row['id'], $row['firstname'], $row['lastname'], $row['DOB'], $row['idcountry'],$row['nationality']);
         /*Depuracion de valores que se envian a las vistas
                echo $iactor->getId().'<br>';
                echo $row['firstname'].'<br>';
         */       
                array_push($actorList, $iactor);
            }
        
            $mysqli ->close( ) ;
            return $actorList;
           }
        

        function saveActor()
        {
            $actorcreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->firstname;
            if($var === null) {echo "Error en insert del actor: El nombre del actor esta vacio";  $actorcreated=false;}
            $var=$this->lastname;
            if($var === null) {echo "Error en insert del actor: El apellido del actor esta vacio";  $actorcreated=false;}
            $var=$this->DOB;
            if($var === null || $var === "00/00/0000") {echo "Error en insert del actor: La fecha de nacimiento del actor esta vacia"; $actorcreated=false;}
            $var=$this->idcountry;
            if($var === null) {echo "Error en insert del actor: La nacionalidad del actor esta vacia"; $actorcreated=false;}

            if (!$actorcreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from actors where firstname='".$this->firstname."' and lastname='".$this->lastname."' and DOB='".$this->DOB."' and idcountry=".$this->idcountry;
           // echo " select: ". $query;
           
            $actores= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($actores);
            if ($rowcount>0)
                {
                    $actorcreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el actor no se puede insertar";
                }
            else
                {
                    $query= "INSERT INTO actors(firstname, lastname, DOB, idcountry) VALUES('$this->firstname','$this->lastname','$this->DOB','$this->idcountry')";
                    
                    $add_actor = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_actor){
                        $actorcreated=true;
                    } else {
                        $actorcreated=false;
                        echo " Error en insert del actor: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $actorcreated;
        }

        function updateActor()
        {
            $actorcreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;
            if($var === null) {echo "Error en insert del actor: El id del actor esta vacio";  $actorcreated=false;}
            $var=$this->firstname;
            if($var === null) {echo "Error en insert del actor: El nombre del actor esta vacio";  $actorcreated=false;}
            $var=$this->lastname;
            if($var === null) {echo "Error en insert del actor: El apellido del actor esta vacio";  $actorcreated=false;}
            $var=$this->DOB;
            if($var === null || $var === "00/00/0000") {echo "Error en insert del actor: La fecha de nacimiento del actor esta vacia"; $actorcreated=false;}
            $var=$this->idcountry;
            if($var === null) {echo "Error en insert del actor: La nacionalidad del actor esta vacia"; $actorcreated=false;}

            if (!$actorcreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from actors where firstname='".$this->firstname."' and lastname='".$this->lastname."' and DOB='".$this->DOB."' and idcountry=".$this->idcountry." and id<>".$this->id;
           // echo " select: ". $query;
           
            $actores= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($actores);
            if ($rowcount>0) 
                {
                    $actorcreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el actor no se puede actualizar";
                }
            else
                {
                    $query= "UPDATE actors set firstname='".$this->firstname."', lastname='".$this->lastname."', DOB='".$this->DOB."', idcountry=".$this->idcountry." where id=".$this->id;
                    echo " select: ". $query;
                    $add_actor = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_actor){
                        $actorcreated=true;
                    } else {
                        $actorcreated=false;
                        echo " Error en actualización del actor: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $actorcreated;
        }


        function getItem(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
           
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry,countries.nationality FROM actors, countries 
            where actors.idcountry = countries.num_code and id=".this->id;               
        
            $actores= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($actores)){
                $iactor = new Actor($row['id'], $row['firstname'], $row['lastname'], $row['DOB'], $row['idcountry'],$row['nationality']);
         /*Depuracion de valores que se envian a las vistas
                echo $iactor->getId().'<br>';
                echo $row['firstname'].'<br>';
         */       
                array_push($actorList, $iactor);
            }
        
            $mysqli ->close( ) ;
            return $actorList;
           }
        



    }



?>