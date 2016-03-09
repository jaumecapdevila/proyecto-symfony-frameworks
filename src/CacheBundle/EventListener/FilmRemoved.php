<?php

namespace CacheBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class FilmRemoved
{
    public function removeCacheAfterFilmRemoved(Event $event)
    {

    }
}