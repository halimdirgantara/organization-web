<?php

namespace App\Enums;

enum MenuType:string{
    case Post = "post";
    case Link = "link";
    case Category = "category";
    case Tag = "tag";

}