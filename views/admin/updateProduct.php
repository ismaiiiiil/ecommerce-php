
<?php
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true ) {
        $categories = new CategoriesController();
        $categories = $categories->getAllCategories();
        $productToUpdate = new ProductsController();
        $productToUpdate = $productToUpdate->getProduct();
        if(isset($_POST["submit"])){
            $product = new ProductsController();
            $product->updateProduct();
        }
    }else{
        Redirect::to("home");
    }
?>


<div class="container">
    <div class="row my-4">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body bg-light">
                    <a href="<?php echo BASE_URL;?>" class="btn btn-sm btn-secondary mr-2 mb-2">
                        <i class="fas fa-home"></i>
                    </a>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="card-header">Ajouter un produit</div>

                        <div class="form-group">
                            <label for="product_title">Titre*</label>
                            <input type="text" name="product_title" class="form-control" placeholder="Titre" value="<?php echo $productToUpdate->product_title;?>">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Description*</label>
                            <textarea name="product_description" id="product_description" placeholder="Description" class="form-control"  autocomplete="off" cols="20" rows="5"
                            ><?php echo $productToUpdate->product_description;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="short_desc">Description Courte*</label>
                            <textarea name="short_desc" id="short_desc" placeholder="Description Courte" class="form-control"  autocomplete="off" cols="20" rows="5"
                            >
                                <?php echo $productToUpdate->short_desc;?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_category_id">Catégories*</label>
                            <select class="form-control"  name="product_category_id" id="product_category_id">
                                <?php foreach($categories as $category) : ?>
                                    <option 
                                    <?php echo $productToUpdate->product_category_id === $category["cat_id"] ? "selected" : "" //ila kan catProduit == dik li maffichia?> 
                                    value="<?php echo $category["cat_id"];?>">
                                        <?php echo $category["cat_title"];?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Prix*</label>
                            <input type="number" autocomplete="off" name="product_price" id="product_price" class="form-control" placeholder="Prix"
                            value="<?php echo $productToUpdate->product_price;?>">
                        </div>


                        <!-- hidden -->
                        <input type="hidden"  name="product_id" 
                            value="<?php echo $productToUpdate->product_id;?>">
                            <!-- ila ma3tanach image -->
                        <input type="hidden"  name="product_current_image" 
                            value="<?php echo $productToUpdate->product_image;?>">


                        <div class="form-group">
                            <label for="old_price">Ancien Prix*</label>
                            <input type="number" autocomplete="off" name="old_price" id="old_price" class="form-control" placeholder="Ancien Prix"
                            value="<?php echo $productToUpdate->old_price;?>">
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Quantité*</label>
                            <input type="number" name="product_quantity" id="product_quantity" class="form-control" placeholder="Quantité"
                            value="<?php echo $productToUpdate->product_quantity;?>">
                        </div>
                        <div class="form-group">
                            <img 
                            width="400" height="400"
                            src="./public/uploads/<?php echo $productToUpdate->product_image;?>" 
                            alt="" class="img-fluide rounded">
                        </div>
                        <div class="form-group">
                            <label for="image">Image*</label>
                            <input type="file" name="image" id="image" class="form-control"
                            >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="submit">
                                Valider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>