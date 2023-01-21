<?php
    class Serie {
        private $id;
        private $title;
        private $seasons;
        private $episodes;
        private $idplatform;
        private $iddirector;

        public function __construct($id, $title){
            $this->id = $id;
            $this->title = $title;
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
    }
?>