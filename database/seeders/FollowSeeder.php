<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Follow;
use App\Models\User;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            // 自分以外のユーザーを取得
            $otherUsers = User::where('id', '!=', $user->id)->get();

            foreach ($otherUsers as $otherUser) {
                // 例: 各ユーザーをフォローする確率は50%
                if (rand(0, 1) === 1) {
                    // 既にフォローしているか確認
                    $existingFollow = Follow::where('user_id', $user->id)
                                            ->where('follower_id', $otherUser->id)
                                            ->first();

                    if (!$existingFollow) {
                        Follow::create([
                            'user_id' => $user->id,
                            'follower_id' => $otherUser->id,
                        ]);
                    }
                }
            }
        }
    }
}
