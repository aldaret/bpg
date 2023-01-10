<?php
class Database
{
    private ?mysqli $connection;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
            if (mysqli_connect_errno()) {
                throw new \Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function select($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();

            return $result;
        } catch(Exception $e) {
            throw New \Exception( $e->getMessage() );
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function selectOne($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch(Exception $e) {
            throw New \Exception( $e->getMessage() );
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function insert($query = "" , $params = []): int|string
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $this->connection->insert_id;
            $stmt->close();
            
            return $result;
        } catch(Exception $e) {
            throw New \Exception( $e->getMessage() );
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function update($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = array_pop($params);
            $stmt->close();
            
            return $result;
        } catch(Exception $e) {
            throw New \Exception( $e->getMessage() );
        }
        return false;
    }

    /**
     * @throws Exception
     */
    private function executeStatement($query = "" , $params = []): mysqli_stmt
    {
        try {
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New \Exception("Unable to do prepared statement: " . $query);
            }

            if( $params ) {
                $types = '';
                foreach($params as $param){
                    $type = gettype($param);
                    if(is_int($type) || is_string($type)){
                        $types .= mb_substr($type, 0, 1);
                    }else{
                        throw New \Exception("Type of params not valid.");
                    }
                }
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();

            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }
}