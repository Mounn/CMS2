<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('cms2_user_index', new Route(
    '/',
    array('_controller' => 'AppBundle:LoginAccounts:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('cms2_user_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:LoginAccounts:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('cms2_user_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:LoginAccounts:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('cms2_user_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:LoginAccounts:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('cms2_user_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:LoginAccounts:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
