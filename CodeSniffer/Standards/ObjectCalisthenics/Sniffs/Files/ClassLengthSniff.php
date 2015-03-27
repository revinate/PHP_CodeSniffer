<?php

/**
 * Class length sniffer, part of "Keep your classes small" object calisthenics rule.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class ObjectCalisthenics_Sniffs_Files_ClassLengthSniff extends ObjectCalisthenics_DataStructureLengthSniff
{
    /**
     * {@inheritdoc}
     */
    public $maxLength = 400;

    /**
     * {@inheritdoc}
     */
    public $absoluteMaxLength = 400;

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        return array(T_CLASS);
    }    
}
