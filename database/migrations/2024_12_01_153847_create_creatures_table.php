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
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid', 20)->unique();
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('hostility')->default(2);
            $table->string('location')->nullable();
            $table->integer('level')->default(1);
            $table->string('other_info')->nullable();
            $table->integer('life')->default(30);
            $table->integer('pa')->default(6);
            $table->integer('pm')->default(3);
            $table->integer('po')->default(0);
            $table->integer('ini')->default(0);
            $table->integer('invocation')->default(0);
            $table->integer('touch')->default(0);
            $table->integer('ca')->default(0);
            $table->integer('dodge_pa')->default(0);
            $table->integer('dodge_pm')->default(0);
            $table->integer('fuite')->default(0);
            $table->integer('tacle')->default(0);
            $table->integer('vitality')->default(0);
            $table->integer('sagesse')->default(0);
            $table->integer('strong')->default(0);
            $table->integer('intel')->default(0);
            $table->integer('agi')->default(0);
            $table->integer('chance')->default(0);
            $table->string('do_fixe_neutre')->default('0');
            $table->string('do_fixe_terre')->default('0');
            $table->string('do_fixe_feu')->default('0');
            $table->string('do_fixe_air')->default('0');
            $table->string('do_fixe_eau')->default('0');
            $table->integer('res_neutre')->default(0);
            $table->integer('res_terre')->default(0);
            $table->integer('res_feu')->default(0);
            $table->integer('res_air')->default(0);
            $table->integer('res_eau')->default(0);
            $table->integer('acrobatie_bonus')->default(0);
            $table->integer('discretion_bonus')->default(0);
            $table->integer('escamotage_bonus')->default(0);
            $table->integer('athletisme_bonus')->default(0);
            $table->integer('intimidation_bonus')->default(0);
            $table->integer('arcane_bonus')->default(0);
            $table->integer('histoire_bonus')->default(0);
            $table->integer('investigation_bonus')->default(0);
            $table->integer('nature_bonus')->default(0);
            $table->integer('religion_bonus')->default(0);
            $table->integer('dressage_bonus')->default(0);
            $table->integer('medecine_bonus')->default(0);
            $table->integer('perception_bonus')->default(0);
            $table->integer('perspicacite_bonus')->default(0);
            $table->integer('survie_bonus')->default(0);
            $table->integer('persuasion_bonus')->default(0);
            $table->integer('representation_bonus')->default(0);
            $table->integer('supercherie_bonus')->default(0);
            $table->integer('acrobatie_mastery')->default(0);
            $table->integer('discretion_mastery')->default(0);
            $table->integer('escamotage_mastery')->default(0);
            $table->integer('athletisme_mastery')->default(0);
            $table->integer('intimidation_mastery')->default(0);
            $table->integer('arcane_mastery')->default(0);
            $table->integer('histoire_mastery')->default(0);
            $table->integer('investigation_mastery')->default(0);
            $table->integer('nature_mastery')->default(0);
            $table->integer('religion_mastery')->default(0);
            $table->integer('dressage_mastery')->default(0);
            $table->integer('medecine_mastery')->default(0);
            $table->integer('perception_mastery')->default(0);
            $table->integer('perspicacite_mastery')->default(0);
            $table->integer('survie_mastery')->default(0);
            $table->integer('persuasion_mastery')->default(0);
            $table->integer('representation_mastery')->default(0);
            $table->integer('supercherie_mastery')->default(0);
            $table->string('kamas')->nullable();
            $table->string('drop_')->nullable();
            $table->string('other_item')->nullable();
            $table->string('other_consumable')->nullable();
            $table->string('other_ressource')->nullable();
            $table->string('other_spell')->nullable();
            $table->boolean('usable')->default(true);
            $table->softDeletes();
        });

        Schema::create('capability_creature', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Creature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Capability::class)->constrained()->cascadeOnDelete();
            $table->primary(['creature_id', 'capability_id']);
            $table->softDeletes();
        });

        Schema::create('consumable_creature', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Creature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Consumable::class)->constrained()->cascadeOnDelete();
            $table->string('quantity')->default(1);
            $table->primary(['creature_id', 'consumable_id']);
            $table->softDeletes();
        });

        Schema::create('creature_item', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Creature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Item::class)->constrained()->cascadeOnDelete();
            $table->string('quantity')->default(1);
            $table->primary(['creature_id', 'item_id']);
            $table->softDeletes();
        });

        Schema::create('creature_spell', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Creature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Spell::class)->constrained()->cascadeOnDelete();
            $table->primary(['creature_id', 'spell_id']);
            $table->softDeletes();
        });

        Schema::create('creature_ressource', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Creature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Ressource::class)->constrained()->cascadeOnDelete();
            $table->string('quantity')->default('1');
            $table->primary(['creature_id', 'ressource_id']);
            $table->softDeletes();
        });

        Schema::create('attribute_creature', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Creature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Attribute::class)->constrained()->cascadeOnDelete();
            $table->primary(['creature_id', 'attribute_id']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatures');
        Schema::dropIfExists('capability_creature');
        Schema::dropIfExists('consumable_creature');
        Schema::dropIfExists('creature_item');
        Schema::dropIfExists('creature_spell');
        Schema::dropIfExists('creature_ressource');
        Schema::dropIfExists('attribute_creature');
    }
};