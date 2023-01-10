<?php
class PhonesModel extends Database
{
    private string $table_name;
    
    public function __construct()
    {
        $this->table_name = 'bpg_phones';
        parent::__construct();
    }
    
    public function getPhones()
    {
        $params = [];
        $query = "SELECT * FROM `$this->table_name`";
        
        return $this->select($query, $params);
    }
    
    public function getPhoneById($intPhoneId)
    {
        $params = [$intPhoneId];
        $query = "SELECT * FROM $this->table_name WHERE `id` = ?";
        
        return $this->selectOne($query, $params);
    }

    public function getPhoneInfoByPhone($phoneNumber)
    {
        $params = [$phoneNumber];
        $query = "SELECT * FROM $this->table_name WHERE `phone` = ?";

        return $this->selectOne($query, $params);
    }

    public function getPhoneByNumber(string $phone)
    {
        $params = [$phone];
        $query = "SELECT * FROM $this->table_name WHERE `phone` = ?";

        return $this->selectOne($query, $params);
    }

    public function getPhonesByNumber(string $phone)
    {
        $search = '+' . ltrim($phone, '+');
        $query = "SELECT * FROM $this->table_name WHERE `phone` LIKE '{$search}%' ORDER BY `phone`";

        return $this->select($query);
    }
    
    public function setPhone($params): int|string
    {
        $params = array_values($params);

        if (null === $this->getPhoneByNumber($params[0])) {
            array_push($params, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));

            $query = "INSERT INTO $this->table_name
                    (
                        `phone`,
                        `country_code`,
                        `country_name`,
                        `insertedOn`,
                        `updatedOn`
                    ) VALUES (
                        ?, ?, ?, ?, ?
                    )";

            return $this->insert($query, $params);
        }
        return false;
    }
    
    public function editPhoneById($intPhoneId, $params)
    {

        $params = array_values($params);
        array_push($params, date("Y-m-d H:i:s"), $intPhoneId);

        $query = "UPDATE $this->table_name SET 
                    `phone` = ?,
                    `country_code` = ?,
                    `timezone_name` = ?,
                    `updatedOn` = ?
                    WHERE `id` = ?";
        
        return $this->update($query, $params);
    }
    
    public function deletePhoneById($intPhoneId)
    {

        $params = [$intPhoneId];
        $query = "DELETE FROM $this->table_name WHERE `id` = ?";
        
        return $this->update($query, $params);
    }
}

?>