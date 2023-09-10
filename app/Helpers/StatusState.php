<?php

namespace App\Helpers;

enum StatusState: string
{
    case Active = "active";
    case Resolved = "resolved";
}
