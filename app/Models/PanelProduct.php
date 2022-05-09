<?php

namespace App\Models;

use App\Models\Product;

class PanelProduct extends Product
{
    //This panelproduct is only applicable to the admin panel
    
    /**
     * The "booted" method of the model.
     *
     * @return void
     */

    protected static function booted()
    {
        //If we extends the product model class and wants to avoid the globalScope apply, just dont write anything / comment out this line as same in the product
        // static::addGlobalScope(new AvailableScope);
    }

    //These two lines tell the laravel to Use original product instead of panelProduct
    //Hence this panel product can be used as same as the product with the foreign key (relationship) and morph class are the same
    public function getForeignkey(){
        $parent = get_parent_class($this);
        return (new $parent)->getForeignkey();
    }

    public function getMorphClass(){
        $parent = get_parent_class($this);
        return (new $parent)->getMorphClass();
    }
}
