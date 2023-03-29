<?php

use App\Models\Organization;
use App\Models\Profile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateOrganizationsTable extends Migration
{

    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 2048)->nullable();
            $table->string('position', 1024)->nullable();
            $table->string('iin', 20)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_individual')->nullable();
            $table->uuid('mio_id')->unique()->nullable();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->uuid('organization_id')->nullable();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->index(['organization_id']);
        });

        $profiles = Profile::query()->whereNull('organization_id')->get();

        if($profiles)
            foreach ($profiles as $profile)
            {
                $organization = Organization::query()->create(
                    [
                        'id' => Uuid::uuid4(),
                        'name' => $profile->company_name,
                        'iin' => $profile->iin,
                        'position' => $profile->position,
                        'description' => $profile->description,
                        'is_individual' => null,
                        'mio_id' => null
                    ]
                );

                $profile->update(['organization_id' => $organization->id]);
            }
    }

    public function down()
    {

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropIndex(['organization_id']);
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('organization_id');
        });

        Schema::dropIfExists('organizations');
    }
}
