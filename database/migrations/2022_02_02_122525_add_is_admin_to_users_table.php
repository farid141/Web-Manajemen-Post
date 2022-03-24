<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// dapat dibuat dengan command add_is_admin_to_users_table
// add_namaField_to_namaTable_table
class AddIsAdminToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
        });
    }

    // Eloquent mempermudah pengaksesan data pada database dengan perantara class model
    // class model dapat berisi ORM yakni relasi antara object dengan table yang ada
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // drop couloumn jika dilakukan rollback
            $table->dropColoumn('is_admin');
        });
    }
}
