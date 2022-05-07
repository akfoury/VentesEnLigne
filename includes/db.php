<?php
    class sql
    {
        private $connexion_sql;
        
        function __construct()
        {
            $this->connexion_bdd = new PDO('sqlsrv:Server=localhost\SQLEXPRESS;Database=Ventes', 'alex', 'toto');
            $this->connexion_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        public function requete($requete)
        {
            $prepare = $this->connexion_bdd->prepare($requete);
            
            return $prepare;
        }
    }
?>