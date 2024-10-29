<?php
require_once('DAL.class.php');

class Brand extends DAL
{
    function getAllBrands()
    {
        $sql = "SELECT * FROM brand_images";


        return $this->getdata($sql);
    }
    function deleteBrand($id)
    {
        $sql = "delete FROM brand_images where id=$id";
        return $this->execute($sql);
    }
    function addBrand($img)
    {
        $sql = "insert into brand_images(image_path) values('$img')";
        return $this->execute($sql);
    }

}
