<?php
class Country
{
	private $num_code;
	private $alpha_3_code;
	private $en_short_name;
	private $nationality;

	public function __construct($num_code=null,$en_short_name=null,$alpha_3_code=null,$nationality=null)
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


        function saveCountry()
        {
            $countrycreated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->en_short_name;
            if($var === null) {echo "Error en insert del país: El nombre del país esta vacio";  $countrycreated=false;}
            $var=$this->alpha_3_code;
            if($var === null) {echo "Error en insert del país: El código Alpha del país esta vacio";  $countrycreated=false;}
            $var=$this->nationality;
            if($var === null) {echo "Error en insert del país: La nacionalidad esta vacio";  $countrycreated=false;}


            if (!$countrycreated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from countries where en_short_name='".$this->en_short_name."' and alpha_3_code='".$this->alpha_3_code."' and alpha_3_code='".$this->nationality."'";
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


                    $query= "select * from countries where alpha_3_code='".$this->alpha_3_code."'";
                   // echo " select: ". $query;
                    
                     $countries= mysqli_query($mysqli,$query);   
                     $rowcount=mysqli_num_rows($countries);
                    // echo $rowcount;
                     if ($rowcount>0)
                         {
                             $countrycreated=false;
                             $mysqli ->close( ) ;
                             echo " Error esta duplicado el alpha code del país y no se puede insertar";
                         }
         
                         else {

                    $query= "INSERT INTO countries(en_short_name, alpha_3_code, nationality) VALUES('$this->en_short_name','$this->alpha_3_code', '$this->nationality')";
                    
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
            }
            return  $countrycreated;
        }

        function updateCountry()
        {
            $countryupdated=true;
    
            $mysqli = (new CconexionDB)->initConnectionDb();

            //TO DO revisar que los parametros a grabar no sean nulos

            $var=$this->id;
            if($var === null) {echo "Error en insert del país: El id del país esta vacio";  $countryupdated=false;}
            $var=$this->en_short_name;
            if($var === null) {echo "Error en insert del país: El nombre del país esta vacio";  $countryupdated=false;}
            $var=$this->alpha_3_code;
            if($var === null) {echo "Error en insert del país: El código ISO del país esta vacio";  $countryupdated=false;}

            if (!$countryupdated)
            {
                $mysqli ->close( );
            }
            else 
            {
           /*Se realiza una comprobacion para ver si no existen datos iguales antes de grabarlos*/

            $query= "select * from countries where en_short_name='".$this->en_short_name."' and alpha_3_code='".$this->alpha_3_code."' and id<>".$this->id;
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
                    $query= "UPDATE countries set en_short_name='".$this->en_short_name."', alpha_3_code='".$this->alpha_3_code."' where id=".$this->id;
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
        
           
            $query="SELECT id, en_short_name,alpha_3_code FROM countries where id=".$this->id;               
        
            $countries= mysqli_query($mysqli,$query);   
            
            foreach ($countries as $item)
            {  $itemObject =new Country($item['id'], $item['en_short_name'], $item['alpha_3_code']);
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