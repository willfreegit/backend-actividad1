<?php
    include "../../../php/db/connection_db.php";
    class Serie {
        private $id;
        private $title;
        private $seasons;
        private $episodes;
        private $idplatform;
        private $iddirector;

        public function __construct($id, $title, $seasons, $episodes, $idplatform, $iddirector){
            $this->id = $id;
            $this->title = $title;
            $this->seasons = $seasons;
            $this->episodes = $episodes;
            $this->idplatform = $idplatform;
            $this->iddirector = $iddirector;
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
         * @return title
         */
        public function getTitle(){
            return $this->title;
        }

        public function setTitle($title){
            $this->title=$title;
        }

        /**
         * @return seasons
         */
        public function getSeasons(){
            return $this->seasons;
        }

        public function setSeasons($seasons){
            $this->seasons=$seasons;
        }

        /**
         * @return episodes
         */
        public function getEpisodes(){
            return $this->episodes;
        }

        public function setEpisodes($episodes){
            $this->episodes=$episodes;
        }

        /**
         * @return idplatform
         */
        public function getIdplatform(){
            return $this->idplatform;
        }

        public function setIdplatform($idplatform){
            $this->idplatform=$idplatform;
        }

        /**
         * @return iddirector
         */
        public function getIddirector(){
            return $this->iddirector;
        }

        public function setIddirector($iddirector){
            $this->iddirector=$iddirector;
        }
    }

    function getSeries_model(){
        $conn = OpenConn();    
        $list_series = [];
        $query="SELECT * FROM series order by id";               
        $series= mysqli_query($conn,$query);    
        while($row= mysqli_fetch_assoc($series)){
            $item = new Serie($row['id'], $row['title'], $row['seasons'], $row['episodes'], $row['idplatform'], $row['iddirector']);
            array_push($list_series, $item);
        } 
        CloseConn($conn);
        return $list_series;
    }

    function getActoresSerie_model($idserie){
        $conn = OpenConn();    
        $list_actores = [];
        $query="SELECT * FROM actors where id in (select idactor from series_cast where idserie = $idserie)";               
        $series= mysqli_query($conn,$query);    
        while($row= mysqli_fetch_assoc($series)){
            $item = new Actor($row['id'], $row['firstname'], $row['lastname'], $row['DOB']);
            array_push($list_actores, $item);
        } 
        CloseConn($conn);
        return $list_actores;
    }

    function getActoresSerie_plane($idserie){
        $conn = OpenConn();    
        $actores = '';
        $query="SELECT * FROM actors where id in (select idactor from series_cast where idserie = $idserie)";               
        $series= mysqli_query($conn,$query);    
        $contador=0;
        while($row= mysqli_fetch_assoc($series)){
            if ($contador>0)
            {   
                $actores = $actores.', '.$row['firstname'].' '.$row['lastname'];
            }
                
            else
                {
                    $actores = $row['firstname'].' '.$row['lastname'];
                    $contador=1;
                }
          
        } 
        CloseConn($conn);
        return $actores;
    }

    function getLanguageById($idserie){
        $conn = OpenConn();    
        $languages = '';
        $query="SELECT language_name FROM languages where id in (select idlanguage from series_audio_languages where idserie = $idserie)";               
        $series= mysqli_query($conn,$query);    
        $contador=0;
        while($row= mysqli_fetch_assoc($series)){
            if ($contador>0)
            {   
                $languages = $languages.', '.$row['language_name'];
            }
                
            else
                {
                    $languages = $row['language_name'];
                    $contador=1;
                }
        } 
        CloseConn($conn);
        return $languages;
       }

       function getSubtitleById($idserie){
        $conn = OpenConn();    
        $languages = '';
        $query="SELECT language_name FROM languages where id in (select idlanguage from series_subtitles where idserie = $idserie)";               
        $series= mysqli_query($conn,$query);    
        $contador=0;
        while($row= mysqli_fetch_assoc($series)){
            if ($contador>0)
            {   
                $languages = $languages.', '.$row['language_name'];
            }
                
            else
                {
                    $languages = $row['language_name'];
                    $contador=1;
                }
        } 
        CloseConn($conn);
        return $languages;
       }


    function saveSerie_model($title, $seasons, $episodes, $idplatform, $iddirector){
        $id = -1;
        $conn = OpenConn();
        $query= "INSERT INTO series(title, seasons, episodes, idplatform, iddirector) VALUES('{$title}','{$seasons}','{$episodes}','{$idplatform}','{$iddirector}')";
        $add_serie = mysqli_query($conn,$query);
        if ($add_serie) {
            $id = mysqli_insert_id($conn);
        } else {
            echo "A ocurrido un error al crear la serie en el modelo ";
        }
        CloseConn($conn); 
        return $id;
       }

       function saveSeriesCast_model($idactor, $idserie, $role){
        $conn = OpenConn();
        $query= "INSERT INTO series_cast(idactor, idserie, role) VALUES('{$idactor}','{$idserie}','{$role}')";
        $add_serie = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_serie) {
            echo "A ocurrido un error al crear seriescast ";
        } 
       }

       function saveSeriesLanguaje_model($idlanguage, $idserie){
        $conn = OpenConn();
        $query= "INSERT INTO series_audio_languages(idlanguage, idserie) VALUES('{$idlanguage}','{$idserie}')";
        $add_languages = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_languages) {
            echo "A ocurrido un error al crear series lenguajes ";
        } 
       }

       function saveSeriesSubtitle_model($idlanguage, $idserie){
        $conn = OpenConn();
        $query= "INSERT INTO series_subtitles(idlanguage, idserie) VALUES('{$idlanguage}','{$idserie}')";
        $add_languages = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_languages) {
            echo "A ocurrido un error al crear series subtitulos ";
        } 
       }


       function deleteSeriesCast_model($idactor, $idserie){
        $conn = OpenConn();
        $query= "DELETE FROM series_cast WHERE idserie = $idserie and idactor = $idactor ";
        $add_serie = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_serie) {
            echo "A ocurrido un error al borrar seriescast ";
        } 
       }

       function updateSerie_model($id, $title, $seasons, $episodes){
        $conn = OpenConn();
        $query = "UPDATE series SET title = '{$title}', seasons = '{$seasons}', episodes = '{$episodes}' WHERE id = $id";
        $update = mysqli_query($conn, $query);
        CloseConn($conn);
       }

       function getSerieById_model($id){
        $conn = OpenConn();
        $serie = (object)[];
        $query="SELECT * FROM series WHERE id = $id ";
        $series = mysqli_query($conn,$query);
        while($row= mysqli_fetch_assoc($series)){
            $serie = new Serie($row['id'], $row['title'], $row['seasons'], $row['episodes'], $row['idplatform'], $row['iddirector']);
        } 
        CloseConn($conn);
        return $serie;
       }

       function deleteSerie_model($id){
        $conn = OpenConn();
        $query = "DELETE FROM series WHERE id = {$id}"; 
        $delete_query= mysqli_query($conn, $query);
        CloseConn($conn);
       }

       function deleteSeriesCast($id){
        $conn = OpenConn();
        $query= "DELETE FROM series_cast WHERE idserie = $id";
        $add_serie = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_serie) {
            echo "A ocurrido un error al borrar seriescast ";
        } 
       }

       function deleteSeriesLanguage($id){
        $conn = OpenConn();
        $query= "DELETE FROM series_audio_languages WHERE idserie = $id";
        $add_serie = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_serie) {
            echo "A ocurrido un error al borrar seriescast ";
        } 
       }
       
       function deleteSeriesSubtitles($id){
        $conn = OpenConn();
        $query= "DELETE FROM series_subtitles WHERE idserie = $id";
        $add_serie = mysqli_query($conn,$query);
        CloseConn($conn);
        if (!$add_serie) {
            echo "A ocurrido un error al borrar seriescast ";
        } 
       }


?>