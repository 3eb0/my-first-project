<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


class Post
{
    public string $title;

    public string $body;
    public string $date;
    public string $slug;

    public function __construct($title, $body, $date)
    {
        $this->title = $title;
        $this->body = $body;
        $this->date = $date;
        $this->slug = $slug;


    }

    public static function find($slug){
        return static ::all()->firstwhere('slug',$slug);
    }

    public static function all(){
        return cache()->rememberForever('posts.all',function (){
            return collect(File::files(resource_path("posts")))->map(function ($file){
                $object = YamlFrontMatter::parseFile($file);

                return new Post(
                    $object->matter("title"),
                    $object->body(),
                    $object->matter("date"),
                    $object->matter("slug"),
                );
            })->sortByDesc('date');
        });


    }
}
