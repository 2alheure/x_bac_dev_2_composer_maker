<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController {
    #[Route('/contact', name: 'app_contact')]
    public function index(MailerInterface $mailer): Response {
        $email = new TemplatedEmail();
        $email->from('emanuel.macron@elysee.gouv.fr');
        $email->to('brigitte.macron@elysee.gouv.fr');
        $email->subject('Coucou ma puce.');
        $email->text('Je t\'aime ma chérie.');
        $email->htmlTemplate('contact/index.html.twig');
        $email->context([
            'controller_name' => 'ContactController'
        ]);
        $email->replyTo('manuel.valls@chorizo.es');

        $mailer->send($email);

        return new Response('OK');
    }
}
