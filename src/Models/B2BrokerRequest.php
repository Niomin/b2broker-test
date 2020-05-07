<?php

namespace Niomin\B2BrokerTest\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeImmutable;

/**
 * Class B2BrokerRequest
 *
 * @property integer $id
 * @property string $text
 * @property bool $deleted
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @method static $this|null find(int $id)
 */

class B2BrokerRequest extends Model
{
    protected $table = 'b2broker_request';
    protected $hidden = ['deleted'];
}

