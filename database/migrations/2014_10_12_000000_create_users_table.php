<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable()->unique();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->tinyInteger('role')->default(USER_ROLE_ADMIN);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('email_verification_status')->default(0);
            $table->tinyInteger('phone_verification_status')->default(0);
            $table->string('verify_token')->nullable();
            $table->integer('otp')->nullable();
            $table->dateTime('otp_expiry')->nullable();
            $table->tinyInteger('google_auth_status')->default(0);
            $table->text('google2fa_secret')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->unsignedBigInteger('image')->nullable();
            $table->dateTime('last_seen')->default(now());
            $table->tinyInteger('show_email_in_public')->default(STATUS_ACTIVE);
            $table->tinyInteger('show_phone_in_public')->default(STATUS_ACTIVE);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};