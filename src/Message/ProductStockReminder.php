<?php
namespace App\Message;

class ProductStockReminder
{
    /**
     * @var int
     */
    private $id_product;
    /**
     * @var int
     */    
    private $id_product_attribute;
    
    public function __construct(int $id_product, int $id_product_attribute)
    {
        $this->id_product = $id_product;
        $this->id_product_attribute = $id_product_attribute;
    }

    /**
     * @return int
     */
    public function getIdProduct(){
        return $this->id_product;
    }
    
    /**
     * @return int
     */
    public function getIdProductAttribute(){
        return $this->id_product_attribute;
    }    
}