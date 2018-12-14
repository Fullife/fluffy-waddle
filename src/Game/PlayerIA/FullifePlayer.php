<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author Fullife
 */
class FullifePlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        //Random moment
        $ran = rand(1, $this->result->getNbRound());
        if ($ran == $this->result->getNbRound())
            return parent::friendChoice();

        //getStatsFor was better...
        $foe = 0;
        $frd = 0;
        foreach($this->result->getChoicesFor($this->opponentSide) as $bob){
            if ($bob == "foe")
                $foe++;
            else
                $frd++;
        }
        if ($foe == 0)
            return parent::friendChoice();
        if ($frd == 0)
            return parent::foeChoice();
        
        //if loosing, try to be friendly
        $arrayOpp = $this->result->getStatsFor($this->opponentSide);
        $myarray = $this->result->getStatsFor($this->mySide);
        if ($arrayOpp["score"] > $myarray["score"])
            return parent::friendChoice();

        if (rand()/$arrayOpp["name"] == 0)
            return parent::friendChoice();

        if ($this->result->getLastScoreFor($this->mySide) < $this->result->getChoicesFor($this->opponentSide))
        {
            if ($this->result->getLastChoiceFor($this->mySide) == parent::friendChoice())
                return parent::foeChoice();
            else
                return parent::friendChoice();
        }
        else{
            if ($this->result->getLastChoiceFor($this->mySide) == parent::friendChoice())
                return parent::foeChoice();
            else
                return parent::friendChoice();
        }
    }
 
};
