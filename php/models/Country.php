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


}
?>