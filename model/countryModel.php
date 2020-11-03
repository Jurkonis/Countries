<?php

class CountryModel extends Dbh{
    public function get($order,$page,$limit){
        $start = ($page-1)*$limit;
        if($order == 'asc'){
            $sql = "SELECT * FROM countries ORDER BY name ASC LIMIT $start, $limit";
        }else if ($order == 'desc'){
            $sql = "SELECT * FROM countries ORDER BY name DESC  LIMIT $start, $limit";
        }else{
            $sql = "SELECT * FROM countries  LIMIT $start, $limit";
        }
        $query = $this->connect()->query($sql);
        return $query;
    }

    public function getIt($id){
        $query = $this->connect()->prepare("SELECT * FROM countries WHERE id=?");
        $query->execute([$id]);
        while($row = $query->fetch()){
            $country = new Country($row['name'],$row['radius'],$row['population'],$row['phoneCode']);
        }
        return $country;
    }

    public function insert($obj){
        $query = $this->connect()->prepare("INSERT INTO countries (name,radius,population,phoneCode) VALUES (?,?,?,?)");
        $query->execute([$obj->getName(),$obj->getRadius(),$obj->getPopulation(),$obj->getPhoneCode()]);
    }

    public function delete($id){
        $query = $this->connect()->prepare("DELETE FROM cities WHERE cityId=?");
        $query->execute([$id]);
        $query = $this->connect()->prepare("DELETE FROM countries WHERE id=?");
        $query->execute([$id]);
    }

    public function update($obj,$id){
        try{
            $query = $this->connect()->prepare("UPDATE countries SET name=?, radius=?, population=?, phoneCode=? WHERE id=?");
            $query->execute([$obj->getName(),$obj->getRadius(),$obj->getPopulation(),$obj->getPhoneCode(),$id]);
            return true;
        }catch (Exception $e){
            throw $e;
        }
    }

    public function nameExists($name){
        $query = $this->connect()->prepare("SELECT COUNT(*) AS num FROM countries WHERE name = ?");
        $query->execute([$name]);
        $row = $query->fetch();
        if($row['num'] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function nameExistsWithId($id,$name){
        $query = $this->connect()->prepare("SELECT COUNT(*) AS num FROM countries WHERE name = ? AND NOT id=?");
        $query->execute([$name,$id]);
        $row = $query->fetch();
        if($row['num'] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function totalRecords(){
        $sql = "SELECT * FROM countries";
        $query = $this->connect()->query($sql);
        return $query->rowCount();
    }

    public function search($search,$order,$page,$limit){
        $start = ($page-1)*$limit;
        if($order == 'asc'){
            $sql = "SELECT * FROM countries WHERE name LIKE '%$search%' ORDER BY name ASC LIMIT $start, $limit";
        }else if ($order == 'desc'){
            $sql = "SELECT * FROM countries WHERE name LIKE '%$search%' ORDER BY name DESC  LIMIT $start, $limit";
        }else{
            $sql = "SELECT * FROM countries WHERE name LIKE '%$search%' LIMIT $start, $limit";
        }
        $query = $this->connect()->query($sql);
        return $query;
    }

    public function totalSearch($search){
        $sql = "SELECT * FROM countries WHERE name LIKE '%$search%'";
        $query = $this->connect()->query($sql);
        return $query->rowCount(); 
    }

    public function filter($startDate,$endDate,$order,$page,$limit){
        $start = ($page-1)*$limit;
        if($order == 'asc'){
            $sql = "SELECT * FROM countries WHERE created BETWEEN '$startDate' AND '$endDate' ORDER BY name ASC LIMIT $start, $limit";
        }else if ($order == 'desc'){
            $sql = "SELECT * FROM countries WHERE created BETWEEN '$startDate' AND '$endDate' ORDER BY name DESC  LIMIT $start, $limit";
        }else{
            $sql = "SELECT * FROM countries WHERE created BETWEEN '$startDate' AND '$endDate' LIMIT $start, $limit";
        }
        $query = $this->connect()->query($sql);
        return $query;
    }

    public function totalFilter($startDate,$endDate){
        $sql = "SELECT * FROM countries WHERE created BETWEEN '$startDate' AND '$endDate'";
        $query = $this->connect()->query($sql);
        return $query->rowCount(); 
    }
}