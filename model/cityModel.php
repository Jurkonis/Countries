<?php

class CityModel extends Dbh{
    public function get($id,$order,$page,$limit){
        $start = ($page-1)*$limit;
        if($order == 'asc'){
            $sql = "SELECT * FROM cities where countryId=? ORDER BY name ASC LIMIT $start, $limit";
        }else if ($order == 'desc'){
            $sql = "SELECT * FROM cities where countryId=? ORDER BY name DESC LIMIT $start, $limit";
        }else{
            $sql = "SELECT * FROM cities where countryId=? LIMIT $start, $limit";
        }
        $query = $this->connect()->prepare($sql);
        $query->execute([$id]);
        return $query;
    }

    public function getIt($id){
        $query = $this->connect()->prepare("SELECT * FROM cities WHERE id=?");
        $query->execute([$id]);
        while($row = $query->fetch()){
            $city = new City($row['name'],$row['radius'],$row['population'],$row['postalCode']);
        }
        return $city;
    }

    public function insert($obj,$id){
      
        $query = $this->connect()->prepare("INSERT INTO cities (name,radius,population,postalCode,countryId) VALUES (?,?,?,?,?)");
        $query->execute([$obj->getName(),$obj->getRadius(),$obj->getPopulation(),$obj->getPostalCode(),$id]);
    }

    public function delete($id){
        $query = $this->connect()->prepare("DELETE FROM cities WHERE id=?");
        $query->execute([$id]);
    }

    public function update($obj,$id){
        try{
            $query = $this->connect()->prepare("UPDATE cities SET name=?, radius=?, population=?, postalCode=? WHERE id=?");
            $query->execute([$obj->getName(),$obj->getRadius(),$obj->getPopulation(),$obj->getPostalCode(),$id]);
            return true;
        }catch (Exception $e){
            throw $e;
        }
    }

    public function nameExists($name,$cId){
        $query = $this->connect()->prepare("SELECT COUNT(*) AS num FROM cities WHERE name = ? AND countryId=?");
        $query->execute([$name,$cId]);
        $row = $query->fetch();
        if($row['num'] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function nameExistsWithId($id,$name,$cId){
        $query = $this->connect()->prepare("SELECT COUNT(*) AS num FROM cities WHERE name = ? AND countryId=? AND NOT id=?");
        $query->execute([$name,$cId,$id]);
        $row = $query->fetch();
        if($row['num'] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function totalRecords($id){
        $sql = "SELECT * FROM cities where countryId=?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id]);
        return $query->rowCount();
    }

    public function search($id,$search,$order,$page,$limit){
        $start = ($page-1)*$limit;
        if($order == 'asc'){
            $sql = "SELECT * FROM cities where countryId=? AND name LIKE '%$search%' ORDER BY name ASC LIMIT $start, $limit";
        }else if ($order == 'desc'){
            $sql = "SELECT * FROM cities where countryId=? AND name LIKE '%$search%' ORDER BY name DESC LIMIT $start, $limit";
        }else{
            $sql = "SELECT * FROM cities where countryId=? AND name LIKE '%$search%' LIMIT $start, $limit";
        }
        $query = $this->connect()->prepare($sql);
        $query->execute([$id]);
        return $query;
    }

    public function totalSearch($id,$search){
        $sql = "SELECT * FROM cities WHERE countryId=$id AND name LIKE '%$search%'";
        $query = $this->connect()->query($sql);
        return $query->rowCount();
        
    }

    public function filter($id,$startDate,$endDate,$order,$page,$limit){
        $start = ($page-1)*$limit;
        if($order == 'asc'){
            $sql = "SELECT * FROM cities WHERE countryId=$id AND created BETWEEN '$startDate' AND '$endDate' ORDER BY name ASC LIMIT $start, $limit";
        }else if ($order == 'desc'){
            $sql = "SELECT * FROM cities WHERE countryId=$id AND created BETWEEN '$startDate' AND '$endDate' ORDER BY name DESC  LIMIT $start, $limit";
        }else{
            $sql = "SELECT * FROM cities WHERE countryId=$id AND created BETWEEN '$startDate' AND '$endDate' LIMIT $start, $limit";
        }
        $query = $this->connect()->query($sql);
        return $query;
    }

    public function totalFilter($id,$startDate,$endDate){
        $sql = "SELECT * FROM cities WHERE countryId=$id AND created BETWEEN '$startDate' AND '$endDate'";
        $query = $this->connect()->query($sql);
        return $query->rowCount(); 
    }
}