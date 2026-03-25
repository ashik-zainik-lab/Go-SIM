<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->LongText('description')->nullable();
            $table->decimal('monthly_price', 12, 2)->default(0.00);
            $table->decimal('old_monthly_price', 12, 2)->default(0.00);
            $table->decimal('yearly_price', 12, 2)->default(0.00);
            $table->decimal('old_yearly_price', 12, 2)->default(0.00);
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_monthly_plan_id')->nullable();
            $table->string('stripe_yearly_plan_id')->nullable();
            $table->string('paypal_product_id')->nullable();
            $table->string('paypal_monthly_plan_id')->nullable();
            $table->string('paypal_yearly_plan_id')->nullable();
            $table->string('type')->default(PLAN_TYPE_LOCAL);
            $table->LongText('coverage')->nullable();
            $table->unsignedInteger('data_limit_mb')->nullable();
            $table->tinyInteger('is_unlimited')->default(0);
            $table->unsignedSmallInteger('validity_value')->default(30);
            $table->string('validity_unit')->default(PLAN_VALIDITY_DAYS);
            $table->string('networks')->nullable();
            $table->tinyInteger('is_5g_enabled')->default(0);
            $table->unsignedBigInteger('provider_id')->nullable()->index();
            $table->tinyInteger('has_voice')->default(0);
            $table->tinyInteger('has_sms')->default(0);
            $table->tinyInteger('is_topup_enabled')->default(0);
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};