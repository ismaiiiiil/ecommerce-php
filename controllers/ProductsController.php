<?php
class ProductsController{
    public function getAllProducts(){
        $products = Product::getAll();
        return $products;
    }

    public function getProductsByCategory($id){
        if(isset($id)){
            $data = array(
                'id' => $id
            );
            $products =Product::getProductByCat($data);
            return $products;
        }
    }

    public function getProduct(){
        if(isset($_POST["product_id"])){ // la valeur jaya mn form
            $data = array(
                'id' => $_POST["product_id"]
            );
            $product =Product::getProductById($data);
            return $product;
        }
    }
    public function emptyCart($id,$price,$qte){
        unset($_SESSION["products_".$id]);
        $_SESSION["count"] -= 1;
        $_SESSION["totaux"] -= $price * $qte;
        Redirect::to("cart");
    }
    public function newProduct(){
        if(isset($_POST["submit"])){
            $data = array(
                "product_title" => $_POST["product_title"],
                "product_description" => $_POST["product_description"],
                "product_quantity" => $_POST["product_quantity"],
                "short_desc" => $_POST["short_desc"],
                "product_image" => $this->uploadPhoto(),
                "old_price" => $_POST["old_price"],
                "product_price" => $_POST["product_price"],
                "product_category_id" => $_POST["product_category_id"]
            );
            $result = Product::addProduct($data);
            if($result === "ok"){
                Session::set("success","Produit ajouté");
                Redirect::to("products");
            }else{
                echo $result;
            }
        }
    }
    public function updateProduct(){
        if(isset($_POST["submit"])){
            $oldImage = $_POST["product_current_image"];
            $data = array(
                "product_id" => $_POST["product_id"],
                "product_title" => $_POST["product_title"],
                "product_description" => $_POST["product_description"],
                "product_quantity" => $_POST["product_quantity"],
                "short_desc" => $_POST["short_desc"],
                "product_image" => $this->uploadPhoto($oldImage),
                "old_price" => $_POST["old_price"],
                "product_price" => $_POST["product_price"],
                "product_category_id" => $_POST["product_category_id"]
            );
            $result = Product::editProduct($data);
            if($result === "ok"){
                Session::set("success","Produit modifié");
                Redirect::to("products");
            }else{
                echo $result;
            }
        }
    }
    public function uploadPhoto($oldImage = null){
        $dir = "public/uploads"; // dossier fin timchiw
        $time = time(); // heur
        $name = str_replace(' ','-',strtolower($_FILES["image"]["name"])); // espace => '-'  , name="image" ->"image" 
        $type = $_FILES["image"]["type"]; // png , jpg .. ?
        
        $ext = substr($name,strpos($name,'.')); // mnin i9d3 -> image.jpg -> (.jpg)
        $ext = str_replace('.','',$ext);  // (.jpg) => (jpg)
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
        $imageName = $name. '-' .$time. '.' .$ext; // le nom finale image
        if(move_uploaded_file($_FILES["image"]["tmp_name"],$dir."/".$imageName)){ // shemain/public/uploads/image-time.png
            return $imageName;
        } //ila mabdlch image tanjibo image l9dima
        return $oldImage;
    }

    public function removeProduct(){
        if(isset($_POST["delete_product_id"])){
            $data = array(
                "id" => $_POST["delete_product_id"]
            );
            $result = Product::deleteProduct($data);
            if($result === "ok"){
                Session::set("success","Produit supprimé");
                Redirect::to("products");
            }else{
                echo $result;
            }
        }
    }
}