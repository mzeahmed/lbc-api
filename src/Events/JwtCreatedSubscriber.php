<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        $data = $event->getData();
        $data['username'] = $user->getUsername();
        $data['password'] = $user->getPassword();

        $event->setData($data);
    }
}
