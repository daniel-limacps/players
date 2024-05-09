<?php

/**
 * 
 */
namespace App\Http\Controllers;

/**
 * 
 */
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Http\Interfaces;
use Illuminate\Http\Request;
use App\Models\Players;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
class PlayerController extends Controller implements Interfaces\Player {

    /**
     * Constante que define o total máximo de jogadores por times
     */
    const TOTALPLAYERS = 7;
    
    /**
     * Constante que define o total mínimo de jogadores por times
     */
    const MINPLAYERS = 4;

    /**
     * Variável que define o total de jogadores a serem adicionados ao time
     * @var type
     */
    var $NUMPLAYERS;

    /**
     * Construtor da classe
     */
    public function __construct() {
        
    }

    /**
     * Lista os Jogadores no template de listagem
     * @return type
     */
    public function listplayers() {
        $data = DB::table('players')->orderBy('name')->get()->all();
        return view('/players/listagem')->with('players', $data);
    }
    
    /**
     * Exibe o formulário de inserção de jogadores;
     */
    public function addPlayer() {
        return view('/players/addplayer');
    }
    
    /**
     * Atualização de jogadores
     * @param type $id
     * @return type
     */
    public function updateplayer(int $id) {
        $data = DB::table('players')->where('id', $id)->orderBy('name')->get()->all();
        return view('/players/updateplayer')->with('player', $data[0]);
    }

    /**
     * Insere um jogador na tabela
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $params = $request->all();
        $validator = Validator::make($params, [
            'name' => 'required',
            'nivel' => 'required',
        ], $this->messages());
 
        if ($validator->fails()) {
            return redirect('/player/addplayer')
                        ->withErrors($validator)
                        ->withInput();
        }
        $params['created_at'] = time();
        $player = new Players($params);
        $player->save();
        return redirect()->action([PlayerController::class, 'listplayers']);
    }

    /**
     * Atualiza um jogador como ausetne
     * @param int $id
     * @param int $value
     * @return type JSON
     */
    public function absent(int $id, int $value = 0) {
        $params = [
            'id' => $id,
            'absent' => $value
        ];

        $update = Players::find($id);
        return json_encode($update->update($params));
    }

    /**
     * Atualiza os dados de um jogador
     * @param Request $request
     * @return type
     */
    public function update(Request $request, $id) {
        $params = $request->all();

        $validator = Validator::make($params, [
            'name' => 'required',
            'nivel' => 'required',
        ], $this->messages());
 
        if ($validator->fails()) {
            return redirect('/updateplayer/' . $id)
                        ->withErrors($validator)
                        ->withInput();
        }
         $update = Players::find($id);
         $update->name = $request->input('name');
         $update->nivel = $request->input('nivel');
         if( isset($params['goalkeeper'])) {
             $update->goalkeeper = $request->input('goalkeeper');
         }
         $update->update();
        return redirect('/player');
   }

    /**
     * Remove um jogador da tabela
     * @param int $id
     * @return type JOSN
     */
    public function remove(int $id) {
        $remove = Players::find($id);
        return json_encode($remove->delete());
    }

    /**
     * Exibe o template de criação de times
     * @return type
     */
    public function teams() {
        return view('/players/teams');
    }

    /**
     * Exibe o templates para a criação de times
     * @param Request $request
     * @return type view
     */
    public function createteambyplayers(Request $request) {
        $params = $request->all();
        $validator = Validator::make($params, [
            'players' => 'required|numeric|max:' . self::TOTALPLAYERS.'|min:' . self::MINPLAYERS
        ], $this->messages());
 
        if ($validator->fails()) {
            return redirect('teams')
                        ->withErrors($validator)
                        ->withInput();
        }
 
        $players = DB::table('players')->whereNotIn('absent', Array(1))->orderBy('name', 'desc')->get()->all();
        $qteams = count($players);
        $minplayers = (int)$params['players'] * 2;
        $this->NUMPLAYERS = $params['players'];

        if((int)$qteams < $minplayers) {
            $params['message'] = "O mínimo de jogadores deve ser de {$minplayers}, e só há {$qteams} jogadores presentes.";
        } else {
        
            $teams = $this->createteam($qteams, $params['players']);
            $params['team'] = $this->getplayers($players, $teams);
        }

        return view('/players/teams')->with('data', $params);
    }
    
    /**
     * Cria os times a partir da quantidade de jogadores presentes
     * @param type $qtde
     * @param type $numplayers
     * @return array $arr_teams
     */
    public function createteam($qtde, $numplayers) : Array {
        $arr_teams = Array();
        $qteams = ceil($qtde / $numplayers);
        for($i = 1; $i <= $qteams; $i++) {
            $arr_teams["Time_{$i}"]['Goalkeeper'] = Array();
            $arr_teams["Time_{$i}"]['Players'] = Array();
        }
        return $arr_teams;
    }

