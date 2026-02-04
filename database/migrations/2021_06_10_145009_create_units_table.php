
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations');
            $table->string('name')->index();
            $table->string('sigla');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('operation')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('main_image_link')->nullable();
            $table->string('google_maps_link')->nullable();
            $table->text('google_maps_iframe')->nullable();
            $table->boolean('web');
            $table->string('document')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
