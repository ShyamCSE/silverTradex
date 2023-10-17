<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('photo')->nullable();
            $table->string('made_by')->nullable();
            $table->string('making_charges')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('agent_mobile')->nullable();
            $table->string('packed_by')->nullable();
            $table->string('no_of_packages')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('dimension')->nullable();
            $table->string('courier_charges')->nullable();
            $table->string('packaging_additional_charges')->nullable();
            $table->string('preliminary_document')->nullable();
            $table->string('packaging_remarks')->nullable();
            $table->string('date_of_shipping')->nullable();
            $table->string('port_of_loading')->nullable();
            $table->string('port_of_discharge')->nullable();
            $table->string('shipping_charges')->nullable();
            $table->string('insurance_charges')->nullable();
            $table->string('additional Charges')->nullable();
            $table->string('shipping_remarks')->nullable();
            $table->string('received_date')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('clearance_charges')->nullable();
            $table->string('shippment_additional_charges')->nullable();
            $table->string('receipt_of_shipment')->nullable();
            $table->string('shippment_remarks')->nullable();
            $table->string('quantity_after_refinery')->nullable();
            $table->string('loss')->nullable();
            $table->string('refinary_charges')->nullable();
            $table->string('refinary_report')->nullable();
            $table->string('refinery_report')->nullable();
            $table->string('sell_rate')->nullable();
            $table->string('sell_amount')->nullable();
            $table->string('sell_remarks')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->default(1)->comment('1 = create , 2 = making , 3 = packaging , 4 = shipping , 5 = shippments , 6 = refinery , 7 = sell');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
