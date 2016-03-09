<?php

namespace CacheBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class FilmEdited
{
    public function removeCacheAfterFilmEdited(Event $event)
    {
        echo "Cache";
    }
}