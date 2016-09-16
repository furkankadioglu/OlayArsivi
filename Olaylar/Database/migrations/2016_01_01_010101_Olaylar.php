<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Olaylar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olaylar_olaylar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->integer('userId')->unsigned();
            $table->date('baslangicTarihi');
            $table->date('bitisTarihi');
            $table->integer('toplamObjeSayisi');
            $table->integer('toplamGoruntulenmeSayisi');
            $table->integer('status')->default(1);
            $table->timestamps();

           $table->foreign('userId')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('olaylar_objeler_tipler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->timestamps();

        });


        Schema::create('olaylar_objeler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('userId')->unsigned();
            $table->integer('olayId')->unsigned();
            $table->integer('objeTypeId')->unsigned();
            $table->string('sourceUrl');
            $table->integer('photoId');
            $table->integer('goruntulenmeSayisi');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('objeTypeId')->references('id')->on('olaylar_objeler_tipler')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('userId')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('olayId')->references('id')->on('olaylar_olaylar')
            ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('olaylar_olaylar_begeniler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('olayId')->unsigned();
            $table->timestamps();

            $table->foreign('olayId')->references('id')->on('olaylar_olaylar')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('userId')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('olaylar_olaylar_favoriler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('olayId')->unsigned();
            $table->timestamps();

            $table->foreign('olayId')->references('id')->on('olaylar_olaylar')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('userId')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('olaylar_objeler_raporlar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('objeId')->unsigned();
            $table->string('description');
            $table->string('telefon');
            $table->string('mail');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('objeId')->references('id')->on('olaylar_objeler')
            ->onUpdate('cascade')->onDelete('cascade');
        });

         \DB::table('olaylar_objeler_tipler')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Link',
                'icon' => 'fa fa-link',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Photo',
                'icon' => 'fa fa-photo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Video',
                'icon' => 'fa fa-camera',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('olaylar_olaylar');
        Schema::drop('olaylar_objeler_tipler');
        Schema::drop('olaylar_objeler');
        Schema::drop('olaylar_objeler_raporlar');
        Schema::drop('olaylar_olaylar_begeniler');
        Schema::drop('olaylar_olaylar_favoriler');
        Schema::drop('olaylar_objeler_raporlar');
    }
}
