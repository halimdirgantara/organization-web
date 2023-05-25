<?php

namespace App\Enums;

enum Status:string{
    case Publish = "publish";
    case Process = "process";
    case Reject = "reject";
    case Draft = "draft";
    case Private = "private";

}