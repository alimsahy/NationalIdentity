<?php

/**
 * Turkish National Identity Finder
 * 
 * This PHP class can verify your Turkish National Identity number using algorithm without
 * holder name and password. Also, you can find your family members idendtity numbers 
 * using your National identity.
 * 
 * Please use this code for your personal purpose and education.
 * 
 * WARNING: DO NOT USE FOR BAD PURPOSES.
 * 
 * @author              Alimsah YILDIRIM <alimsahy@gmail.com>
 * @version             1.0
 * @filename            NationalIdentity.php
 * @created             13.10.2019
 * @licence             GNU General Public Licence V3
 * 
 * 
*/

class NationalIdentity
{
    public $name;
    public $surname;
    public $birthDate;
    public $nationalIdentity;


    /**
     * Verifies your National identity using your name, surname and birth date.
     * 
     * @return  boolean
     * 
    */
    public function verifyIdentity()
    {
        $client = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');
        
        try
        {
            $result = $client->TCKimlikNoDogrula(
            [
                'TCKimlikNo'    =>  $this->nationalIdentity,
                'Ad'            =>  $this->name,
                'Soyad'         =>  $this->surname,
                'DogumYili'     =>  $this->birthDate
            ]);

            if ($result->TCKimlikNoDogrulaResult) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Checks given national identity is correct or not without holder name and surname
     * 
     * @return  boolean
     * 
    */
    public function checkAlgorithm()
    {
        if (isset($this->nationalIdentity))
        {
            if (strlen($this->nationalIdentity) == 11)
            {
                # the first digit of the sum of the first 10 digits gives the 11th digit.
                $summary = 0;
                for ($i = 0; $i < strlen($this->nationalIdentity) - 1; $i++)
                {
                    $summary += $this->nationalIdentity[$i];
                }

                $summary = ''.$summary;
                $lastDigit = $this->nationalIdentity[strlen($this->nationalIdentity) - 1];
                if ($lastDigit == $summary[1])
                {
                    # Also, Digit 10 of the sum of 7 times the sum of digits 1, 3, 5, 7 
                    # and 9 and 9 times the sum of digits 2, 4, 6 and 8
                    $summary = 0;
                    $odd = $this->nationalIdentity[0] + $this->nationalIdentity[2] + $this->nationalIdentity[4] + $this->nationalIdentity[6] + $this->nationalIdentity[8];
                    $even = $this->nationalIdentity[1] + $this->nationalIdentity[3] + $this->nationalIdentity[5] + $this->nationalIdentity[7];

                    $odd = $odd * 7;
                    $even = $even * 9;
                    $summary = $odd + $even;
                    
                    $summary = ''.$summary;
                    $length = strlen($summary);

                    if ($this->nationalIdentity[9] == $summary[$length - 1])
                    {
                        # 1, 3, 5, 7 and 9 is the 11th digit of the 8th digit of the total.
                        $summary = 0;
                        $summary = $this->nationalIdentity[0] + $this->nationalIdentity[2] + $this->nationalIdentity[4] + $this->nationalIdentity[6] + $this->nationalIdentity[8];
                        $summary = $summary * 8;

                        $summary = ''.$summary;
                        if ($summary[strlen($summary) - 1] == $this->nationalIdentity[10])
                        {
                            return true;
                        }
                        else return false;
                    }
                    else return false;
                }
                else return false;
            }
            else return false;
        }
        else return false;
    }

    /**
     * Finds other family members based on your national identity
     * 
     * @param   integer     $count
     *  
     * @return  void
     * 
    */
    public function findFamilyNationalIdentites($repeat = 20)
    {
        $familyIndex[$count];

        if (isset($this->nationalIdentity))
        {
            $identity = null;
            for ($i = 0; $i < strlen($this->nationalIdentity) - 2; $i++)
            {
                $identity .= $this->nationalIdentity[$i];
            }
            
            $last = $identity;
            for ($i = 0; $i < $repeat; $i++)
            {
                $familyIndex[$i] = $last + 29999;
                $last = $familyIndex[$i];

                $last = strval($last);
                $l = $last;

                # finding 10th digit
                $a = intval($l[0]) + intval($l[2]) + intval($l[4]) + intval($l[6]) + intval($l[8]);
                $a = $a * 7;
                $b = $l[1] + $l[3] + $l[5] + $l[7];
                $b = $b * 9;
                $c = $a + $b;
                $c = ''.$c;
                
                # finding 11th digit.
                $d = intval($l[0]) + intval($l[2]) + intval($l[4]) + intval($l[6]) + intval($l[8]);
                $d = $d * 8;
                $d = ''.$d;
                echo '<p>'.$familyIndex[$i].$c[strlen($c) - 1].$d[strlen($d) - 1].'</p>';
            }
        }
    }
}
