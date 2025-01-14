<?php

namespace Database\Factories\Modules;

use App\Models\Modules\Npc;
use App\Models\Modules\Creature;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NpcFactory extends Factory
{
    protected $model = Npc::class;

    public function definition(): array
    {
        return [
            'creature_id' => Creature::factory(),
            'story' => $this->faker->paragraph,
            'historical' => $this->faker->paragraph,
            'age' => $this->faker->numberBetween(1, 100),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'classe_id' => null, // ou vous pouvez utiliser un ID de classe existant
            'specialization_id' => null, // ou vous pouvez utiliser un ID de spécialisation existant
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'hostility' => $this->faker->randomElement(array_keys(Creature::HOSTILITY)),
            'location' => $this->faker->address,
            'level' => $this->faker->numberBetween(1, 100),
            'other_info' => $this->faker->sentence,
            'life' => $this->faker->numberBetween(1, 1000),
            'pa' => $this->faker->numberBetween(1, 10),
            'pm' => $this->faker->numberBetween(1, 10),
            'po' => $this->faker->numberBetween(1, 10),
            'ini' => $this->faker->numberBetween(1, 100),
            'invocation' => $this->faker->numberBetween(1, 10),
            'touch' => $this->faker->numberBetween(1, 100),
            'ca' => $this->faker->numberBetween(1, 100),
            'dodge_pa' => $this->faker->numberBetween(1, 100),
            'dodge_pm' => $this->faker->numberBetween(1, 100),
            'fuite' => $this->faker->numberBetween(1, 100),
            'tacle' => $this->faker->numberBetween(1, 100),
            'vitality' => $this->faker->numberBetween(1, 1000),
            'sagesse' => $this->faker->numberBetween(1, 100),
            'strong' => $this->faker->numberBetween(1, 100),
            'intel' => $this->faker->numberBetween(1, 100),
            'agi' => $this->faker->numberBetween(1, 100),
            'chance' => $this->faker->numberBetween(1, 100),
            'do_fixe_neutre' => $this->faker->numberBetween(1, 100),
            'do_fixe_terre' => $this->faker->numberBetween(1, 100),
            'do_fixe_feu' => $this->faker->numberBetween(1, 100),
            'do_fixe_air' => $this->faker->numberBetween(1, 100),
            'do_fixe_eau' => $this->faker->numberBetween(1, 100),
            'res_fixe_neutre' => $this->faker->numberBetween(1, 100),
            'res_fixe_terre' => $this->faker->numberBetween(1, 100),
            'res_fixe_feu' => $this->faker->numberBetween(1, 100),
            'res_fixe_air' => $this->faker->numberBetween(1, 100),
            'res_fixe_eau' => $this->faker->numberBetween(1, 100),
            'res_neutre' => $this->faker->numberBetween(-4, 2),
            'res_terre' => $this->faker->numberBetween(-4, 2),
            'res_feu' => $this->faker->numberBetween(-4, 2),
            'res_air' => $this->faker->numberBetween(-4, 2),
            'res_eau' => $this->faker->numberBetween(-4, 2),
            'acrobatie_bonus' => $this->faker->numberBetween(1, 100),
            'discretion_bonus' => $this->faker->numberBetween(1, 100),
            'escamotage_bonus' => $this->faker->numberBetween(1, 100),
            'athletisme_bonus' => $this->faker->numberBetween(1, 100),
            'intimidation_bonus' => $this->faker->numberBetween(1, 100),
            'arcane_bonus' => $this->faker->numberBetween(1, 100),
            'histoire_bonus' => $this->faker->numberBetween(1, 100),
            'investigation_bonus' => $this->faker->numberBetween(1, 100),
            'nature_bonus' => $this->faker->numberBetween(1, 100),
            'religion_bonus' => $this->faker->numberBetween(1, 100),
            'dressage_bonus' => $this->faker->numberBetween(1, 100),
            'medecine_bonus' => $this->faker->numberBetween(1, 100),
            'perception_bonus' => $this->faker->numberBetween(1, 100),
            'perspicacite_bonus' => $this->faker->numberBetween(1, 100),
            'survie_bonus' => $this->faker->numberBetween(1, 100),
            'persuasion_bonus' => $this->faker->numberBetween(1, 100),
            'representation_bonus' => $this->faker->numberBetween(1, 100),
            'supercherie_bonus' => $this->faker->numberBetween(1, 100),
            'acrobatie_mastery' => $this->faker->numberBetween(0, 2),
            'discretion_mastery' => $this->faker->numberBetween(0, 2),
            'escamotage_mastery' => $this->faker->numberBetween(0, 2),
            'athletisme_mastery' => $this->faker->numberBetween(0, 2),
            'intimidation_mastery' => $this->faker->numberBetween(0, 2),
            'arcane_mastery' => $this->faker->numberBetween(0, 2),
            'histoire_mastery' => $this->faker->numberBetween(0, 2),
            'investigation_mastery' => $this->faker->numberBetween(0, 2),
            'nature_mastery' => $this->faker->numberBetween(0, 2),
            'religion_mastery' => $this->faker->numberBetween(0, 2),
            'dressage_mastery' => $this->faker->numberBetween(0, 2),
            'medecine_mastery' => $this->faker->numberBetween(0, 2),
            'perception_mastery' => $this->faker->numberBetween(0, 2),
            'perspicacite_mastery' => $this->faker->numberBetween(0, 2),
            'survie_mastery' => $this->faker->numberBetween(0, 2),
            'persuasion_mastery' => $this->faker->numberBetween(0, 2),
            'representation_mastery' => $this->faker->numberBetween(0, 2),
            'supercherie_mastery' => $this->faker->numberBetween(0, 2),
            'kamas' => $this->faker->randomNumber(),
            'drop_' => $this->faker->sentence,
            'other_item' => $this->faker->sentence,
            'other_consumable' => $this->faker->sentence,
            'other_spell' => $this->faker->sentence,
            'usable' => $this->faker->boolean,
            'is_visible' => $this->faker->boolean,
            'created_by' => null, // ou vous pouvez utiliser un ID d'utilisateur existant
            'image' => $this->faker->imageUrl(),
        ];
    }
}
