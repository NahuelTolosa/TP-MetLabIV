<?php
    namespace Models;

    class JobOffer
    {
        private $idCompany;
        private $creationDate;
        private $description;
        private $salary;
        private $active;

        /**
         * Get the value of idCompany
         */ 
        public function getIdCompany()
        {
                return $this->idCompany;
        }

        /**
         * Set the value of idCompany
         *
         * @return  self
         */ 
        public function setIdCompany($idCompany)
        {
                $this->idCompany = $idCompany;

                return $this;
        }

        /**
         * Get the value of creationDate
         */ 
        public function getCreationDate()
        {
                return $this->creationDate;
        }

        /**
         * Set the value of creationDate
         *
         * @return  self
         */ 
        public function setCreationDate($creationDate)
        {
                $this->creationDate = $creationDate;

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
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

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
         *
         * @return  self
         */ 
        public function setSalary($salary)
        {
                $this->salary = $salary;

                return $this;
        }


        /**
         * Get the value of active
         */
        public function isActive()
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
    }
    

?>