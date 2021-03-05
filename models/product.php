<?php
namespace Models;
require_once('.././databases/connection.php');

use PDO;
use PDOException;
use Databases\Connection;


class Product extends Connection{

    public static $table = "products";
    private $name, $price, $stock;

    public function __construct($name="",$price=0.0,$stock=0) {

        parent::__construct();

        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function createProduct(){
        header('Content-Type: application/json');
        try{
            $sql = "INSERT INTO " .self::$table." (pname,pprice,pstocks) VALUES(:name,:price,:stock)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':name',$this->name, PDO::PARAM_STR);
            $stmt->bindValue(':price',$this->price);
            $stmt->bindValue(':stock',$this->stock,PDO::PARAM_INT);
            $stmt->execute();//commit
            
            echo json_encode(array('response' => 'Product has been created successfully',"status"=>"Ok"));
           

        }catch(PDOException $e){
            
            echo json_encode(array('response' => 'Similar Product Name found',"status"=>"Error"));
        
        }
        exit;
    }

    public function all(){
        try{
            $stmt = $this->conn->prepare("select * from ".self::$table." order by pid desc limit 5");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);//product["pid]   
        }catch(PDOException $e){
            return NULL;
        }
    }

    public function findById($id){
        try{
            $stmt = $this->conn->prepare("select * from ".self::$table."
                where pid=:id");
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);//product["pid]   
        }catch(PDOException $e){
            return NULL;
        }
    }
    
    public function findByName($name){
        try{
            $stmt = $this->conn->prepare("select * from ".self::$table.
            " where pname LIKE  :name  order by pname");
            $stmt->bindValue(':name',"%$name%", PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);//product["pid]   
        }catch(PDOException $e){
            return NULL;
        }
    }

    public function updateProduct($id){
        header('Content-Type: application/json');
        try{
            $pstmt = $this->conn->prepare("UPDATE products SET pname=:name,pprice=:price,
            pstocks=:stock WHERE pid=:id");
            $pstmt->bindValue(':name',$this->name);
            $pstmt->bindValue(':price',$this->price);
            $pstmt->bindValue(':stock',$this->stock);
            $pstmt->bindValue(':id', $id);
            $pstmt->execute();
            echo json_encode(array('response' => "Product $id has been updated successfully","status"=>"Ok"));
        }catch(PDOException $e){
            echo json_encode(array('response' => 'Unable to update product details',"status"=>"Error"));
        }
    }

    public function deleteProduct($id){
        try{
            $pstmt = $this->conn->prepare("DELETE FROM ".self::$table."  WHERE pid=:id");
            $pstmt->bindValue(':id', $id);
            $pstmt->execute();
            echo "Successfully deleted!";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}

