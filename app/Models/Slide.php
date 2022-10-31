<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    public const TYPE_SLIDER_PICTURES = 'Slider Picture';
    public const TYPE_PICTURES = 'Picture';

    public const TYPE_FIRST_ROW = 'Row 1';
    public const TYPE_SECOND_ROW = 'Row 2';
    public const TYPE_THIRD_ROW = 'Row 3';

    protected $fillable = [
        // 'name',
        'type',
        'row',
        'image'
    ];


    /**
     * @return array
     */
    public static function getTypeSliders(): array
    {
        return [
            self::TYPE_SLIDER_PICTURES,
            self::TYPE_PICTURES
        ];
    }

    /**
     * @return array
     */
    public static function getTypeRows(): array
    {
        return [
            self::TYPE_FIRST_ROW,
            self::TYPE_SECOND_ROW,
            self::TYPE_THIRD_ROW
        ];
    }
}
