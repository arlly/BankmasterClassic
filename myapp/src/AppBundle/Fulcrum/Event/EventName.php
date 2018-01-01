<?php

namespace AppBundle\Fulcrum\Event;

class EventName
{
    const PRE_CREATE_ENTITY = 'fulcrum.pre_create.entity';
    const POST_CREATE_ENTITY = 'fulcrum.post_create.entity';
    const PRE_UPDATE_ENTITY = 'fulcrum.pre_update.entity';
    const POST_UPDATE_ENTITY = 'fulcrum.post_update.entity';
    const PRE_REMOVE_ENTITY = 'fulcrum.pre_remove.entity';
    const POST_REMOVE_ENTITY = 'fulcrum.post_remove.entity';
}
