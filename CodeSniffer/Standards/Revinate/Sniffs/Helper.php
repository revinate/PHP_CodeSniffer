<?php

class Revinate_Sniffs_Helper {

    public static function addWarningUnlessSuppressed(PHP_CodeSniffer_File $phpcsFile, $tokenIndex, $suppressWarningComment, $warningMessage) {
        $comment = $phpcsFile->findNext(
            T_COMMENT,
            $tokenIndex
        );
        $tokens = $phpcsFile->getTokens();
        if ($comment === false || strpos($tokens[$comment]['content'], $suppressWarningComment) === false) {
            $howToFix = ". add \"$suppressWarningComment\" as a comment to the infringing line if there's an exception to the rules";
            $phpcsFile->addWarning($warningMessage . $howToFix, $tokenIndex, 'NotAllowed');
        }
    }
}