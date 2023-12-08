<?php



namespace Solenoid\KeyGen;



class Token
{
    # Returns [string]
    public static function generate (int $length)
    {
        // Returning the value
        return bin2hex( random_bytes( $length / 2 ) );
    }
}



?>