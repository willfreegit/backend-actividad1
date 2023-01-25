<?php
class Director {

        private $id;
        private $firstname;
        private $lastname;
        private $DOB;
        private $idcountry;
        private $nationality;

        public function __construct($directorId=null,$firstnameDirector=null,$lastnameDirector=null,$DOBDirector=null,$idcountryDirector=null,$nationality=null)
        {
            $this->id = $directorId;
            $this->firstname = $firstnameDirector;
            $this->lastname = $lastnameDirector;
            $this->DOB = $DOBDirector;
            $this->idcountry = $idcountryDirector;
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
        
            $directorList = [];
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry,countries.nationality FROM directors, countries
            where directors.idcountry= countries.num_code";               
        
            $directores= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($directores)){
                $idirector = new Director($row['id'], $row['firstname'], $row['lastname'], $row['DOB'], $row['idcountry'],$row['nationality']);
         /*Depuracion de valores que se envian a las vistas
                echo $idirector->getId().'<br>';
                echo $row['firstname'].'<br>';
         */       
                array_push($directorList, $idirector);
            }
        
            $mysqli ->close( ) ;
            return $directorList;
           }
        

        function saveDirector()
        {
            $directorcreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->firstname;
            if($var === null) {echo "Error en insert del director: El nombre del director esta vacio";  $directorcreated=false;}
            $var=$this->lastname;
            if($var === null) {echo "Error en insert del director: El apellido del director esta vacio";  $directorcreated=false;}
            $var=$this->DOB;
            if($var === null || $var === "00/00/0000") {echo "Error en insert del director: La fecha de nacimiento del director esta vacia"; $directorcreated=false;}
            $var=$this->idcountry;
            if($var === null) {echo "Error en insert del director: La nacionalidad del director esta vacia"; $directorcreated=false;}

            if (!$directorcreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from directors where firstname='".$this->firstname."' and lastname='".$this->lastname."' and DOB='".$this->DOB."' and idcountry=".$this->idcountry;
           // echo " select: ". $query;
           
            $directores= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($directores);
            if ($rowcount>0)
                {
                    $directorcreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el director no se puede insertar";
                }
            else
                {
                    $query= "INSERT INTO directors(firstname, lastname, DOB, idcountry) VALUES('$this->firstname','$this->lastname','$this->DOB','$this->idcountry')";
                    
                    $add_director = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_director){
                        $directorcreated=true;
                    } else {
                        $directorcreated=false;
                        echo " Error en insert del director: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $directorcreated;
        }

        function updateDirector()
        {
            $directorupdated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;
            if($var === null) {echo "Error en insert del director: El id del director esta vacio";  $directorupdated=false;}
            $var=$this->firstname;
            if($var === null) {echo "Error en insert del director: El nombre del director esta vacio";  $directorupdated=false;}
            $var=$this->lastname;
            if($var === null) {echo "Error en insert del director: El apellido del director esta vacio";  $directorupdated=false;}
            $var=$this->DOB;
            if($var === null || $var === "00/00/0000") {echo "Error en insert del director: La fecha de nacimiento del director esta vacia"; $directorupdated=false;}
            $var=$this->idcountry;
            if($var === null) {echo "Error en insert del director: La nacionalidad del director esta vacia"; $directorupdated=false;}

            if (!$directorupdated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from directors where firstname='".$this->firstname."' and lastname='".$this->lastname."' and DOB='".$this->DOB."' and idcountry=".$this->idcountry." and id<>".$this->id;
           // echo " select: ". $query;
           
            $directores= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($directores);
            if ($rowcount>0) 
                {
                    $directorupdated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el director no se puede actualizar";
                }
            else
                {
                    $query= "UPDATE directors set firstname='".$this->firstname."', lastname='".$this->lastname."', DOB='".$this->DOB."', idcountry=".$this->idcountry." where id=".$this->id;
                    //echo " select: ". $query;
                    $add_director = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_director){
                        $directorupdated=true;
                    } else {
                        $directorupdated=false;
                        echo " Error en actualización del director: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $directorupdated;
        }


        function getItem(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
           
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry,countries.nationality FROM directors, countries 
            where directors.idcountry = countries.num_code and id=".$this->id;               
        
            $directores= mysqli_query($mysqli,$query);   
            
            foreach ($directores as $item)
            {  $itemObject =new Director($item['id'], $item['firstname'], $item['lastname'], $item['DOB'], $item['idcountry'],$item['nationality']);
                break;
            }
        
            $mysqli ->close( ) ;
            return $itemObject;
           }
        

           function delete()
           {
   
            $directordeleted=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;

            if($var === null)
            {
                echo "Error en insert del director: El id del director esta vacio";  
                $directordeleted=false;
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen directores asignados a series antes de borrarlos*/

            $query= "select * from series_cast where iddirector=".$this->id;
           // echo " select: ". $query;
           
            $directores= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($directores);
            if ($rowcount>0) 
                {
                    $directordeleted=false;
                    $mysqli ->close( ) ;
                    echo " Error el director esta asignado a una serie";
                }
            else
                {
                    $query= "delete from directors where id=".$this->id;
                    //echo " select: ". $query;
                    $add_director = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_director){
                        $directordeleted=true;
                    } else {
                        $directordeleted=false;
                        echo " Error en el borrado del director: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $directordeleted;
        }
        

    }



?>