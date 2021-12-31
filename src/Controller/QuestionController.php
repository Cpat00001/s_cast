<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/" , name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment)
    {
        return $this->render('question/homepage.html.twig');
        
        // example of using Twig service directly
        /*
        $html = $twigEnvironment->render('question/homepage.html.twig');
        return new Response($html);
        */
    }
    /**
     * @Route("/questions/{slug}" , name="app_question_show")
     */
    public function show($slug , CacheInterface $cache)
    {
        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];
        $questionText = "I've been *turned* into a cat, any thoughts on how to turn back? 
                            While I'm **adorable**, I don't really care for cat food.";

        $cachedQuestionText = $cache->get('markdown_'.md5($questionText), function() use($questionText){
            return $questionText;
        });
        // dd(phpinfo());
        dump($cache);

        return $this->render('question/show.html.twig',[
            'question' =>  ucwords(str_replace('-',' ', $slug)),
            'questionText' => $questionText, 
            'answers' => $answers,
        ]);
        
    }
}


