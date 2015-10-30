<p>Student List</p>

<b style="color: green;"><?php echo isset($_GET['message']) ? $_GET['message'] : ''; ?></b>
<a href='?controller=student&action=add'>Add New</a>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Action</th>
    </tr>

    <?php
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
    <?php } ?>

</table>