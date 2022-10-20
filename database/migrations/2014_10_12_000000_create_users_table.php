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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('stripe_customer_id')->nullable()->index();
            $table->timestamp('trial_ends_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('verification_code')->nullable();
            $table->dateTime('email_verified_at')->nullable();

            $table->tinyInteger('type')
                ->default(VENDOR)
                ->comment('0 = User, 1 = Admin');

            $table->tinyInteger('is_super_admin')
                ->default(NO)
                ->comment('0 = No, 1 = Yes');

            $table->tinyInteger('is_online')
                ->default(NO)
                ->comment('0 = No, 1 = Yes');

            $table->tinyInteger('is_active')
                ->default(NO)
                ->comment('0 = No, 1 = Yes');

            $table->bigInteger('added_by')->default(NONE);
            $table->bigInteger('last_updated_by')->default(NONE);

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
        Schema::dropIfExists('users');
    }
};
