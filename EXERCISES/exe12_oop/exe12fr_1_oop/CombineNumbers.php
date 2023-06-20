<?php
/**
 *exe12_1.php
 *EXERCISE 12 NUMBER 1
 *FORM & FORM HANDLING
 *Patrick Saint-Louis, 2023
*/
class CombineNumbers extends CountNumbers
{
    protected function theSum()
    {
        $sum = 0;
        foreach ($this->numbers as $index) {
            $sum = $sum + $index;
        }
        return $sum;
    }

    protected function theProduct()
    {
        return array_product($this->numbers);
    }

    public function displayOutputs2(): void
    {
        echo "<p>Somme des nombres: " . $this->theSum() . "</p>";
        echo "<p>Produit des nombres: " . $this->theProduct() . "</p>";
    }

}