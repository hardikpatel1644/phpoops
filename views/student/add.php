<div class="container">
    <div class="container">
        <h3>Insert Data</h3>
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
        $ssUrl = "?controller=student&action=add";
        ?>
        <form action="<?php echo $ssUrl; ?>" method="post">
            <table width="400" class="table-borderd">
                <tr>
                    <th scope="row">Name</th>
                    <td><input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Mobile</th>
                    <td><input type="text" name="mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : ''; ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td><textarea rows="5" cols="20" name="address"><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td><input type="submit" name="insert" value="Add" class="btn"></td>
                </tr>
            </table>
        </form>
    </div>