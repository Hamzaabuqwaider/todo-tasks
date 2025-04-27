<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property
 * @property string $text
 * @property string $status
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property User $user
 */
class Task extends Model
{
    use softDeletes;

    public const TEXT = 'text';
    public const STATUS = 'status';
    public const USER_ID = 'user_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id',
        'text',
        'status',
    ];

    protected $casts = [
        Task::TEXT => 'string',
        Task::STATUS => 'string',
        Task::USER_ID => 'int',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
