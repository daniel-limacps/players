<?php

/**
 * 
 */
namespace Database\Seeders;

/**
 * 
 */
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
class PlayersTableSeeder extends Seeder {
    
    /**
     * 
     */
    public function run() {
        $players = [
            ['Jogador 1', 2, 0, 0],
            ['Jogador 2', 2, 0, 0],
            ['Jogador 3', 3, 0, 0],
            ['Jogador 4', 2, 1, 0],
            ['Jogador 5', 5, 0, 0],
            ['Jogador 6', 4, 0, 0],
            ['Jogador 7', 3, 0, 0],
            ['Jogador 8', 3, 0, 0],
            ['Jogador 9', 2, 0, 0],
            ['Jogador 10', 1, 0, 0],
            ['Jogador 11', 2, 1, 0],
            ['Jogador 12', 4, 0, 0],
            ['Jogador 13', 4, 0, 0],
            ['Jogador 14', 5, 0, 0],
            ['Jogador 15', 3, 0, 0],
            ['Jogador 16', 2, 0, 0],
            ['Jogador 17', 4, 0, 0],
            ['Jogador 18', 1, 0, 0],
            ['Jogador 19', 2, 1, 0],
            ['Jogador 20', 4, 0, 0],
            ['Jogador 21', 3, 0, 0],
            ['Jogador 22', 2, 0, 0],
            ['Jogador 23', 3, 0, 0],
            ['Jogador 24', 3, 1, 0],
            ['Jogador 25', 1, 0, 0]
        ];
        
        foreach($players AS $player) {
            $this->insert($player);
        }
    }
    
    /**
     * 
     * @param array $player
     * @param string $table
     */
    private function insert(Array $player, string $table = 'players') {
        try {
             DB::table($table)->insert([
            'name' => trim($player[0]),
            'nivel' => $player[1],
            'goalkeeper' => $player[2],
            'absent' => $player[3],
            'created_at' => time()
        ]);
        } catch (Exception $ex) {
            echo '<pre>';
            print_r($ex->getMessage());
            echo '</pre>';
        }
    }
}
