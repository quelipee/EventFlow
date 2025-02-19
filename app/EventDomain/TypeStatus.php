<?php

namespace App\EventDomain;

enum TypeStatus : string
{
    case ACTIVE = 'ATIVO';
    case INACTIVE = 'INATIVO';
}
