<?php

declare(strict_types=1);

namespace Potter\Event\Dispatcher;

use \Psr\EventDispatcher\ListenerProviderInterface;

trait EventDispatcherTrait 
{
    private ListenerProviderInterface $listenerProvider;
    
    final public function dispatch(object $event): object
    {
        $listenerProvider = $this->listenerProvider;
        $events = $listenerProvider->getListenersForEvent($event);
        foreach($events as $dispatchedEvent) {
            $dispatchedEvent($event);
        }
    }
    
    final public function getListenerProvider(): ListenerProviderInterface
    {
        return $this->listenerProvider;
    }
    
    final public function hasListenerProvider(): bool
    {
        return isset($this->listenerProvider);
    }
    
    final protected function setListenerProvider(ListenerProviderInterface $listenerProvider): void
    {
        $this->listenerProvider = $listenerProvider;
    }
}