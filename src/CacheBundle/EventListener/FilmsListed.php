<?php


namespace CacheBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class FilmsListed
{
    public function addFilmsListToCache(Event $event)
    {
        file_put_contents("/tmp/cache.test", "Cache");
    }
}
