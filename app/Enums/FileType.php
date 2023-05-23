<?php

namespace App\Enums;

enum MenuType:string{
    case Image = "post";
    case Video = "link";
    case Document = "category";

}