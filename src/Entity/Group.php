<?php

declare(strict_types=1);

namespace App\Entity;

final class Group
{
    public const string READ_LIST = 'read_list';

    public const string READ_DETAIL = 'read_detail';

    public const string CREATE = 'create';

    public const string UPDATE = 'update';

    public const string DELETE = 'delete';

    public const array ALL = [
        self::READ_LIST,
        self::READ_DETAIL,
        self::CREATE,
        self::UPDATE,
        self::DELETE,
    ];
}
