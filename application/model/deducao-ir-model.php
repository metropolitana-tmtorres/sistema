<?php

class deducaoINSSModel
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

    public function addDeducaoInss(
        $base_calculo,
        $aliquota,
        $deducao_inss,
        $valor_deducao_inss,
        $admID
    ){
        $sql = "INSERT INTO tb_holerite_inss (
                                  id_inss, 
                                  base_calculo, 
                                  aliquota, 
                                  deducao_inss, 
                                  valor_deducao_inss, 
                                  intAdmID)
                              VALUES(
                                  :base_calculo,
                                  :aliquota,
                                  :deducao_inss,
                                  :valor_deducao_inss,
                                  :id
                              )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':base_calculo' => $base_calculo,
            ':aliquota' => $aliquota,
            ':deducao_inss' => $deducao_inss,
            ':valor_deducao_inss' => $valor_deducao_inss,
            ':id' => $admID
        );

        $query->execute($parameters);
        // echo mysqli_error($this->db); exit;
        return true;
    }
}