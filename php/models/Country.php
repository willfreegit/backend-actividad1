<?php
class Country
{
	private $num_code;
	private $alpha_3_code;
	private $en_short_name;
	private $nationality;

	public function __construct($num_code=null,$alpha_3_code=null,$en_short_name=null,$nationality=null)
	{
        $this->num_code = $num_code;
        $this->alpha_3_code = $alpha_3_code;
        $this->en_short_name = $en_short_name;
        $this->nationality = $nationality;
	}

	public function setNum_code($num_code)
	{
		$this->num_code = $num_code;
	}

	public function getNum_code()
	{
		return $this->num_code;
	}

	public function setAlpha_3_code($alpha_3_code)
	{
		$this->alpha_3_code = $alpha_3_code;
	}

	public function getAlpha_3_code()
	{
		return $this->alpha_3_code;
	}

	public function setEn_short_name($en_short_name)
	{
		$this->en_short_name = $en_short_name;
	}

	public function getEn_short_name()
	{
		return $this->en_short_name;
	}

	public function setNationality($nationality)
	{
		$this->nationality = $nationality;
	}

	public function getNationality()
	{
		return $this->nationality;
	}


	public function getall()
	{
		try
		{

            $mysqli = (new CconexionDB)->initConnectionDb();
        
            $countryList = [];
            $query="SELECT num_code, alpha_3_code, en_short_name, nationality FROM countries";               
        
            $countries= mysqli_query($mysqli,$query);   
            
            
            while($row = mysqli_fetch_array($countries)){
                $icountry = new country($row['num_code'], $row['alpha_3_code'], $row['en_short_name'], $row['nationality']);
                   /*Depuracion de valores que se envian a las vistas
                            echo $icountry->getnum_code().'<br>';
                            echo $icountry->getnationality().'<br>';
                            echo $row['nationality'].'<br>';
                     */     
                array_push($countryList, $icountry);
            }
        
            $mysqli ->close( ) ;
            return $countryList;
		}
		catch(PDOException $exception)
		{
			echo $exception->getMessage();
		}
	}


        function saveLanguage()
        {
            $countrycreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->country_name;
            if($var === null) {echo "Error en insert del país: El nombre del país esta vacio";  $countrycreated=false;}
            $var=$this->country_isocode;
            if($var === null) {echo "Error en insert del país: El código del país esta vacio";  $countrycreated=false;}

            if (!$countrycreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from countries where country_name='".$this->country_name."' and country_isocode='".$this->country_isocode."'";
           // echo " select: ". $query;
           
            $countries= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($countries);
            if ($rowcount>0)
                {
                    $countrycreated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el país no se puede insertar";
                }
            else
                {
                    $query= "INSERT INTO countries(country_name, country_isocode) VALUES('$this->country_name','$this->country_isocode')";
                    
                    $add_country = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_country){
                        $countrycreated=true;
                    } else {
                        $countrycreated=false;
                        echo " Error en insert del país: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $countrycreated;
        }

        function updateLanguage()
        {
            $countryupdated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;
            if($var === null) {echo "Error en insert del país: El id del país esta vacio";  $countryupdated=false;}
            $var=$this->country_name;
            if($var === null) {echo "Error en insert del país: El nombre del país esta vacio";  $countryupdated=false;}
            $var=$this->country_isocode;
            if($var === null) {echo "Error en insert del país: El código ISO del país esta vacio";  $countryupdated=false;}

            if (!$countryupdated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from countries where country_name='".$this->country_name."' and country_isocode='".$this->country_isocode."' and id<>".$this->id;
           // echo " select: ". $query;
           
            $countries= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($countries);
            if ($rowcount>0) 
                {
                    $countryupdated=false;
                    $mysqli ->close( ) ;
                    echo " Error esta duplicado el país no se puede actualizar";
                }
            else
                {
                    $query= "UPDATE countries set country_name='".$this->country_name."', country_isocode='".$this->country_isocode."' where id=".$this->id;
                    //echo " select: ". $query;
                    $add_country = mysqli_query($mysqli,$query);
                    $mysqli ->close( ) ;
                    
                    if($add_country){
                        $countryupdated=true;
                    } else {
                        $countryupdated=false;
                        echo " Error en actualización del país: ". mysqli_error($mysqli);
                    }
                
                }
            }
            return  $countryupdated;
        }


        function getItem(){
            $mysqli = (new CconexionDB)->initConnectionDb();
        
           
            $query="SELECT id, country_name,country_isocode FROM countries where id=".$this->id;               
        
            $countries= mysqli_query($mysqli,$query);   
            
            foreach ($countries as $item)
            {  $itemObject =new Language($item['id'], $item['country_name'], $item['country_isocode']);
                break;
            }
        
            $mysqli ->close( ) ;
            return $itemObject;
           }
        

           function delete()
           {
   
            $countrydeleted=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;

            if($var === null)
            {
                echo "Error en insert del país: El id del país esta vacio";  
                $countrydeleted=false;
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen paises asignados a series antes de borrarlos*/

            $query= "select * from series_audio_countries where idcountry=".$this->id;
            //echo " select: ". $query;
           
            $countries= mysqli_query($mysqli,$query);   
            $rowcount=mysqli_num_rows($countries);
            if ($rowcount>0) 
                {
                    $countrydeleted=false;
                    $mysqli ->close( ) ;
                    echo " Error el país esta asignado como país en una serie";
                }
            else
                {


                    $query= "select * from series_subtitles where idcountry=".$this->id;
                    //echo " select: ". $query;
                    
                     $countries= mysqli_query($mysqli,$query);   
                     $rowcount=mysqli_num_rows($countries);
                     if ($rowcount>0) 
                         {
                             $countrydeleted=false;
                             $mysqli ->close( ) ;
                             echo " Error el país esta asignado como subtitulo en una serie";
                         }
         
                    else{
                        $query= "delete from countries where id=".$this->id;
                        //echo " select: ". $query;
                        $add_country = mysqli_query($mysqli,$query);
                        $mysqli ->close( ) ;
                        
                        if($add_country){
                            $countrydeleted=true;
                        } else {
                            $countrydeleted=false;
                            echo " Error en el borrado del país: ". mysqli_error($mysqli);
                        }
                    }
                }
            }
            return  $countrydeleted;
        }


}
?>