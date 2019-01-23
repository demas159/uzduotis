<?php

function ReadAndCalculate($sSourceFile = null)
{

        //Getting file 
        $sFile = fopen(__DIR__.DIRECTORY_SEPARATOR.$sSourceFile, "r");

        //default variables
        $fSum = 0;
        $fUSD = 1.14;
        $fGPB = 0.88;
        $fEUR = 1;
        //while have strings in file, calculate sum
        while ($sLine = fgets($sFile)) {
                
                $fTotalItem = 0; //default total sum of item
                $aVariables = explode(';',$sLine); //explode strings

                if ($aVariables[2] != null && $aVariables[3] != null && $aVariables[4] != null) //we need only cost, quantity and currency by task
                {
                        $sCurrency = trim($aVariables[4]);

                        switch($sCurrency)
                        {
                                case "USD":
                                        $fTotalItem = ($aVariables[3] * $fUSD) * $aVariables[2];    
                                break;
                                case "EUR":
                                        $fTotalItem = ($aVariables[3] * $fEUR) * $aVariables[2];    
                                break;
                                case "GBP":
                                        $fTotalItem = ($aVariables[3] * $fGPB) * $aVariables[2];   
                                break;
                        }
                        
                }

                $fSum = $fSum + round($fTotalItem,2); // getting total sum
                
        }

        fclose($sFile);//file close

        return $fSum; //returning Float sum for editing/showing or whatever....
}


echo ReadAndCalculate($argv[1]);

?>