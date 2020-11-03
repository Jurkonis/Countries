<?php

class Test extends Dbh{
    public function getCountries(){
        $sql = "SELECT * FROM countries";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()){
            echo $row['name'].'<br>';
        }
    }
}