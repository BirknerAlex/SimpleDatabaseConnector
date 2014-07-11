<?php 

    /**
     * Simple Database Connector
     * using mysqli
     * 
     * @author Alexander Birkner
     * @version 0.1
     * @license GPL
     * @license http://opensource.org/licenses/gpl-license.php GNU Public License
     */
       
    class DatabaseConnector {
        /**
         * @var mysqli
         */
        private $db;
    
        public function __construct(mysqli $db) {
            $this->db = $db;
        }
    
        /**
         * Normal mysqli query
         *
         * @param string $query
         * @return mysqli_result
         */
        public function query($query) {
            return $this->db->query($query);
        }
    
        /**
         * Quotes and escapes the string for the database
         *
         * @param string $string
         * @return string
         */
        public function quote($string) {
            return "'".$this->db->real_escape_string($string)."'";
        }
        
        /**
         * Only escapes the string for the database
         *
         * @param string $string
         * @return string
         */
        public function quote($string) {
            return $this->db->real_escape_string($string);
        }
    
        /**
         * Current time in mysql format
         *
         * @return string
         */
        public function getTime() {
            return date("Y-m-d G:i:s", time());
        }
    
        /**
         * Returns the result as array
         *
         * @param string $query
         * @return array
         */
        public function getAll($query) {
            $result = $this->query($query);
    
            if (!($result instanceof mysqli_result)) {
                throw new Exception("Query invalid.");
            }
    
            $returnArray = array();
            while ($row = $result->fetch_assoc()) {
                $returnArray[] = $row;
            }
    
            return $returnArray;
        }
    
        /**
         * Reads only one value from the database
         *
         * @param string $sql
         * @return mixed
         */
        public function getOne($sql) {
            $query = $this->getAll($sql);
            
            if (count($query) == 0) return null;
            
            foreach ($query[0] as $value) {
                return $value;
            }
        }
        
        /**
         * Reads only the first row from the database
         *
         * @param string $sql
         * @return mixed
         */
        public function getFirst($sql) {
            $query = $this->getAll($sql);
            
            if (count($query) == 0) return null;
            return $query[0];
        }
    }
    
