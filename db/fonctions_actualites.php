<?php
class Actualites
{
    // private database object\
    private $db;

    //constructor to initialize private variable to the database connection
    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertACTU(
        $titreActu,
        $imgActu,
        $descActu,
        $dateActu,
        $villeActu
    )
    {
        try
        {
            // define sql statement to be executed
            $sql = "INSERT INTO `actu`(`TITREACTU`,`IMGACTU`,`DESCACTU`, `DATEACTU`,`VILLEACTU`) VALUES (:titreActu, :imgActu, :descActu, :dateActu, :villeActu)";
            //prepare the sql statement for execution
            $stmt = $this->db->prepare($sql);
            // bind all placeholders to the actual values
            $stmt->bindparam(':titreActu', $titreActu);
            $stmt->bindparam(':imgActu', $imgActu);
            $stmt->bindparam(':descActu', $descActu);
            $stmt->bindparam(':dateActu', $dateActu);
            $stmt->bindparam(':villeActu', $villeActu);
            
            // execute statement
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    

    public function editActu($param)
    {

        try {
            $sql = "UPDATE `actu` SET
            titreActu     =?,
            imgActu          =?,
            descActu      =?,
            dateActu      =?, 
            villeActu        =?,            
            WHERE 
            NOACTU           =?";
            $stmt = $this->db->prepare($sql);
            /*$stmt->bindparam(':titreActu', $titreActu);
         $stmt->bindparam(':imgActu', $imgActu);
         $stmt->bindparam(':descActu', $descActu);
         $stmt->bindparam(':dateActu', $dateActu);
         $stmt->bindparam(':villeActu', $villeActu);*/
            // execute statement
            $stmt->execute($param);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return  false;
        }
    }

    public function deleteActu($id)
{
    try {
        // Récupérer le chemin de l'image à partir de la base de données
        $sql = "SELECT IMGACTU FROM `actu` WHERE NOACTU=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $imagePath = $stmt->fetchColumn();

        // Supprimer l'entrée dans la base de données
        $sql = "DELETE FROM `actu` WHERE NOACTU=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer l'image du dossier "images/actualites"
        if (file_exists($imagePath)) {
            // Supprimer l'image du dossier "images/actualites"
            unlink($imagePath);
        } 

        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

    public function getAllACTU()
    {
        try {
            $sql = "SELECT *, DATE_FORMAT(DATEACTU, '%d/%m/%Y') AS formatted_date FROM `actu` ORDER BY DATEACTU DESC";
            $result = $this->db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getActuById($id) 
    {
        try
        {
            $sql="SELECT `NOACTU`,`TITREACTU`,`IMGACTU`,`DESCACTU`,`DATEACTU`,`VILLEACTU`,`	LIENACTU`FROM `actu` WHERE NOACTU=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}


?>
