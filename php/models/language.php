<?php
class Language
{
	private $id;
	private $language_name;
    private $language_isocode;


    public function __construct($languageId=null,$language_name=null,$language_isocode=null)
    {
        $this->id = $languageId;
        $this->language_name = $language_name;
        $this->language_isocode = $language_isocode;

    }

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setLanguage_name($language_name)
	{
		$this->language_name = $language_name;
	}

	public function getLanguage_name()
	{
		return $this->language_name;
	}

	public function setLanguage_isocode($language_isocode)
	{
		$this->language_isocode = $language_isocode;
	}

	public function getLanguage_isocode()
	{
		return $this->language_isocode;
	}


        function getAll(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
            $languageList = [];
            $query="SELECT id, language_name,language_isocode FROM languages order by id";               
        
            $languages= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($languages)){
                $ilanguage = new Language($row['id'], $row['language_name'], $row['language_isocode']);
         /*Depuracion de valores que se envian a las vistas
                echo $ilanguage->getId().'<br>';
                echo $row['language_name'].'<br>';
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

            $var=$this->language_name;
            if($var === null) {echo "Error en insert del idioma: El nombre del idioma esta vacio";  $languagecreated=false;}
            $var=$this->language_isocode;
            if($var === null) {echo "Error en insert del idioma: El código del idioma esta vacio";  $languagecreated=false;}

            if (!$languagecreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from languages where language_name='".$this->language_name."' and language_isocode='".$this->language_isocode."'";
           // echo " select: ". $query;
           
            $languages= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($languages);
            if ($rowcount>0)
                {
                    $languagecreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el idioma no se puede insertar";
                }
            else
                {
                    $query= "INSERT INTO languages(language_name, language_isocode) VALUES('$this->language_name','$this->language_isocode')";
                    
                    $add_language = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_language){
                        $languagecreated=true;
                    } else {
                        $languagecreated=false;
                        echo " Error en insert del idioma: ". mysqli_error($mysqli);
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
            if($var === null) {echo "Error en insert del idioma: El id del idioma esta vacio";  $languageupdated=false;}
            $var=$this->language_name;
            if($var === null) {echo "Error en insert del idioma: El nombre del idioma esta vacio";  $languageupdated=false;}
            $var=$this->language_isocode;
            if($var === null) {echo "Error en insert del idioma: El código ISO del idioma esta vacio";  $languageupdated=false;}

            if (!$languageupdated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from languages where language_name='".$this->language_name."' and language_isocode='".$this->language_isocode."' and id<>".$this->id;
           // echo " select: ". $query;
           
            $languages= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($languages);
            if ($rowcount>0) 
                {
                    $languageupdated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el idioma no se puede actualizar";
                }
            else
                {
                    $query= "UPDATE languages set language_name='".$this->language_name."', language_isocode='".$this->language_isocode."' where id=".$this->id;
                    //echo " select: ". $query;
                    $add_language = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_language){
                        $languageupdated=true;
                    } else {
                        $languageupdated=false;
                        echo " Error en actualización del idioma: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $languageupdated;
        }


        function getItem(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
           
            $query="SELECT id, language_name,language_isocode FROM languages where id=".$this->id;               
        
            $languages= mysqli_query($mysqli,$query);   
            
            foreach ($languages as $item)
            {  $itemObject =new Language($item['id'], $item['language_name'], $item['language_isocode']);
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
                echo "Error en insert del idioma: El id del idioma esta vacio";  
                $languagedeleted=false;
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen idiomas asignados a series antes de borrarlos*/

            $query= "select * from series_audio_languages where idlanguage=".$this->id;
            //echo " select: ". $query;
           
            $languages= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($languages);
            if ($rowcount>0) 
                {
                    $languagedeleted=false;
                    $mysqli ->close( ) ;
                    echo " Error el idioma esta asignado como idioma en una serie";
                }
            else
                {


                    $query= "select * from series_subtitles where idlanguage=".$this->id;
                    //echo " select: ". $query;
                    
                     $languages= mysqli_query($mysqli,$query);   
                     $rowcount=mysqli_num_rows($languages);
                     if ($rowcount>0) 
                         {
                             $languagedeleted=false;
                             $mysqli ->close( ) ;
                             echo " Error el idioma esta asignado como subtitulo en una serie";
                         }
         
                    else{
                        $query= "delete from languages where id=".$this->id;
                        //echo " select: ". $query;
                        $add_language = mysqli_query($mysqli,$query);
                        $mysqli ->close( ) ;
                        
                        if($add_language){
                            $languagedeleted=true;
                        } else {
                            $languagedeleted=false;
                            echo " Error en el borrado del idioma: ". mysqli_error($mysqli);
                        }
                    }
                }
            }
            return  $languagedeleted;
        }
       
}

?>