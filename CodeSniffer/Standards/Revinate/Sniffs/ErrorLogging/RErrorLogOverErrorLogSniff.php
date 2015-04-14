<?php

class Revinate_Sniffs_ErrorLogging_RErrorLogOverErrorLogSniff implements PHP_CodeSniffer_Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
            T_STRING,
            T_VARIABLE,
        );

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Skip tokens that are the names of functions or classes
        // within their definitions. For example: function myFunction...
        // "myFunction" is T_STRING but we should skip because it is not a
        // function or method *call*.
        $functionName = $stackPtr;
        $findTokens   = PHP_CodeSniffer_Tokens::$emptyTokens;

        $functionKeyword = $phpcsFile->findPrevious(
            $findTokens,
            ($stackPtr - 1),
            null,
            true
        );

        if ($tokens[$functionKeyword]['code'] === T_FUNCTION
            || $tokens[$functionKeyword]['code'] === T_CLASS
        ) {
            return;
        }

        // If the next non-whitespace token after the function or method call
        // is not an opening parenthesis then it cant really be a *call*.
        $openBracket = $phpcsFile->findNext(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            ($functionName + 1),
            null,
            true
        );
        if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
            return;
        }
        if (isset($tokens[$openBracket]['parenthesis_closer']) === false) {
            return;
        }
        $functionCall = $openBracket-1;
        if (in_array($tokens[$functionCall]['content'], array('error_log', 'r_error_log'))) {
            if ($tokens[$functionCall]['content'] == 'error_log') {
                Revinate_Sniffs_Helper::addWarningUnlessSuppressed($phpcsFile, $functionCall, 'phpcs-ignore-error-log', 'please use r_error_log rather than error_log');
            }
            if ($tokens[$functionCall]['content'] == 'r_error_log') {
                Revinate_Sniffs_Helper::addWarningUnlessSuppressed($phpcsFile, $functionCall, 'phpcs-ignore-error-log', 'please use StatsD/EventLogger rather than r_error_log unless the message should be treated as EOC');
            }
        }
    }//end process()

}//end class