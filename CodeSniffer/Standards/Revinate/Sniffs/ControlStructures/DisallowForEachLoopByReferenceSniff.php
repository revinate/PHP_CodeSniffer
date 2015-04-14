<?php

class Revinate_Sniffs_ControlStructures_DisallowForEachLoopByReferenceSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_FOREACH);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $openingBracket = $phpcsFile->findNext(T_OPEN_CURLY_BRACKET, $stackPtr);
        $foreachString = $phpcsFile->getTokensAsString($stackPtr, $openingBracket - $stackPtr);
        if (preg_match('/as\s+&/i', $foreachString)) {
            $phpcsFile->addError("don't pass by reference in a foreach loop - http://stackoverflow.com/questions/3307409/php-pass-by-reference-in-foreach", $stackPtr, 'NotAllowed');
        }
    }//end process()
}//end class
