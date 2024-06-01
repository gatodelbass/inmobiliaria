<?php

namespace Database\Seeders;

use App\Models\Prize;
use Illuminate\Database\Seeder;

class PrizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $prize = new Prize;
      $prize->type = "cards obtained";
      $prize->icon_interval = "cardsObtainedInterval.svg";
      $prize->icon_milestone = "cardsObtainedMilestone.svg";
      $prize->save();

      $prize = new Prize;
      $prize->type = "cards pasted";
      $prize->icon_interval = "cardsPastedInterval.svg";
      $prize->icon_milestone = "cardsPastedMilestone.svg";
      $prize->save();

      $prize = new Prize;
      $prize->type = "exchanges accepted";
      $prize->icon_interval = "exchangesAcceptedInterval.svg";
      $prize->icon_milestone = "exchangesAcceptedMilestone.svg";
      $prize->save();

      $prize = new Prize;
      $prize->type = "boxes redeemed";
      $prize->icon_interval = "boxesRedeemedInterval.svg";
      $prize->icon_milestone = "boxesRedeemedMilestone.svg";
      $prize->save();

      $prize = new Prize;
      $prize->type = "avatars obtained";
      $prize->icon_interval = "avatarsObtainedInterval.svg";
      $prize->icon_milestone = "avatarsObtainedMilestone.svg";
      $prize->save();
    }
}
