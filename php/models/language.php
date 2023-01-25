<?php
class Language
{
	private $id;
	private $language_isocode;
	private $language_name;

        public function __construct($languageId=null,$firstnameLanguage=null,$lastnameLanguage=null,$DOBLanguage=null,$idcountryLanguage=null,$nationality=null)
        {
            $this->id = $languageId;
            $this->firstname = $firstnameLanguage;
            $this->lastname = $lastnameLanguage;
            $this->DOB = $DOBLanguage;
            $this->idcountry = $idcountryLanguage;
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

	public function setLanguage_isocode($language_isocode)
	{
		$this->language_isocode = $language_isocode;
	}

	public function getLanguage_isocode()
	{
		return $this->language_isocode;
	}

	public function setLanguage_name($language_name)
	{
		$this->language_name = $language_name;
	}

	public function getLanguage_name()
	{
		return $this->language_name;
	}



        function getAll(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
            $languageList = [];
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry,countries.nationality FROM languages, countries
            where languages.idcountry= countries.num_code order by id";               
        
            $languages= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($languages)){
                $ilanguage = new Language($row['id'], $row['firstname'], $row['lastname'], $row['DOB'], $row['idcountry'],$row['nationality']);
         /*Depuracion de valores que se envian a las vistas
                echo $ilanguage->getId().'<br>';
                echo $row['firstname'].'<br>';
         */       
                array_push($languageList, $ilanguage);
            }
        
            $mysqli ->close( ) ;
            return $languageList;
           }
        

        function saveLanguage()
        {
            $languagecreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->firstname;
            if($var === null) {echo "Error en insert del language: El nombre del language esta vacio";  $languagecreated=false;}
            $var=$this->lastname;
            if($var === null) {echo "Error en insert del language: El apellido del language esta vacio";  $languagecreated=false;}
            $var=$this->DOB;
            if($var === null || $var === "00/00/0000") {echo "Error en insert del language: La fecha de nacimiento del language esta vacia"; $languagecreated=false;}
            $var=$this->idcountry;
            if($var === null) {echo "Error en insert del language: La nacionalidad del language esta vacia"; $languagecreated=false;}

            if (!$languagecreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from languages where firstname='".$this->firstname."' and lastname='".$this->lastname."' and DOB='".$this->DOB."' and idcountry=".$this->idcountry;
           // echo " select: ". $query;
           
            $languages= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($languages);
            if ($rowcount>0)
                {
                    $languagecreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el language no se puede insertar";
                }
            else
                {
                    $query= "INSERT INTO languages(firstname, lastname, DOB, idcountry) VALUES('$this->firstname','$this->lastname','$this->DOB','$this->idcountry')";
                    
                    $add_language = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_language){
                        $languagecreated=true;
                    } else {
                        $languagecreated=false;
                        echo " Error en insert del language: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $languagecreated;
        }

        function updateLanguage()
        {
            $languageupdated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;
            if($var === null) {echo "Error en insert del language: El id del language esta vacio";  $languageupdated=false;}
            $var=$this->firstname;
            if($var === null) {echo "Error en insert del language: El nombre del language esta vacio";  $languageupdated=false;}
            $var=$this->lastname;
            if($var === null) {echo "Error en insert del language: El apellido del language esta vacio";  $languageupdated=false;}
            $var=$this->DOB;
            if($var === null || $var === "00/00/0000") {echo "Error en insert del language: La fecha de nacimiento del language esta vacia"; $languageupdated=false;}
            $var=$this->idcountry;
            if($var === null) {echo "Error en insert del language: La nacionalidad del language esta vacia"; $languageupdated=false;}

            if (!$languageupdated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from languages where firstname='".$this->firstname."' and lastname='".$this->lastname."' and DOB='".$this->DOB."' and idcountry=".$this->idcountry." and id<>".$this->id;
           // echo " select: ". $query;
           
            $languages= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($languages);
            if ($rowcount>0) 
                {
                    $languageupdated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el language no se puede actualizar";
                }
            else
                {
                    $query= "UPDATE languages set firstname='".$this->firstname."', lastname='".$this->lastname."', DOB='".$this->DOB."', idcountry=".$this->idcountry." where id=".$this->id;
                    //echo " select: ". $query;
                    $add_language = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_language){
                        $languageupdated=true;
                    } else {
                        $languageupdated=false;
                        echo " Error en actualización del language: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $languageupdated;
        }


        function getItem(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
           
            $query="SELECT id, firstname,lastname,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB,idcountry,countries.nationality FROM languages, countries 
            where languages.idcountry = countries.num_code and id=".$this->id;               
        
            $languages= mysqli_query($mysqli,$query);   
            
            foreach ($languages as $item)
            {  $itemObject =new Language($item['id'], $item['firstname'], $item['lastname'], $item['DOB'], $item['idcountry'],$item['nationality']);
                break;
            }
        
            $mysqli ->close( ) ;
            return $itemObject;
           }
        

           function delete()
           {
   
            $languagedeleted=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;

            if($var === null)
            {
                echo "Error en insert del language: El id del language esta vacio";  
                $languagedeleted=false;
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen languages asignados a series antes de borrarlos*/

            $query= "select * from series_cast where idlanguage=".$this->id;
           // echo " select: ". $query;
           
            $languages= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($languages);
            if ($rowcount>0) 
                {
                    $languagedeleted=false;
                    $mysqli ->close( ) ;
                    echo " Error el language esta asignado a una serie";
                }
            else
                {
                    $query= "delete from languages where id=".$this->id;
                    //echo " select: ". $query;
                    $add_language = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_language){
                        $languagedeleted=true;
                    } else {
                        $languagedeleted=false;
                        echo " Error en el borrado del language: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $languagedeleted;
        }
       
}

?>