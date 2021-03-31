<?php


namespace App\Utils;


use App\Repository\BannedWordRepository;
use Doctrine\ORM\EntityManagerInterface;

class Censurator
{

    /**
     * @var BannedWordRepository
     */
    private $bannedWordRepository;

    public function __construct(BannedWordRepository $bannedWordRepository)
    {
        $this->bannedWordRepository = $bannedWordRepository;
    }

    public function purify( string $chaineDeBase ) : string
    {
        //Façon 1
        $censoredWords = $this->getCensoredWords();
        $result = str_ireplace($censoredWords,'***',$chaineDeBase);

        //Façon 2
        $result = $this->replaceBannedWords($chaineDeBase);

        return $result;
    }

    private function getCensoredWords() {

        $censoredWords = $this->bannedWordRepository->findAll();
        $censoredWords = array_map(function ($object) { return $object->getWord(); }, $censoredWords);

        return $censoredWords ;
    }

    private function replaceBannedWords(string $chaineDeBase) : string{
        $censoredWords = $this->getCensoredWords();
        $chaineDecoupee = $this->split_words($chaineDeBase);

        foreach ($chaineDecoupee as $value){
            if(in_array($value,$censoredWords,true) ){
                $result = str_ireplace($censoredWords,mb_substr($value,0,1) . str_repeat("*",mb_strlen($value)-1),$chaineDeBase);
            }
        }
        return $result;
    }

    /*---------------------------------------------------------------*/
    //source : https://phpsources.net/code/php/chaine/1011_coupe-une-phrase-en-mots
    /*
        Titre : Coupe sépare une phrase en mots

        URL   : https://phpsources.net/code_s.php?id=1011
        Date édition     : 15 Fév 2019
        Date mise à jour : 19 Aout 2019
        Rapport de la maj:
        - fonctionnement du code vérifié
    */
    /*---------------------------------------------------------------*/

    private function split_words($string){
        $retour = array();
        $delimiteurs = ' .!?, :;(){}[]%';
        $tok = strtok($string, " ");
        while (strlen(join(" ", $retour)) != strlen($string)) {
            array_push($retour, $tok);
            $tok = strtok($delimiteurs);
        }
        return $retour;
    }
}