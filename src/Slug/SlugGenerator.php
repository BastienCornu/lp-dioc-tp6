<?php

namespace App\Slug;

use Cocur\Slugify\Slugify;

class SlugGenerator
{
    public function generate(string $name)
    {
        $slugify = new Slugify();

        return $slugify->slugify($name);
    }
}
