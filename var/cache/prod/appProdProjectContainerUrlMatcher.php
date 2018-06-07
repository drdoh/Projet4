<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        if (0 === strpos($pathinfo, '/billetterie')) {
            // dr_doh_ticket_billetterie
            if ('/billetterie' === $trimmedPathinfo) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($rawPathinfo.'/', 'dr_doh_ticket_billetterie');
                }

                return array (  '_controller' => 'DrDoh\\TicketBundle\\Controller\\BookingController::ticketFormAction',  '_route' => 'dr_doh_ticket_billetterie',);
            }

            // dr_doh_ticket_billetterie_2
            if ('/billetterie/visiteur' === $pathinfo) {
                return array (  '_controller' => 'DrDoh\\TicketBundle\\Controller\\BookingController::guestFormAction',  '_route' => 'dr_doh_ticket_billetterie_2',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
