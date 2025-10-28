<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        /**
         * 🧩 EMPLOYEES (اطلاعات هویتی)
         */
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('father_name', 100)->nullable();
            $table->string('national_id', 20)->unique();
            $table->string('birth_certificate_number', 20)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place', 150)->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->unsignedTinyInteger('children_count')->default(0);
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('profile_completed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * ☎️ EMPLOYEE CONTACTS (اطلاعات تماس)
         */
        Schema::create('employee_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->unique()->constrained('employees')->cascadeOnDelete();
            $table->string('mobile', 20)->nullable();
            $table->string('emergency_phone', 20)->nullable();
            $table->string('work_email')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->timestamps();
        });

        /**
         * 💼 EMPLOYEE JOB INFO (اطلاعات شغلی پایه)
         */
        Schema::create('employee_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->unique()->constrained('employees')->cascadeOnDelete();
            $table->string('personnel_code', 50)->unique();
            $table->foreignId('organization_unit_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->string('employment_type', 50)->nullable(); // تمام وقت / پاره وقت / پروژه‌ای
            $table->string('employment_status', 50)->default('active'); // فعال / غیرفعال / مرخصی
            $table->date('start_date')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('shift_type', 50)->nullable(); // صبح / عصر / شب
            $table->timestamps();
        });

        /**
         * 🏦 EMPLOYEE BANK & FINANCIAL (اطلاعات بانکی و مالی)
         */
        Schema::create('employee_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('card_number', 32)->nullable();
            $table->string('sheba_number', 34)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        /**
         * 📄 EMPLOYEE DOCUMENTS (مدارک و هویت سازمانی)
         */
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('type', 100); // national_card, birth_certificate, contract, degree, signature_sample, profile_photo
            $table->string('file_path')->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });

        /**
         * 📚 EMPLOYEE ADDITIONAL INFO (اطلاعات تکمیلی)
         */
        Schema::create('employee_additional_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->unique()->constrained('employees')->cascadeOnDelete();
            $table->string('military_status', 100)->nullable(); // پایان خدمت / معافیت / در حال خدمت
            $table->text('skills')->nullable(); // مهارت‌های کلیدی (JSON or comma-separated)
            $table->text('languages')->nullable(); // زبان‌های مسلط
            $table->text('hr_notes')->nullable(); // توضیحات مدیر منابع انسانی
            $table->timestamps();
        });

        /**
         * 🔄 EMPLOYEE CHANGES (تغییر اطلاعات)
         */
        Schema::create('employee_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('changed_field', 100);
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('changed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_changes');
        Schema::dropIfExists('employee_additional_info');
        Schema::dropIfExists('employee_documents');
        Schema::dropIfExists('employee_bank_accounts');
        Schema::dropIfExists('employee_jobs');
        Schema::dropIfExists('employee_contacts');
        Schema::dropIfExists('employees');
    }
};
