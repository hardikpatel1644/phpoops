<?php


/**
 * Description of student
 *
 * @author Hardik Patel <hardik@techdefence.com>
 */
class student extends Model
{
    protected $ssTableName = 'students';
    protected $ssAlias = "s";
    protected $ssPrimaryKey = 'id';

    public function __construct()
    {
        parent::__construct($this->ssTableName, $this->ssAlias, $this->ssPrimaryKey);
    }
    
    

}
