<?php

namespace App\Enums;

enum SharedStatus:string{
    case None = "none";
    case Shared = "shared";
    case Process = "process";
    case Reject = "reject";

}