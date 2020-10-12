    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonnectUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konnect_users', function (Blueprint $table)
         {
            $table->id();
            $table->string('kon_name');
            $table->string('kon_email')->unique();
            $table->string('kon_mobile')->nullable();
            $table->string('email_verified')->nullable();
            $table->string('kon_pswrd')->nullable();
            $table->string('kon_dob')->nullable();
            $table->string('kon_gender')->nullable();
            $table->string('kon_address')->nullable();
            $table->string('kon_city')->nullable();
            $table->string('kon_state')->nullable();
            $table->string('kon_country')->nullable();
            $table->string('kon_profile_pic')->nullable();
            $table->string('kon_thumb_pic')->nullable();
            $table->string('kon_bio')->nullable();
            $table->string('kon_unq_id')->nullable();
            $table->string('kon_device_id')->nullable();
            $table->string('kon_token')->nullable();
            $table->string('kon_aadhar')->nullable();
            $table->string('kon_pan')->nullable();
            $table->string('kon_status')->default('inactive');
            $table->string('kon_access')->nullable();
            $table->string('pofile_type')->nullable();
            $table->string('business_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('dept_name')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('blood_grp')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('account_status')->default('Public');
            //$table->string('email_verified')->nullable();
            $table->string('mobile_verified')->nullable();
            $table->string('kon_info_check')->default('Accept');
            $table->string('kon_terms_check')->default('Accept');
            $table->rememberToken();
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
        Schema::dropIfExists('konnect_users');
    }
}
