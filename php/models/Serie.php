<?php
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
?>