<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 评论
        Schema::create(config('comment.comment_table'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index()->comment('会员ID');
            $table->unsignedBigInteger('parent_id')->default(0)
                ->comment('上级');
            $table->morphs('commentable');
            $table->string('content')->nullable()->comment('回复内容');
            $table->json('options')->nullable()->comment('选项参数');
            $table->boolean('status')->default(0)->comment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('comment.comment_table'));
    }
}