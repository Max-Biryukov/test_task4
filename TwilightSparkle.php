<?php




class TwilightSparkle
{
    CONST MIN_NUM = 2; //Минимальное значение
    CONST MAX_NUM = 100000; //Максимальное значение
    CONST DEFAULT_VALUE = -1; //Дефолтное значение, если последовательность не поддается сортировке
/*
    private $_cntElements = 5;
    private $_sequence = [
        5,
        1,
        2,
        3,
        4,
    ];
*/

    private $_cntElements;
    private $_sequence = [];

    public function __construct()
    {
        if( empty($this->_cntElements) ){
            $this->_cntElements = $this->_getNum();
        }

        if( !empty($this->_cntElements) && empty($this->_sequence) ){
            $this->_generateSequence();
        }

    }

    /**
     * Генерация и проверка очередной последовательности
     */

    public static function testSequence()
    {
        $sparkle = new self();
        return $sparkle->_processSequence();
    }

    /**
     * Получаем случайное число в заданном диапазоне
     * @return int
     */

    private function _getNum()
    {
        return rand( self::MIN_NUM, self::MAX_NUM );
    }


    /**
     * Строим последовательность чисел
     * @return bool
     */
    private function _generateSequence()
    {

        if( !empty($this->_cntElements) ){

            for( $i = 0; $i < $this->_cntElements; $i++ ){
                $this->_sequence[] = $this->_getNum();
            }
            return true;
        }

        return false;
    }

    /**
     * Проверяем последовательность перестановками чисел
     * @return int
     */

    private function _processSequence()
    {
        if( !empty($this->_sequence) && !empty($this->_cntElements) ){

/*
            echo 'Входные данные: ' . $this->_cntElements;
            var_dump( $this->_sequence );
*/
            for( $step = 0; $step < $this->_cntElements; $step++ ){
               if( $this->_testSequence() ){
                   return $step;
               }
               array_unshift( $this->_sequence, array_pop($this->_sequence) );
            }

            return self::DEFAULT_VALUE;
        }

        die( 'В процессе генерации последовательности произошла ошибка' );
    }

    /**
     * Проверка элементов последовательности на неубывание
     * @return bool
     */

    private function _testSequence()
    {
        for( $i = 0; $i < ($this->_cntElements - 1); $i++ ){

            if( $this->_sequence[$i] > $this->_sequence[$i + 1] ){
                return false;
            }

        }

        return true;
    }

}