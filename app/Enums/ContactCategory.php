<?php

namespace App\Enums;

enum ContactCategory:string{
    case Report = "report";
    case Request = "request";
    case Recomendation = "recomendation";
}
