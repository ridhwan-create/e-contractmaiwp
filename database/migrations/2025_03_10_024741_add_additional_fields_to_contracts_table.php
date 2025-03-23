<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->string('cost_center')->nullable()->after('end_date');
            $table->date('order_date')->nullable()->after('cost_center');
            $table->string('transaction_no')->nullable()->after('order_date');
            $table->unsignedBigInteger('supplier_id')->nullable()->after('transaction_no');
            $table->string('order_no')->nullable()->after('supplier_id');
            $table->date('entry_date')->nullable()->after('order_no');
            $table->string('requested_by')->nullable()->after('entry_date');
            $table->date('document_received_date')->nullable()->after('requested_by');
            $table->string('status')->nullable()->after('document_received_date');
            $table->string('requester_contact_no')->nullable()->after('status');
            $table->date('expected_date')->nullable()->after('requester_contact_no');
            $table->boolean('print_status')->default(false)->after('expected_date');
            $table->string('requisition_no')->nullable()->after('print_status');
            $table->string('quotation_no')->nullable()->after('requisition_no');
            $table->decimal('sst_amount', 10, 2)->default(0.00)->after('quotation_no');
            $table->string('reference_no')->nullable()->after('sst_amount');
            $table->decimal('total_order', 15, 2)->default(0.00)->after('reference_no');
            $table->string('purchase_method')->nullable()->after('total_order');
            $table->string('document_type')->nullable()->after('purchase_method');
        });
    }

    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn([
                'cost_center', 'order_date', 'transaction_no', 'supplier_id', 'order_no',
                'entry_date', 'requested_by', 'document_received_date', 'status',
                'requester_contact_no', 'expected_date', 'print_status', 'requisition_no',
                'quotation_no', 'sst_amount', 'reference_no', 'total_order',
                'purchase_method', 'document_type'
            ]);
        });
    }
};
