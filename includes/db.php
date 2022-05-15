<?php
    class sql
    {
        private $connexion_bdd;
        
        function __construct()
        {
            $this->connexion_bdd = new PDO('mysql:host=81.88.53.15;dbname=p14vysbd_Ventes;port=3306','p14vysbd_Alex','Rf17bpe7');
            $this->connexion_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        public function requete($requete)
        {
            $prepare = $this->connexion_bdd->prepare($requete);
            
            return $prepare;
        }

        public function getLastInsertId() {
            return $this->connexion_bdd->lastInsertId();
        }
    }
?>