<?php
require_once('DAL.class.php');

class service extends DAL
{
    function getAllServices()
    {
        $sql = "SELECT * FROM services";


        return $this->getdata($sql);
    }
    
    function editService($id, $title,$description)
    {
        $sql = "update services set title='$title',description='$description' where id=$id" ;
        return $this->execute($sql);
    }

}
