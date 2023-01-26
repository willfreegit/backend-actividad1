<?php
    class Platform {
        private $id;
        private $name;


        public function __construct($platformId=null,$nameplatform=null)
        {
            $this->id = $platformId;
            $this->name = $nameplatform;

        }


        /**
         * @return id
         */
        public function getId(){
            return $this->id;
        }

        /**
         * @param id
         */
        public function setId($id){
            $this->id = $id;
        }

        /**
         * @return name
         */
        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name=$name;
        }



        function getAll(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
            $platformList = [];
            $query="SELECT id, name FROM platforms order by id";               
        
            $plataformas= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($plataformas)){
                $iplatform = new Platform($row['id'], $row['name']);
         /*Depuracion de valores que se envian a las vistas
                echo $iplatform->getId().'<br>';
                echo $row['name'].'<br>';
         */       
                array_push($platformList, $iplatform);
            }
        
            $mysqli ->close( ) ;
            return $platformList;
           }
        

        function savePlatform()
        {
            $platformcreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->name;
            if($var === null) {echo "Error en insert de la plataforma: El nombre de la plataforma esta vacio";  $platformcreated=false;}
            

            if (!$platformcreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from platforms where name='".$this->name."'";
           // echo " select: ". $query;
           
            $plataformas= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($plataformas);
            if ($rowcount>0)
                {
                    $platformcreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado la plataforma no se puede insertar";
                }
            else
                {
                    $query= "INSERT INTO platforms(name) VALUES('$this->name')";
                    
                    $add_platform = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_platform){
                        $platformcreated=true;
                    } else {
                        $platformcreated=false;
                        echo " Error en insert de la plataforma: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $platformcreated;
        }

        function updatePlatform()
        {
            $platformupdated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;
            if($var === null) {echo "Error en insert de la plataforma: El id de la plataforma esta vacio";  $platformupdated=false;}
            $var=$this->name;
            if($var === null) {echo "Error en insert de la plataforma: El nombre de la plataforma esta vacio";  $platformupdated=false;}

            if (!$platformupdated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from platforms where name='".$this->name."' and id<>".$this->id;
           // echo " select: ". $query;
           
            $plataformas= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($plataformas);
            if ($rowcount>0) 
                {
                    $platformupdated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado la plataforma no se puede actualizar";
                }
            else
                {
                    $query= "UPDATE platforms set name='".$this->name."' where id=".$this->id;
                    //echo " select: ". $query;
                    $add_platform = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_platform){
                        $platformupdated=true;
                    } else {
                        $platformupdated=false;
                        echo " Error en actualización de la plataforma: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $platformupdated;
        }


        function getItem(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
           
            $query="SELECT id, name FROM platforms where id=".$this->id;               
        
            $plataformas= mysqli_query($mysqli,$query);   
            
            foreach ($plataformas as $item)
            {  $itemObject =new Platform($item['id'], $item['name']);
                break;
            }
        
            $mysqli ->close( ) ;
            return $itemObject;
           }
        

           function delete()
           {
   
            $platformdeleted=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;

            if($var === null)
            {
                echo "Error en insert de la plataforma: El id de la plataforma esta vacio";  
                $platformdeleted=false;
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen plataformas asignados a series antes de borrarlos*/

            $query= "select * from series where idplatform=".$this->id;
           // echo " select: ". $query;
           
            $plataformas= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($plataformas);
            if ($rowcount>0) 
                {
                    $platformdeleted=false;
                    $mysqli ->close( ) ;
                    echo " Error la plataforma esta asignada a una serie";
                }
            else
                {
                    $query= "delete from platforms where id=".$this->id;
                    //echo " select: ". $query;
                    $add_platform = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_platform){
                        $platformdeleted=true;
                    } else {
                        $platformdeleted=false;
                        echo " Error en el borrado de la plataforma: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $platformdeleted;
        }
        

    }

?>