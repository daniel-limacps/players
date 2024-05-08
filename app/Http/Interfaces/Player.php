<?php

/**
 * 
 */
namespace App\Http\Interfaces;

/**
 * 
 */
use Illuminate\Http\Request;

/**
 * 
 */
interface Player {

    /**
     * Lista os Jogadores no template de listagem
     * @return type
     */
    public function listplayers();
    
    /**
     * Exibe o formulário de inserção de jogadores;
     */
    public function addPlayer();

    /**
     * Insere um jogador na tabela
     * @param Request $request
     * @return type
     */
    public function store(Request $request);

    /**
     * Atualiza um jogador como ausetne
     * @param int $id
     * @param int $value
     * @return type JSON
     */
    public function absent(int $id, int $value=0);

    /**
     * Remove um jogador da tabela
     * @param int $id
     * @return type JOSN
     */
    public function remove(int $id);

    /**
     * Exibe o template de criação de times
     * @return type
     */
    public function teams();
    
    /**
     * Atualização de jogadores
     * @param type $id
     * @return type
     */
    public function updateplayer(int $id);

    /**
     * Atualiza os dados de um jogador
     * @param Request $request
     * @return type
     */
    public function update(Request $request, $id);
    
    /**
     * Exibe o templates para a criação de times
     * @param Request $request
     * @return type view
     */
    public function createteambyplayers(Request $request);
    
    /**
     * Cria os times a partir da quantidade de jogadores presentes
     * @param type $qtde
     * @param type $numplayers
     * @return array $arr_teams
     */
    public function createteam($qtde, $numplayers) : Array;
    
    /**
     * Executa todas as funções para a definição dos times
     * @param array $players
     * @param array $teams
     * @return array $teams
     */
    public function getplayers(Array $players, Array $teams) : Array;
    
    /**
     * Remove os goleiros aleatoriamente dos times para não ter mais de 2 goleiros
     * @param array $goalkeepers
     * @param array $teams
     * @return array
     */
    public function removegoalkeepers(array &$goalkeepers, int $teams, array &$retired = Array());
    
    /**
     * Retorna um Array por referência para definição de goleiros e jogadores
     * @param array $players
     * @param array $goalkeepers
     * @param array $anothers
     */
    public function addplayers(Array $players, Array &$goalkeepers, Array &$anothers);
    
    /**
     * Adciona os jogadores nos times
     * @param array $anothers
     * @param array $teams
     */
    public function addplayersinteams(Array $anothers, Array &$teams);
    
    /**
     * Adiciona os golieors nos times criados
     * @param array $goalkeepers
     * @param array $teams
     */
    public function addgoalkeepersinteams(Array $goalkeepers, Array &$teams);
    
    /**
     * Adiciona os goleiros removidos a mais nos times para adiciona-los como jogadores
     * @param array $retired
     * @param array $anothers
     */
    public function removegoalkeepersinteams(Array $retired, Array &$anothers);
    
    /**
     * Retorna mensagens customizadas
     * @return array
     */
    public function messages(): Array;

}
