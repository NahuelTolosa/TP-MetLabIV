<?php
    namespace Models;

    class JobOffer
    {
        private $tittle;
        private $idCompany;
        private $date;
        private $description;
        private $salary;
        private $time;
        private $active;
        private $postulations= array();

        public function __construct()
        {
                $this->active=true;
                $this->date=date("d-m-Y");
        }

        /**
         * Get the value of postulations
         */
        public function getPostulations()
        {
                return $this->postulations;
        }

        /**
         * Set the value of postulations
         */
        public function setPostulations($postulations): self
        {
                $this->postulations = $postulations;

                return $this;
        }

        /**
         * Get the value of active
         */
        public function getActive()
        {
                return $this->active;
        }

        /**
         * Set the value of active
         */
        public function setActive($active): self
        {
                $this->active = $active;

                return $this;
        }

        /**
         * Get the value of time
         */
        public function getTime()
        {
                return $this->time;
        }

        /**
         * Set the value of time
         */
        public function setTime($time): self
        {
                $this->time = $time;

                return $this;
        }

        /**
         * Get the value of salary
         */
        public function getSalary()
        {
                return $this->salary;
        }

        /**
         * Set the value of salary
         */
        public function setSalary($salary): self
        {
                $this->salary = $salary;

                return $this;
        }

        /**
         * Get the value of date
         */
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         */
        public function setDate($date): self
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of idCompany
         */
        public function getIdCompany()
        {
                return $this->idCompany;
        }

        /**
         * Set the value of idCompany
         */
        public function setIdCompany($idCompany): self
        {
                $this->idCompany = $idCompany;

                return $this;
        }

        /**
         * Get the value of description
         */
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         */
        public function setDescription($description): self
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of tittle
         */
        public function getTittle()
        {
                return $this->tittle;
        }

        /**
         * Set the value of tittle
         */
        public function setTittle($tittle): self
        {
                $this->tittle = $tittle;

                return $this;
        }
    }

?>