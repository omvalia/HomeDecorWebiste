<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5">
    <thead class="update_view_barnd">
        <tr class="text-center">
            <th>Serial No.</th>
            <th>Brand Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <?php
        $select_brand="select * from `brand`";
        $result=mysqli_query($con,$select_brand);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $brand_id=$row['brand_id'];
            $brand_name=$row['brand_name'];
            $number++;
    ?>
        <tr class="text-center">
            <td><?php echo $number; ?></td>
            <td><?php echo $brand_name; ?></td>
            <td><a href='index.php?edit_brand=<?php echo $brand_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_brand=<?php echo $brand_id ?>' type="button" class="text-light"><i class='fa-solid fa-trash'></i></a></td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>