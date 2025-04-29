<?php

use App\Core\Routing\Routes;
use App\Middlewares\BlockEdge;


Routes::get("/php-expert/Mini%20Projects/Micro%20Framework%20Laravel/" , "HomeController@index" , [BlockEdge::class]);
Routes::get("/php-expert/Mini%20Projects/Micro%20Framework%20Laravel/colors/red" , "ColorsController@red");
Routes::get("/php-expert/Mini%20Projects/Micro%20Framework%20Laravel/colors/green" , "ColorsController@green");
Routes::get("/php-expert/Mini%20Projects/Micro%20Framework%20Laravel/colors/purple" , "ColorsController@purple");
Routes::get("/php-expert/Mini%20Projects/Micro%20Framework%20Laravel/posts/{pid}/comments/{cid}" , "PostsController@index");