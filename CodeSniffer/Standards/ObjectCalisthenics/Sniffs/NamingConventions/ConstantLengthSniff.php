<?php

/**
 * Constant length sniffer, part of "Do not abbreviate" object calisthenics rule.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class ObjectCalisthenics_Sniffs_NamingConventions_ConstantLengthSniff extends ObjectCalisthenics_IdentifierLengthSniff
{
    /**
     * {@inheritdoc}
     */
    public $tokenString = 'constant';

    /**
     * {@inheritdoc}
     */
    public $tokenTypeLengthFactor = 0;

    /**
     * {@inheritdoc}
     */
    public $minLength = 2;

    /**
     * {@inheritdoc}
     */
    public $absoluteMinLength = 2;

    /**
     * {@inheritdoc}
     */
    public $maxLength = 64;

    /**
     * {@inheritdoc}
     */
    public $absoluteMaxLength = 64;

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
        return ($phpcsFile->findPrevious(T_CONST, ($stackPtr - 1), ($stackPtr - 2), false, null, true) !== false);
    }
}
