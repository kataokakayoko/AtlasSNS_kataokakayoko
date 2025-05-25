<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('follows')) {
            Schema::create('follows', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('following_id'); // フォローする側
                $table->unsignedBigInteger('followed_id'); // フォローされる側
                $table->timestamps();

                // インデックス
                $table->index('following_id');
                $table->index('followed_id');

                // 外部キー制約
                $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');

                // ユーザー間の重複を防ぐユニーク制約
                $table->unique(['following_id', 'followed_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
};
