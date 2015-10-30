<p>Student List</p>

<b style="color: green;"><?php echo isset($_GET['message']) ? $_GET['message'] : ''; ?></b>
<a href='?controller=student&action=add'>Add New</a>
<br>
Search By
<form action="index.php" method="post">
<select name="searchby">
    <option value="" >---Select---</option>
    <option value="name" <?php echo (isset($_POST['searchby']) && $_POST['searchby'] === 'name' ) ? 'selected=selected':'';?>>Name</option>
    <option value="email" <?php echo (isset($_POST['searchby']) && $_POST['searchby'] === 'email' ) ? 'selected=selected':'';?>>Email</option>
    <option value="mobile" <?php echo (isset($_POST['searchby']) && $_POST['searchby'] === 'mobile' ) ? 'selected=selected':'';?>>Mobile</option>
</select>
Search Value    
<input type="text" name="searchval" value="<?php echo isset($_POST['searchval']) ? $_POST['searchval'] : ''; ?>">
<input type="submit" name="search">
</form>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Action</th>
    </tr>

    <?php
    if(sizeof($asResult) > 0):
    foreach ($asResult as $asValue)
    {
        ?>
        <tr>
            <td><?php echo $asValue['name']; ?></td>
            <td><?php echo $asValue['email']; ?></td>
            <td><?php echo $asValue['mobile']; ?></td>
            <td><?php echo $asValue['address']; ?></td>
            <td>
                <a href='?controller=student&action=edit&id=<?php echo $asValue['id']; ?>'>Edit</a>
                <a href='?controller=student&action=delete&id=<?php echo $asValue['id']; ?>'>Delete</a>
            </td>


            </td>
        </tr>   
    <?php }
    else:
    ?>
        <tr><td colspan="5">No Records found!</td></tr>
    <?php endif;?>    
</table>