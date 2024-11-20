<?php
class Flight{
    public function __construct(public $flightCode, public $origin, public $destination, public $departureTime, public $aircraft){

    }

    
    public function getDistance(): float {
        // Convert degrees to radians
        [$lat1, $lon1] = [deg2rad($this->origin->latitude), deg2rad($this->origin->longitude)];
        [$lat2, $lon2] = [deg2rad($this->destination->latitude), deg2rad($this->destination->longitude)];

        // Differences in latitudes and longitudes
        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        // Haversine formula
        $a = sin($dLat / 2) ** 2 + cos($lat1) * cos($lat2) * (sin($dLon / 2) ** 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Earth's radius in kilometers
        return 6371 * $c;
    }

    // Method to calculate flight duration (in minutes)
    public function getDuration(): int {
        // Get the distance and aircraft's average speed
        $distance = $this->getDistance();  // Distance in kilometers
        $speed = $this->aircraft->avgSpeed;  // Speed in km/h

        // Calculate duration in hours, then convert to minutes
        $durationHours = $distance / $speed;
        $durationMinutes = $durationHours * 60;

        // Add 30 minutes for pre-flight and post-flight preparation
        return ceil($durationMinutes + 30);  // Round up to ensure full minutes
    }

    // Method to calculate landing time with the time zone of destination
    public function getLandingTime(): DateTime {
        // Calculate the total duration (in minutes)
        $durationMinutes = $this->getDuration();

        // Calculate landing time by adding duration to departure time
        $landingTime = clone $this->departureTime;
        $landingTime->add(new DateInterval("PT{$durationMinutes}M"));

        // Assume we get the time zone for the destination airport via some API or logic
        // For simplicity, we'll assume Turkey Airport is 3 hours ahead (e.g., UTC +3)
        $destinationTimeZoneOffset = 3 * 3600; // 3 hours in seconds

        // Adjust the landing time to the destination's timezone
        $landingTime->modify("+{$destinationTimeZoneOffset} seconds");

        return $landingTime;
    }
}