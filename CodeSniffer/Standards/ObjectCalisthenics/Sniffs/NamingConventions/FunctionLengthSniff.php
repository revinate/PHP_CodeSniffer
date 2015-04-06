<?php

/**
 * Function length sniffer, part of "Do not abbreviate" object calisthenics rule.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class ObjectCalisthenics_Sniffs_NamingConventions_FunctionLengthSniff extends ObjectCalisthenics_IdentifierLengthSniff
{
    /**
     * {@inheritdoc}
     */
    public $tokenString = 'function';

    /**
     * {@inheritdoc}
     */
    public $tokenTypeLengthFactor = 0;

    /**
     * {@inheritdoc}
     */
    public $minLength = 3;

    /**
     * {@inheritdoc}
     */
    public $absoluteMinLength = 3; 

    /**
     * {@inheritdoc}
     */
    public $maxLength = 100;

    /**
     * {@inheritdoc}
     */
    public $absoluteMaxLength = 100;

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        return array(T_STRING);
    }    

    /**
     * {@inheritdoc}
     */
    public function isValid(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        return ($phpcsFile->findPrevious(T_FUNCTION, ($stackPtr - 1), ($stackPtr - 2), false, null, true) !== false);
    }
}
