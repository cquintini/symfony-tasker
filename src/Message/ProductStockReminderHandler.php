<?php
namespace App\Message;

use App\Message\ProductStockReminder;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductStockReminderHandler implements MessageHandlerInterface
{
    private $httpClient;
    private $params;

    public function __construct(HttpClientInterface $httpClient, ContainerBagInterface $params)
    {
        $this->httpClient = $httpClient;
        $this->params = $params;
    }

    public function __invoke(ProductStockReminder $productStockReminder)
    {
        $id_product = $productStockReminder->getIdProduct();
        $id_product_attribute = $productStockReminder->getIdProductAttribute();

        $response = $this->httpClient->request(
            'POST',
            'http://store.local.dracocomarch.com/module/vitatiendamain/handler',
            //$this->params->get('store_handler_url'),
            [
                'json' => ['id_product' => $id_product, 'id_product_attribute' => $id_product_attribute]
            ]
        );

        dump($response->getContent());
    } 
}