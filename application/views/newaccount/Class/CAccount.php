
<?php
class CAccount
{
    private $oConnManager;
    public function __construct()
    {
        $this->oConnManager = new CConManager();
    }


public $row;
public $rows;
public $num_rows;
public $effected_row;
public $message;
public $error;
public $IsSucess;


    public function SqlQuery($sql)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
        {
            $oResult=$this->oConnManager->query($sql);
        }
        return $oResult;
    }
}
?>