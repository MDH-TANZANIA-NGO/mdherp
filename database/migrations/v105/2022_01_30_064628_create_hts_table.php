<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hts', function (Blueprint $table) {
            $table->id();
            $table->date('form_date');
            $table->unsignedBigInteger('data_clerk_id');
            $table->unsignedBigInteger('facility_id');
            $table->integer('tx_new_index_clients');
            $table->integer('tx_curr_index_clients');
            $table->integer('hvl_index_clients');
            $table->integer('total_index_clients');
            $table->integer('tx_new_offered_its');
            $table->integer('hvl_offered_its');
            $table->integer('tx_curr_offered_its');
            $table->integer('tx_new_accepted_its');
            $table->integer('hvl_accepted_its');
            $table->integer('tx_curr_accepted_its');
            $table->integer('tx_new_elicited_index_contacts');
            $table->integer('hvl_elicited_index_contacts');
            $table->integer('tx_curr_elicited_index_contacts');
            $table->integer('tx_new_known_positive');
            $table->integer('hvl_known_positive');
            $table->integer('tx_curr_known_positive');
            $table->integer('tx_new_index_contacts_tested');
            $table->integer('hvl_index_contacts_tested');
            $table->integer('tx_curr_index_contacts_tested');
            $table->integer('tx_new_index_positive');
            $table->integer('hvl_index_positive');
            $table->integer('tx_curr_index_positive');
            $table->integer('tx_new_index_positive_linked');
            $table->integer('hvl_index_positive_linked');
            $table->integer('tx_curr_index_positive_linked');
            $table->decimal('acceptance_rate')->nullable();
            $table->decimal('elicitation_ratio')->nullable();
            $table->decimal('index_testing_rate')->nullable();
            $table->decimal('yield')->nullable();
            $table->text('comments');
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
        Schema::dropIfExists('hts');
    }
}
