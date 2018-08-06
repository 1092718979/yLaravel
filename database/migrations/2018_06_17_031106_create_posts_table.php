<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *      执行迁移
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->default("");
            $table->text('content');
            $table->integer('user_id')->defallt(0);
            //时间戳函数     自动创建created_at  updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *      执行回滚
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
