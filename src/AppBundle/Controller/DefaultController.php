<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType; 

use DateTime;

use AppBundle\Entity\Visitas; 


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $imagenes = [];
        $directory = $this->get('kernel')->getRootDir() . '\..\web\img\galeria';        
        //dirname(__FILE__)
        $images = glob($directory . "/*");
        $ipVisitante = $this->getUserIP();
        $hoy = new DateTime();
        $visitaNueva = new Visitas();
        $visitaNueva->setIp($ipVisitante);
        $visitaNueva->setFecha($hoy);
        $em->persist($visitaNueva);
        $em->flush();
        // $contador = 0; //para setear un máximo de imagenes
        foreach ($images as $img) {
            // if($contador < 20) {
                array_push($imagenes, basename($img));
            // }
            // $contador++;
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', ['imagenes'=>$imagenes]);
    }

    private function getUserIP() {
        if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }


    /**
     * @Route("/login", name="loginn")
     */
    public function loginAction(Request $request) {
        // $login = new Logueo();

        // $form = $this->createFormBuilder($login)
        //             ->add('mail', TextType::class, [
        //                 'required' => true
        //                 ])
        //             ->add('password', PasswordType::class, [
        //                 'required' => true
        //                 ])
        //             ->add('save', SubmitType::class, ['label' => 'Ingresar'])
        //             ->getForm();

        // $form->handleRequest($request); 

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $login = $form->getData();
        //     if($login->mail === 'admin' && $login->password === '1234') {
        //       return $this->redirectToRoute("subir");
        //     } else {
        //         return $this->errorLogueo();
        //     }
        // }

        // return $this->render('default/admin/login.html.twig', [
        //     'form' => $form->createView(),
        // ]);
    }
    private function errorLogueo() {
        // return $this->render('default/admin/errorLogueo.html.twig', []);
    }
    /**
     * @Route("/admin", name="subirr")
     */
    public function newFotoAction(Request $request) { 
        // $subidaImagen = new Imagenes(); 
        // $form = $this->createFormBuilder($subidaImagen) 
        //     ->add('imagen', FileType::class, []) 
        //     ->add('save', SubmitType::class, ['label' => 'Subir']) 
        //     ->getForm(); 

        // $form->handleRequest($request); 
        // if ($form->isSubmitted()) {
        //     if ($form->isValid()) {
        //         $archivo = $subidaImagen->getImagen(); 
        //         $nombreArchivo = md5(uniqid()).'.'.$archivo->guessExtension(); 
        //         $archivo->move($this->getParameter('photos_directory'), $nombreArchivo); 
        //         $subidaImagen->setImagen($nombreArchivo); 
        //         return $this->render('default/admin/admin.html.twig', ['form' => $form->createView(), 'correcto' => 'bien']); 
        //     } else {
        //          return $this->render('default/admin/admin.html.twig', ['form' => $form->createView(), 'correcto' => 'mal']); 
        //     }
        // } else { 
        //     return $this->render('default/admin/admin.html.twig', ['form' => $form->createView(), 'correcto' => 'incompleto']); 
        // } 
    }   

    /** 
    * @Route("/redirect",  name="redirect") 
    */ 
    public function redirectAction(Request $request) { 
       switch ($request->query->get('div')) {
           case 'gestora':
                return $this->render('default/user/gestora.html.twig', []);
               break;
           case 'representacion':
                return $this->render('default/user/representacion.html.twig', []);
               break;
           case 'booking':
                return $this->render('default/user/booking.html.twig', []);
               break;
           case 'gestion':
                return $this->render('default/user/gestion.html.twig', []);
               break;
           default:
               # code...
               break;
       }
    }   
}
