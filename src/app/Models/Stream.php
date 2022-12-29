<?php

namespace App\Models;

use App\Gateways\AntMediaServerService;
use App\Services\HashidService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Stream
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $preview
 * @property int $creator_id
 * @property string $hash_id
 * @property string $url
 * @property bool $is_online
 * @property \DateTime $created_at
 */
class Stream extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'streams';

    /**
     * @return HasOne
     */
    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    /**
     * @return string
     */
    public function getHashIdAttribute(): string
    {
        return HashidService::encode(self::class, $this->id);
    }

    /**
     * @return bool
     */
    public function getIsOnlineAttribute(): bool
    {
        return (new AntMediaServerService())->getStream($this->hash_id)['status'] === 'broadcasting';
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getPreviewAttribute($value): ?string
    {
        if (!$value) {
            return null;
        }

        return Storage::disk('public')->url($value);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return 'http://127.0.0.1:5080/WebRTCApp/play.html?id=' . $this->hash_id;
    }
}
