<?php

namespace App\Actions\OfficialDiary;

use App\Models\FamilyResponsible as ModelsFamilyResponsible;
use App\Models\FamilyResponsibleList;
use App\Models\Person;
use Exception;
use Throwable;
use Illuminate\Support\Facades\DB;

class CutString
{

    /**
     * @throws Exception|Throwable
     */
    public function handle($string, $type)
    {
        //array de linhas limitadas por quantidade de caracteres
        //usar tpicas como linha tbm
        $lines = array();

        $string_limit = 140;
        $substring_base = $string;

        if($type == 'title' || $type == 'subtitle' || $type == 'act-title'){
            if(strlen($string) > $string_limit){
                //valor em inteiro de linhas
                $count = ceil(strlen($string) / $string_limit);
                while($count > 0){
                    $substring_to_line = substr($substring_base, 0, $string_limit);
                    $substring_base = substr($substring_base, $string_limit);

                    $arrayline = [
                        "type" => $type,
                        "line" => "<p class=\"line-" . $type . "\">" . $substring_to_line . "</p>"
                    ];
                    array_push($lines, $arrayline);
                    $count--;
                }

            }else{
                $arrayline = [
                    "type" => $type,
                    "line" => "<p class=\"line-" . $type . "\">" . $string . "</p>"
                ];
                array_push($lines, $arrayline);
            }

        }else{
            $padrao = '/<p(?: class="ql-align-(?:justify|center)")?>(.*?)<\/p>/'; // Padrão para capturar o conteúdo entre as tags
            preg_match_all($padrao, $substring_base, $matches);
            foreach($matches[0] as $match){
                $str_replaced = str_replace(array('<p>', '</p>', '<p class="ql-align-center">',
                '<p class="ql-align-justify">', '<p class="ql-align-left">', '<p class="ql-align-right">'), '', $match);
                $count = ceil(strlen($str_replaced) / $string_limit);

                while($count > 0){
                    $substring_to_line = substr($str_replaced, 0, $string_limit);
                    $str_replaced = substr($str_replaced, $string_limit);

                    $arrayline = [
                        "type" => $type,
                        "line" => "<p class=\"line-" . $type .
                        (str_contains($match, 'ql-align-center') ? ' line-center' : '') . "\">" . $substring_to_line . "</p>"
                    ];
                    array_push($lines, $arrayline);
                    $count--;
                }
            }

        }

        return $lines;
    }

}
