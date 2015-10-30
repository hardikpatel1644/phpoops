<?php

require_once 'db.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author Hardik Patel <hardik@techdefence.com>
 */
class Model extends Db
{

    protected $ssTableName = '';
    protected $ssAlias = "";
    protected $ssPrimaryKey = '';
    protected $obCon;

    public function __construct($ssTabaleName = '', $ssAlias = '', $ssPrimaryKey = '')
    {
        $this->ssTableName = $ssTabaleName;
        $this->ssAlias = $ssAlias;
        $this->ssPrimaryKey = $ssPrimaryKey;


        parent::__construct();
    }

    /**
     * Function to fetch one recod
     * @param string $ssQuery
     * @return array
     */
    protected function getOne($ssQuery = '')
    {
        $asResult = array();
        if ($ssQuery != '')
        {
            $obQuery = $this->obCon->prepare($ssQuery);
            $obRes = $obQuery->execute();

            if (!$obRes)
            {
                echo "PDO::errorInfo():";
                echo '<br />';
                echo 'error SQL: ' . $ssQuery;
                die();
            }
            $obQuery->setFetchMode(PDO::FETCH_ASSOC);
            $asResult = $obQuery->fetch();
        }
        return $asResult;
    }

    /**
     * Function to get All data
     * @param string $ssQuery
     * @return array
     */
    function getAll($ssQuery)
    {
        $asResult = array();
        if ($ssQuery != '')
        {
            $obQuery = $this->conn->prepare($ssQuery);
            $obRes = $obQuery->execute();
            if (!$obRes)
            {
                echo 'PDO::errorInfo():';
                echo '<br />';
                echo 'error SQL: ' . $ssQuery;
                die();
            }
            $obQuery->setFetchMode(PDO::FETCH_ASSOC);
            $asResult = $obQuery->fetchAll();
        }
        return $asResult;
    }

    /**
     * Function to execute PDO query
     * @param string $ssQuery
     * @return object
     */
    function execute($ssQuery = '')
    {
        $obResult = '';
        if ($ssQuery != '')
        {
            if (!$obResult = $this->conn->exec($ssQuery))
            {
                echo 'PDO::errorInfo():';
                echo '<br />';
                echo 'error SQL: ' . $ssQuery;
                die();
            }
        }
        return $obResult;
    }

    /**
     * Function to instert data
     * @param array $asData
     * @return object
     */
    function insertData($asData = array())
    {
        $asFields = array_keys($asData);
        $asValues = array_values($asData);
        $ssFieldlist = implode(',', $asFields);
        $ssQs = str_repeat("?,", count($asFields) - 1);

        $ssQuery = "INSERT INTO `" . $this->ssTableName . "` (" . $ssFieldlist . ") VALUES (${ssQs}?)";

        $obQuery = $this->obCon->prepare($ssQuery);
        return $obQuery->execute($asValues);
    }

    /**
     * Function to update data
     * @param array $asData
     * @param int $snId
     * @return object
     */
    function updateData($asData = array(), $snId = '')
    {
        $asFields = array_keys($asData);
        $asValues = array_values($asData);
        $ssFieldlist = implode(',', $asFields);
        $ssQs = str_repeat("?,", count($asFields) - 1);
        $ssFirstField = true;

        $ssQuery = "UPDATE `" . $this->ssTableName . "` SET";
        for ($i = 0; $i < count($asFields); $i++)
        {
            if (!$ssFirstField)
            {
                $ssQuery .= ", ";
            }
            $ssQuery .= " " . $asFields[$i] . "=?";
            $ssFirstField = false;
        }
        $ssQuery .= " WHERE `id` =?";


        $obQuery = $this->obCon->prepare($ssQuery);

        $asValues[] = $snId;
        return $obQuery->execute($asValues);
    }

    /**
     * Function to get All data
     * @return array
     */
    public function getAllData($ssSearchBy = '',$ssSearchVal = '')
    {
        $ssWhere = '';
        if($ssSearchBy != '' && $ssSearchVal != '')
        {
            $ssWhere .= " WHERE ".$ssSearchBy. " LIKE '%".$ssSearchVal."%'";
        }
        
        $asData = array();
        $ssQuery = "SELECT * FROM $this->ssTableName  $ssWhere";
        $obQuery = $this->obCon->query($ssQuery);

        while ($obResult = $obQuery->fetch(PDO::FETCH_ASSOC))
        {
            $asData[] = $obResult;
        }
        return $asData;
    }

    /**
     * Function to get data by id
     * @param integer $snId
     * @return array
     */
    public function getDataById($snId = '')
    {

        $asData = array();

        if ($snId != '')
        {
            $ssQuery = "SELECT * FROM $this->ssTableName WHERE $this->ssPrimaryKey = :id";
            $obQuery = $this->obCon->prepare($ssQuery);
            $obQuery->execute(array(':id' => $snId));
            $asData = $obQuery->fetch(PDO::FETCH_ASSOC);
        }
        return $asData;
    }

    /**
     * Function to delete data by id
     * @param int $snId
     * @return boolean
     */
    public function deleteData($snId = '')
    {
        if ($snId != '')
        {
            $ssQuery = "DELETE FROM $this->ssTableName WHERE $this->ssPrimaryKey=:id";
            $obQuery = $this->obCon->prepare($ssQuery);

            $ssRes = $obQuery->execute(array(':id' => $snId));
            return true;
        }
        return false;
    }

}
