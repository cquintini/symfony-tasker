<?php 
namespace App\Controller;

use App\Message\ProductStockReminder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class TaskerController extends AbstractController
{
    /**
     * 
     * @Route("/backtostockreminder", name="backtostockreminder")
     * @param MessageBusInterface $bus
     * @param Request $request
     * @return Response
     */    
    public function sendBackStockReminder(MessageBusInterface $bus, Request $request): Response
    {
        $id_product = $request->query->get('id_product');
        $id_product_attribute = $request->query->get('id_product_attribute');       
        $bus->dispatch(
            new ProductStockReminder($id_product, $id_product_attribute),
            [new AmqpStamp('reminder_stock_queue')]
        );
        return new Response('Task Complete');
    }
}