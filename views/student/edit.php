<div class="container">
    <div class="container">
        <h3>Edit Data</h3>
        <ul style="color:red;">
            <?php
            foreach ($asErrorMessage as $ssKey => $ssEror)
            {
                ?>
                <li><?php echo $ssEror; ?></li>
                <?php
            }
            ?>
        </ul> 
        <?php
        $ssUrl = "?controller=student&action=edit&id=" . $_GET['id'];
        ?>
        <form action="<?php echo $ssUrl; ?>" method="post">
            <table width="400" class="table-borderd">
                <tr>
                    <th scope="row">Name</th>
                    <td><input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $asResult['name']; ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $asResult['email']; ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Mobile</th>
                    <td><input type="text" name="mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : $asResult['mobile']; ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td><textarea rows="5" cols="20" name="address"><?php echo isset($_POST['address']) ? $_POST['address'] : $asResult['address']; ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td><input type="submit" name="insert" value="Edit" class="btn"></td>
                </tr>
            </table>
        </form>
    </div>