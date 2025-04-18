<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\InteracstsWithModelCaching;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;
    use InteracstsWithModelCaching;

    protected $fillable = [
        'first_name',
        'last_name',
        'date',
        'email',
        'campaign',
        'disposition',
        'email_sent_at',
    ];

    protected $appends = ['name'];

    protected function name(): Attribute
    {
        return Attribute::make(

            get: function (mixed $value, array $attributes) {
                $name = join(
                    " ",
                    [
                        $attributes['first_name'],
                        $attributes['last_name'],
                    ]
                );

                return str($name)->trim()->title()->toString();
            }
        );
    }


    protected function disposition(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtolower($value),
            set: fn(string $value) => strtolower($value),
        );
    }
}
