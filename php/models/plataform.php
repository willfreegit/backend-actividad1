<?php
    class Platform {
        private $id;
        private $name;

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
    }
?>