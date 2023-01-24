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
        $query="SELECT * FROM series";               
        $series= mysqli_query($conn,$query);    
        while($row= mysqli_fetch_assoc($series)){
            $item = new Serie($row['id'], $row['title'], $row['seasons'], $row['episodes'], $row['idplatform'], $row['iddirector']);
            array_push($list_series, $item);
        } 
        CloseConn($conn);
        return $list_series;
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
?>