    /**
     * Executa todas as funções para a definição dos times
     * @param array $players
     * @param array $teams
     * @return array $teams
     */
    public function getplayers(Array $players, Array $teams) : Array {
        $anothers = Array();
        $goalkeepers = Array();
        $retired = Array();

        $t = count($teams);

        $this->addplayers($players, $goalkeepers, $anothers);

        $this->removegoalkeepers($goalkeepers, $t, $retired);

        $this->removegoalkeepersinteams($retired, $anothers);

        krsort($anothers);

        $this->addgoalkeepersinteams($goalkeepers, $teams);

        $this->addplayersinteams($anothers, $teams);

        return $teams;
    }
   
    /**
     * Remove os goleiros aleatoriamente dos times para não ter mais de 2 goleiros
     * @param array $goalkeepers
     * @param array $teams
     * @return array
     */
    public function removegoalkeepers(array &$goalkeepers, int $teams, array &$retired = Array()) {
        $g = count($goalkeepers) - 1;
        if((int)$g > (int)($teams - 1)) {
            $rand = rand(0, $g);
            array_push($retired, $goalkeepers[$rand]);
            unset($goalkeepers[$rand]);
            $goalkeepers = array_values($goalkeepers);
            $this->removegoalkeepers($goalkeepers, $teams, $retired);
        }
    }

    /**
     * Retorna um Array por referência para definição de goleiros e jogadores
     * @param array $players
     * @param array $goalkeepers
     * @param array $anothers
     */
    public function addplayers(Array $players, Array &$goalkeepers, Array &$anothers) {
        $i = 0;
        foreach ($players AS $player) {
            if($player->goalkeeper === 1) {
                $goalkeepers[] =  Array(
                    "nivel_{$player->nivel}" => $player->name
                );
                $i++;
            } else {
                $anothers["nivel_{$player->nivel}"][] = $player->name;
            }
        }
    }

    /**
     * Adciona os jogadores nos times
     * @param array $anothers
     * @param array $teams
     */
    public function addplayersinteams(Array $anothers, Array &$teams) {
        $x = 0;
        $t = 1;
        while (count($anothers) > 0) {
            for($i = 1; $i <= 5; $i++) {
                if(array_key_exists("nivel_{$i}", $anothers) && count($anothers["nivel_{$i}"]) > 0) {
                    $q = count($anothers["nivel_{$i}"]);
                    $rand = rand(0, ((int)$q - 1));
                    $teams["Time_{$t}"]['Players'][] = $anothers["nivel_{$i}"][$rand];
                    unset($anothers["nivel_{$i}"][$rand]);
                    $anothers["nivel_{$i}"] = array_values($anothers["nivel_{$i}"]);
                    if(count($anothers["nivel_{$i}"]) < 1 ) {
                        unset($anothers["nivel_{$i}"]);
                    }
                    $totalgoalkeeper = count($teams["Time_{$t}"]['Goalkeeper']);
                    if(count($teams["Time_{$t}"]['Players']) == ((int)$this->NUMPLAYERS - (int)$totalgoalkeeper)) {
                        $t++;
                    }
                    $x++;
                }
            }
        }
    }

    /**
     * Adiciona os golieors nos times criados
     * @param array $goalkeepers
     * @param array $teams
     */
    public function addgoalkeepersinteams(Array $goalkeepers, Array &$teams) {
        $x = 1;
        foreach ($goalkeepers AS $goalkeeper => $goal) {
            foreach ($goal as $value) {
                $teams["Time_{$x}"]['Goalkeeper'][] = $value;
            }
            $x++;
        }
    }

    /**
     * Adiciona os goleiros removidos a mais nos times para adiciona-los como jogadores
     * @param array $retired
     * @param array $anothers
     */
    public function removegoalkeepersinteams(Array $retired, Array &$anothers) {
        foreach($retired AS $ret => $t) {
            foreach ($t AS $value => $v) {                
                if(isset($anothers[$value])) {
                    array_push($anothers[$value], $v);
                } else {
                    $anothers[$value][] = $v;
                }
            }
        }
   }

    /**
     * Retorna mensagens customizadas
     * @return array
     */
    public function messages(): Array{
        return [
            'players.required' => 'Um número de Jogadores deve ser definido',
            'players.max' => 'Número máximo de ' . self::TOTALPLAYERS . ' jogadores por times',
            'players.min' => 'Número mínimo de ' . self::MINPLAYERS . ' jogadores por times',
            'players.numeric' => 'Digite somente números',
            'name.required' => 'Digite o nome do jogador',
            'nivel.required' => 'Digite o nível do jogador',
        ];
    }
}
