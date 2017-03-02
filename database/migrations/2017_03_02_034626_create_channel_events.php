<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'channel_events',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('provider');
                $table->integer('eventID');
                $table->integer('channelId')->index();
                $table->integer('channelStbNumber')->index();
                $table->boolean('channelHD');
                $table->string('channelTitle');
                $table->string('epgEventImage')->nullable();
                $table->string('certification')->nullable();
                $table->string('displayDateTimeUtc');
                $table->string('displayDateTime');
                $table->string('displayDuration');
                $table->string('siTrafficKey')->nullable();
                $table->string('programmeTitle')->nullable();
                $table->string('programmeId')->nullable();
                $table->string('episodeId')->nullable();
                $table->string('shortSynopsis')->nullable();
                $table->string('longSynopsis')->nullable();
                $table->string('actors')->nullable();
                $table->string('genre')->nullable();
                $table->string('subGenre')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_events');
    }
}
