<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $topics = [
            ['topic_name' => 'all', 'topic_desc' => 'All about the latest in tech'],
            ['topic_name' => 'Health', 'topic_desc' => 'Health tips and news'],
            ['topic_name' => 'Sports', 'topic_desc' => 'Latest sports news and updates'],
            ['topic_name' => 'Entertainment', 'topic_desc' => 'Movies, TV shows, and celebrity gossip'],
            ['topic_name' => 'Business', 'topic_desc' => 'Business news and market updates'],
        ];

        foreach ($topics as $topic) {
            Topic::create($topic);
        }
    }
}
