<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('subscriber_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'subscriber_id']);

        });


            //Тригер на недопущения самоподписок

            DB::unprepared('
            CREATE TRIGGER prevent_self_subscription
            BEFORE INSERT ON subscriptions
            FOR EACH ROW
            BEGIN
                IF NEW.user_id = NEW.subscriber_id THEN
                    SIGNAL SQLSTATE \'45000\'
                    SET MESSAGE_TEXT = \'User cannot subscribe to themselves.\';
                END IF;
            END
        ');

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_self_subscription');

        Schema::dropIfExists('subscriptions');
    }
};
