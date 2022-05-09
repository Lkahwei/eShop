<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // In order to create image 
    // 1. Define in the migration table: $table->morphs('imageables');
    // 2. The imageables can refer to anything
    // 3. Define in the Image model the function name imageables (It must be consistent with the name that is defined in the migration table)
    // 4. In the target table: public function image(){return $this->morphOne(Image::class, 'imageables');
    // 5. morphOne means Polymorphic one-to-one relationship
    // 6. Create the user first: $user = App\Models\User::factory()->create();
    // 7. Create the image: $user->image()->save(App\Models\Image::factory()->make());
    // One-to-many polymorphic relationship
    // PHP artisan tinker command
    // 1. In order to generate multiple image for this product: $porduct->images()->saveMany(App\Models\Image::factory(number that must be defined)->make());
    
    use HasFactory;

    protected $fillable = ['path'];

    public function imageables(){
        return $this->morphTo();
    }
}
