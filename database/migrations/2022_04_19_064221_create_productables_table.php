<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductablesTable extends Migration
{
    //If want to rename the migration file name, please make sure that the class name "CreateProductablesTable" is matched to the snake case version after _create....etc
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 1. For previous version, there is two pivot table with only slightly differences in the cart_id and order_id
    // 2. Since it is a many-to-many polymorphic relationship between products and carts, products and orders.
    // 3. Remove either one table if you created two tables previously
    // 4. Rename the migration to polymorphic table (in this case is product)
    // 5. Rename the classname to match the migration file name
    // 6. Rename / Create the table name to in this case is productables (plural)
    // 7. Add a $table->morphs('productable') (in singular form)
    public function up()
    {
        Schema::create('productables', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->morphs('productable');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productables');
    }
}
