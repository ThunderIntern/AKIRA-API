<?php

namespace App\GraphQL\Query\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id'  => ['name' => 'id', 'type' => Type::int()],
            'username'  => ['name' => 'username', 'type' => Type::string()],
            'scope'  => ['name' => 'scope', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return User::where('id',$args['id'])->get();
        }elseif(isset($args['username'])) {
            return User::where('username',$args['username'])->get();
        }elseif(isset($args['scope'])) {
            return User::wherehas('scopes', function($q)use($args){
                $q->where('scope', 'admin');
            })->get();
        }else {
            return User::all();
        }
    }
}