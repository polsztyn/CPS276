<?php
class Calculator {

    const DIV_OP = "/";
    const ADD_OP = "+";
    const MINUS_OP = "-";
    const MULTIPLY_OP = "*";

    static function areGoodParamters ($operator,$operand_1,$operand_2 ) {
        if (Calculator::isGoodOperator($operator) and Calculator::isGoodOperand ($operand_1) and Calculator::isGoodOperand ($operand_2) ) {
            return true;
        }
        else {
            return false;
        }

    }
    static function isGoodOperand ($operand) {

        return(is_int($operand));
    }

    static function isGoodOperator ($operator) {
        if ($operator != Calculator::DIV_OP and $operator != Calculator::ADD_OP and $operator != Calculator::MINUS_OP and $operator != Calculator::MULTIPLY_OP) {
            return false;
        }
        else {
            return true;
        }

    }

    static function computeValue($operator,$operand_1,$operand_2) {
        
        
        switch($operator)
            {
            case Calculator::ADD_OP : 
                $value = $operand_1 + $operand_2;
                return("<p>The sum of the numbers is " . $value . "</p>");
                break;
            case Calculator::MINUS_OP : 
                    $value = $operand_1 - $operand_2;
                    return("<p>The difference of the numbers is " . $value . "</p>");
                    break;
            case Calculator::MULTIPLY_OP : 
                    $value = $operand_1 * $operand_2;
                    return("<p>The product of the numbers is " . $value . "</p>");
                    break;
            case Calculator::DIV_OP : 
                    if ( $operand_2==0) {
                        return("<p>Cannot divide by zero</p>");
                    }
                    $value = $operand_1 / $operand_2;
                    return("<p>The division of the numbers is " . $value . "</p>");
                    break;
                       
            default : return("<p>Not Implemented yet </p>"); break;
            }

    }

    public function calc($operator="N/A",$operand_1="N/A", $operand_2="N/A") {
        if (Calculator::areGoodParamters ($operator,$operand_1,$operand_2) ) {
            return(Calculator::computeValue($operator,$operand_1,$operand_2));
        }
        else {
            return("<P>You must enter a string and two numbers</P>");         
        }
    }



}

?>