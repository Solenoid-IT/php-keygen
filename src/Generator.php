<?php



namespace Solenoid\KeyGen;



class Generator
{
    # Returns [string|false]
    public static function start
    (
        callable $is_available,
        callable $generate,
        
        int      $timeout       = 30,
        int      $time_interval = 1
    )
    {
        // (Setting the value)
        $key = null;

        // (Getting the value)
        $start_timestamp = time();



        while ( $key === null || ( $key && !$is_available( $key ) ) )
        {// Iterating each index
            if ( time() - $start_timestamp > $timeout )
            {// (Timeout has been reached)
                // Returning the value
                return false;
            }



            if ( $key )
            {// Value found
                // (Waiting for the seconds)
                sleep( $time_interval );
            }



            // (Getting the value)
            $key = $generate();
        }



        // Returning the value
        return $key;
    }
}



?>