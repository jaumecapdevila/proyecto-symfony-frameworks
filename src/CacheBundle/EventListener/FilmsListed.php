<?php


namespace CacheBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class FilmsListed
{
    public function addFilmsListToCache(Event $event)
    {
        echo "Cache";
    }
}
