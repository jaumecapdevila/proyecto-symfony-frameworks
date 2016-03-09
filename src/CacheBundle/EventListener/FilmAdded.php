<?php

namespace CacheBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class FilmAdded
{
    public function removeCacheAfterFilmAdded(Event $event)
    {

    }
}