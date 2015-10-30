<?php

/**
 * Description of student_controller
 *
 * @author Hardik Patel <hardik@techdefence.com>
 */
class studentController
{

    private $obDb;
    public $ssMessage = '';

    public function __construct()
    {
        $this->obDb = new student();
    }

    function manage()
    {

        $asResult = $this->obDb->getAllData();

        require_once('views/student/index.php');
    }

    /**
     * Function to edit the data
     */
    function add()
    {
        $asErrorMessage = array();
        if (isset($_POST) && sizeof($_POST) > 1)
        {
            $asPost['name'] = $_POST['name'];
            $asPost['email'] = $_POST['email'];
            $asPost['mobile'] = $_POST['mobile'];
            $asPost['address'] = $_POST['address'];

            $asErrorMessage = $this->validate_fields($asPost);
            if (sizeof($asErrorMessage) == 0)
            {
                $this->obDb->insertData($asPost);

                $ssMessage = "Record has been added successfully.";
                header("Location:http://localhost/demos/php/phpoops/index.php?message=" . $ssMessage);
            }
        }

        require_once('views/student/add.php');
    }

    /**
     * Function to edit the data
     */
    function edit()
    {
        $snId = $_GET['id'];
        $asErrorMessage = array();
        if ($snId != '' && is_numeric($snId))
        {
            if (isset($_POST) && sizeof($_POST) > 1)
            {
                $asErrorMessage = array();

                $asPost['name'] = $_POST['name'];
                $asPost['email'] = $_POST['email'];
                $asPost['mobile'] = $_POST['mobile'];
                $asPost['address'] = $_POST['address'];

                $asErrorMessage = $this->validate_fields($asPost);
                if (sizeof($asErrorMessage) == 0)
                {
                    $this->obDb->updateData($asPost, $snId);
                    $ssMessage = "Record has been updated successfully.";
                    header("Location:http://localhost/demos/php/phpoops/index.php?message=" . $ssMessage);
                }
            }

            $asResult = $this->obDb->getDataById($snId);
            require_once('views/student/edit.php');
        }
    }

    /**
     * Function to delete data
     */
    function delete()
    {
        $snId = $_GET['id'];
        if ($snId != '' && is_numeric($snId))
        {
            $this->obDb->deleteData($snId);
            $this->ssMessage = "Record has been deleted successfully.";
        }
        else
        {
            $this->ssMessage = "Record not metched";
        }
        //  header('location:http://localhost/demos/php/phpoops/index.php');
        $ssMessage = "Record has been deleted successfully.";
        header("Location:http://localhost/demos/php/phpoops/index.php?message=" . $ssMessage);
    }

    function error()
    {
        echo "Page Not Found";
    }

    function validate_fields($asPost = array())
    {
        $ssFlag = FALSE;
        $asErrorMsg = array();
        if ($asPost != '')
        {
            foreach ($asPost as $ssKey => $ssValue)
            {
                if (trim($ssValue) == '')
                    $asErrorMsg[$ssKey] = ucfirst($ssKey) . " is required.";
                if ($ssKey == 'email')
                {
                    if (!filter_var($ssValue, FILTER_VALIDATE_EMAIL))
                    {
                        $asErrorMsg[$ssKey] = "Please enter valid email";
                    }
                }
            }
        }
        return $asErrorMsg;
    }

}
