<?php

namespace App\Enums;

class PostActions
{
    const CreatedPost = 'created_post';
    const UpdatedPost = 'updated_post';
    const DeletedPost = 'deleted_post';
    const CustomAction = 'custom_action';

    public static function getActions()
    {
        return [
            self::CreatedPost => self::CreatedPost,
            self::UpdatedPost => self::UpdatedPost,
            self::DeletedPost => self::DeletedPost,
            self::CustomAction => self::CustomAction,
        ];
    }
}
