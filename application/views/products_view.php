<div class="row p-5">
    <div class="col-2"></div>
    <div class="col-8">
        <h3>This is today's Menu</h3>
    <a href="<?= base_url('Products') ?>" class="btn btn-success">Add Product</a>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) :?>
                    <tr>
                        <td><?php echo $product->prod_id;?></td>
                        <td><?php echo $product->prod_name;?></td>
                        <td><?php echo $product->prod_description;?></td>
                        <td><?php echo $product->prod_price;?></td>
                        <td><?php echo $product->prod_date_created;?></td>
                        <td>
                            <a href="<?= base_url('Products/viewProduct/' .$product->prod_id) ?>" class="btn btn-primary">View Product</a>
                            <a href="<?= base_url('Products/editProduct/'.$product->prod_id) ?>" class="btn btn-secondary">Edit Product</a>
                            <a href="<?= base_url('Products/processDelete/'.$product->prod_id) ?>" class="btn btn-danger">Delete Product</a>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>

        </table>
    <a href="<?= base_url('Home') ?>" class="btn btn-primary">Back</a>
    </div>
</div>

