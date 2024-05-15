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
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('role_id', 'FK_RoleIdWithRoles')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('permission_id', 'FK_PermisssionIdWithPermissions')->references('id')->on('permissions')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
