<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('dokumen_ktp')->nullable()->after('notes');
            $table->string('dokumen_kk')->nullable()->after('dokumen_ktp');
            $table->string('dokumen_slip_gaji')->nullable()->after('dokumen_kk');
            $table->string('dokumen_npwp')->nullable()->after('dokumen_slip_gaji');
            $table->string('dokumen_surat_kerja')->nullable()->after('dokumen_npwp');
            $table->string('dokumen_rekening')->nullable()->after('dokumen_surat_kerja');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'dokumen_ktp',
                'dokumen_kk',
                'dokumen_slip_gaji',
                'dokumen_npwp',
                'dokumen_surat_kerja',
                'dokumen_rekening'
            ]);
        });
    }
};
