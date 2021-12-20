<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController 
{
    /**
     * @Route("comment/{id}/vote/{direction}")
     *
    */
    public function commentVote($id , $direction){

        //todo use id to query database

        //use real logic here to save to database
        if($direction === 'up'){
            $currentVote = rand(7,100);
        }else{
            $currentVote = rand(0,5);
        }

        return new JsonResponse(['votes' => $currentVote ]);
    }
}