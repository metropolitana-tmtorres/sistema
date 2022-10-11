<?php

class coreModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function registerLog($user,$action) {
        $sql = "INSERT INTO tb_logs (intAdmID, strLogAction) VALUES (:user, :logAction)";
        $query = $this->db->prepare($sql);
        $parameters = array(':user' => $user, ':logAction' => $action);
        $query->execute($parameters);

        return true;
    }

    public function checkAccess($id) {
        $sql = "SELECT strCargoAccess FROM tb_cargo WHERE intCargoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        // echo mysqli_error($conn); exit;

        return $query->fetch();
    }
    
}
