<?php
abstract class DataBaseOperetor
{
    protected $db;

    public function __construct($host = "den1.mysql6.gear.host", $username = "users4", $password = "Qg77M2H~8l_3", $databasename = "users4")
    {
        $this->db = new mysqli($host, $username, $password, $databasename);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // mysqli query multi function treatment.
    protected function queryTreatment($query)
    {
        $queryResult = $this->db->query($query);
        $typeOfResult = gettype($queryResult);

        if ($typeOfResult == "boolean") {
            return $queryResult;
        } else {
            $returnArray = [];
            while ($row = $queryResult->fetch_assoc()) {
                array_push($returnArray, $row);
            }
            return $returnArray;
        }
    }

    //querys constructors for general use.
    protected function describeTable($table_name)
    {
        $field_names = [];
        $describeArray = $this->queryTreatment("DESCRIBE usersdetails");
        foreach ($describeArray as $value) {
            array_push($field_names, $value['Field']);
        }
        //removes id field from $field_names.
        array_splice($field_names, 0, 1);
        return $field_names;
    }

    protected function select($table_name, $columns = '*', $condition = 1)
    {
        return $this->queryTreatment("SELECT $columns FROM $table_name WHERE $condition");
    }

    protected function singleInsert($table_name, $column, $value)
    {
        return $this->queryTreatment("INSERT INTO $table_name ($column) VALUES ('$value')");
    }

    protected function multiInsert($table_name, array $columns, array $values)
    {
        $columns_to_insert = implode(",", $columns);
        $values_to_insert = implode("','", $values);
        return $this->queryTreatment("INSERT INTO $table_name ($columns_to_insert) VALUES ('$values_to_insert')");
    }

    protected function singleUpdate($table_name, $column, $value, $condition)
    {
        return $this->queryTreatment("UPDATE $table_name SET $column='$value' WHERE $condition");
    }

    protected function multiUpdate($table_name, array $columns, array $values, $condition)
    {
        $combined_array = array_combine($columns, $values);
        array_pop($combined_array);
        foreach ($combined_array as $key => $value) {
            $combined_array[$key] = $key . "='" . $value . "'";
        }
        $string_to_set = implode(",", $combined_array);

        return $this->queryTreatment("UPDATE $table_name SET $string_to_set WHERE $condition");
    }

    protected function delete($table_name, $condition)
    {
        return $this->queryTreatment("DELETE FROM $table_name WHERE $condition");
    }

    protected function truncate($table_name)
    {
        return $this->queryTreatment("TRUNCATE $table_name");
    }
}
